<?php

namespace App\Http\Controllers;

use App\Models\PackagingInspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Untuk error logging
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class PackagingInspectionController extends Controller
{
    /**
     * Menampilkan daftar semua inspeksi.
     */
    public function index(Request $request): View
    {
        // 1. Memulai query builder
        $query = PackagingInspection::query();

        // 2. Terapkan filter pencarian jika ada
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            // Mencari di beberapa kolom
            $query->where(function ($q) use ($searchTerm) {
                $q->where('id', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('uuid', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('shift', 'LIKE', "%{$searchTerm}%");
            });
        }

        // 3. Terapkan filter tanggal awal (start_date)
        if ($request->filled('start_date')) {
            // Menggunakan whereDate untuk memastikan perbandingan hanya pada tanggal (mengabaikan waktu)
            $query->whereDate('inspection_date', '>=', $request->input('start_date'));
        }

        // 4. Terapkan filter tanggal akhir (end_date)
        if ($request->filled('end_date')) {
            $query->whereDate('inspection_date', '<=', $request->input('end_date'));
        }

        // 5. Urutkan (sort) berdasarkan tanggal inspeksi terbaru
        //    Paginate (buat halaman) hasil query
        //    withQueryString() penting agar link paginasi tetap menyertakan parameter filter
        $inspections = $query->latest('inspection_date') // Urutkan berdasarkan inspection_date DESC
                             ->paginate(10)            // 10 item per halaman
                             ->withQueryString();     // Pertahankan filter di URL paginasi

        // 6. Kembalikan view dengan data hasil filter
        return view('packaging_inspections.index', compact('inspections'));
    }

    /**
     * Menampilkan form untuk membuat inspeksi baru.
     */
    public function create(): View
    {
        // Opsi untuk dropdown KONDISI KENDARAAN (sekarang dipakai di level item)
        $vehicleConditions = ['Bersih', 'Kotor', 'Bau', 'Bocor', 'Basah', 'Kering', 'Bebas Hama'];
        return view('packaging_inspections.create', compact('vehicleConditions'));
    }

    /**
     * Menyimpan inspeksi baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {  
        
        // Validasi data header (Hanya tanggal dan shift)
        $validatedHeader = $request->validate([
            'inspection_date' => 'required|date',
            'shift' => 'required|string|max:255',
            
            // Validasi data items (sebagai array)
            'items' => 'required|array|min:1',

            // Validasi field yang dipindah
            'items.*.no_pol' => 'required|string|max:255',
            'items.*.vehicle_condition' => 'required|string|max:255',
            'items.*.pbb_op' => 'nullable|string|max:255',

            // Validasi field item
            'items.*.packaging_type' => 'required|string|max:255',
            'items.*.supplier' => 'required|string|max:255',
            'items.*.lot_batch' => 'required|string|max:255',
            
            // Validasi field kondisi (yang kini terlihat)
            'items.*.condition_design' => 'required|string|max:10', // OK atau Not OK
            'items.*.condition_sealing' => 'required|string|max:10', // OK atau Not OK
            'items.*.condition_color' => 'required|string|max:10', // OK atau Not OK
            'items.*.condition_dimension' => 'nullable|string|max:255',
            'items.*.condition_weight_pcs' => 'nullable|string|max:255', // (Opsional)
            
            // Validasi kuantitas
            'items.*.quantity_goods' => 'required|integer|min:0',
            'items.*.quantity_sample' => 'required|integer|min:0',
            'items.*.quantity_reject' => 'required|integer|min:0',
            'items.*.acceptance_status' => 'required|in:OK,Tolak',
            'items.*.notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();
            
            // 1. Buat data Induk (Header) - Hanya berisi tanggal dan shift
            $inspection = PackagingInspection::create($validatedHeader);
            
            // 2. Buat data Anak (Items)
            // Kita attach packaging_inspection_id ke setiap item
            $itemsData = collect($validatedHeader['items'])->map(function ($item) use ($inspection) {
                $item['packaging_inspection_id'] = $inspection->id;
                return $item;
            });

            // Masukkan semua item sekaligus
            $inspection->items()->createMany($itemsData);

            DB::commit();
            
            return redirect()->route('packaging-inspections.index')
                             ->with('success', 'Inspeksi packaging berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing packaging inspection: ' . $e->getMessage());
            
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')
                         ->withInput();
        }
    }

    /**
     * Menampilkan detail satu inspeksi.
     */
    public function show(PackagingInspection $packagingInspection): View
    {
        // Eager load items untuk efisiensi
        $packagingInspection->load('items');
        return view('packaging_inspections.show', compact('packagingInspection'));
    }

    /**
     * Menampilkan form untuk mengedit inspeksi.
     */
    public function edit(PackagingInspection $packagingInspection): View
    {
        $packagingInspection->load('items');
        $vehicleConditions = ['Bersih', 'Kotor', 'Bau', 'Bocor', 'Basah', 'Kering', 'Bebas Hama'];
        
        return view('packaging_inspections.edit', compact('packagingInspection', 'vehicleConditions'));
    }

    /**
     * Update data inspeksi di database.
     */
    public function update(Request $request, PackagingInspection $packagingInspection): RedirectResponse
    {
        // $packagingInspection sudah di-load oleh Route Model Binding (via UUID)

        // Validasi
        $validatedData = $request->validate([
            'inspection_date' => 'required|date',
            'shift' => 'required|string|max:255',
            
            'items' => 'required|array|min:1',
            'items.*.id' => 'nullable|integer|exists:packaging_inspection_items,id', // Untuk update
            
            'items.*.no_pol' => 'required|string|max:255',
            'items.*.vehicle_condition' => 'required|string|max:255',
            'items.*.pbb_op' => 'nullable|string|max:255',
            'items.*.packaging_type' => 'required|string|max:255',
            'items.*.supplier' => 'required|string|max:255',
            'items.*.lot_batch' => 'required|string|max:255',
            'items.*.condition_design' => 'required|string|max:10',
            'items.*.condition_sealing' => 'required|string|max:10',
            'items.*.condition_color' => 'required|string|max:10',
            'items.*.condition_dimension' => 'nullable|string|max:255',
            'items.*.quantity_goods' => 'required|integer|min:0',
            'items.*.quantity_sample' => 'required|integer|min:0',
            'items.*.quantity_reject' => 'required|integer|min:0',
            'items.*.acceptance_status' => 'required|in:OK,Tolak',
            'items.*.notes' => 'nullable|string',
        ]);
        
        try {
            DB::beginTransaction();

            // 1. Update data Induk (Header)
            $packagingInspection->update($validatedData);

            $incomingItemIds = [];

            // 2. Update atau Buat data Anak (Items)
            foreach ($validatedData['items'] as $itemData) {
                if (isset($itemData['id']) && $itemData['id']) {
                    // Update item yang sudah ada
                    $item = $packagingInspection->items()->find($itemData['id']);
                    if ($item) {
                        $item->update($itemData);
                        $incomingItemIds[] = $item->id;
                    }
                } else {
                    // Buat item baru
                    $newItem = $packagingInspection->items()->create($itemData);
                    $incomingItemIds[] = $newItem->id;
                }
            }
            
            // 3. Hapus item yang tidak ada di form (di-soft delete)
            // Ini akan menghapus item yang ada di database tapi dihapus oleh user di form
            $packagingInspection->items()->whereNotIn('id', $incomingItemIds)->delete();

            DB::commit();

            return redirect()->route('packaging-inspections.index')
                             ->with('success', 'Inspeksi packaging berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating packaging inspection: ' . $e->getMessage());

            return back()->with('error', 'Terjadi kesalahan saat memperbarui data.')
                         ->withInput(); // Mengembalikan input agar form terisi kembali
        }
    }

    /**
     * Hapus (Soft Delete) data inspeksi.
     */
    public function destroy(PackagingInspection $packagingInspection): RedirectResponse
    {
        try {
            // Soft delete akan otomatis men-trigger cascade soft delete (jika di-setting di model)
            // atau kita bisa hapus manual item-itemnya
            $packagingInspection->items()->delete(); // Soft delete semua items
            $packagingInspection->delete(); // Soft delete induk

            return redirect()->route('packaging-inspections.index')
                             ->with('success', 'Inspeksi packaging berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting packaging inspection: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    public function showVerificationList(Request $request): View
    {
        $query = PackagingInspection::query()->with('items'); // Eager load items

        // Terapkan filter tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('inspection_date', [$request->start_date, $request->end_date]);
        }

        // Terapkan filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                // Mencari di tabel header (packaging_inspections)
                $q->where('shift', 'like', "%{$search}%")
                  // Mencari di tabel relasi (packaging_inspection_items)
                  ->orWhereHas('items', function ($itemQuery) use ($search) {
                      $itemQuery->where('no_pol', 'like', "%{$search}%")
                                ->orWhere('supplier', 'like', "%{$search}%")
                                ->orWhere('packaging_type', 'like', "%{$search}%");
                  });
            });
        }

        // Ambil data, urutkan dari terbaru, dan paginasi
        $inspections = $query->latest('inspection_date')->paginate(15)->withQueryString();

        // Mengirim data ke view 'packaging.verification'
        return view('packaging_inspections.verification', ['data' => $inspections]);
    }

    /**
     * Menyimpan hasil verifikasi dari modal.
     * (Menangani route 'packaging-inspections.verify')
     * @param string $uuid UUID dari inspeksi yang akan diverifikasi
     */
    public function verify(Request $request, PackagingInspection $inspection): RedirectResponse
    {
        // Validasi input dari modal
        $validated = $request->validate([
            'status_spv' => ['required', Rule::in([1, 2])],
            'catatan_spv' => [
                'nullable',
                'string',
                'required_if:status_spv,2',
            ],
        ]);
        
        // TIDAK PERLU LAGI MENCARI MANUAL:
        // $inspection = PackagingInspection::where('uuid', $uuid)->firstOrFail();
        // Variabel $inspection sudah berisi data yang benar dari URL.

        try {
            // Gunakan update() untuk mass assignment (lebih bersih)
            $inspection->update([
                'status_spv'    => $validated['status_spv'],
                'catatan_spv'   => $validated['catatan_spv'] ?? null,
                'verified_by'   => Auth::id(),
                'verified_at'   => now(),
            ]);

            return back()->with('success', 'Verifikasi packaging berhasil disimpan.');

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan verifikasi packaging: ' . $e->getMessage());
            // Tampilkan pesan error yang sebenarnya ke user
            return back()->with('error', 'GAGAL: ' . $e->getMessage()); 
        }
    }
}