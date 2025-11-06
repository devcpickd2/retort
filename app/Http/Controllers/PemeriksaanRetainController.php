<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanRetain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PemeriksaanRetainController extends Controller
{
    public function index(Request $request) 
    {
        // Mulai query builder
        $query = PemeriksaanRetain::withCount('items')
                    ->with('creator')
                    ->latest();

        // Terapkan filter tanggal awal (jika ada)
        $query->when($request->start_date, function ($q) use ($request) {
            return $q->where('tanggal', '>=', $request->start_date);
        });

        // Terapkan filter tanggal akhir (jika ada)
        $query->when($request->end_date, function ($q) use ($request) {
            return $q->where('tanggal', '<=', $request->end_date);
        });

        // Ambil data setelah difilter dan paginasi
        $pemeriksaanRetains = $query->paginate(15);
            
        // Kirim data ke view
        return view('pemeriksaan_retain.index', compact('pemeriksaanRetains')); 
    }

    public function create()
    {
        return view('pemeriksaan_retain.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hari' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'items' => 'required|array|min:1', 
            'items.*.kode_produksi' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            // 'uuid' dan 'created_by' akan diisi otomatis oleh Model 'booted'
            $pemeriksaanRetain = PemeriksaanRetain::create($request->only('hari', 'tanggal', 'keterangan'));

            foreach ($request->items as $itemData) {
                $itemPayload = [
                    'kode_produksi'   => $itemData['kode_produksi'] ?? null,
                    'exp_date'        => $itemData['exp_date'] ?? null,
                    'varian'          => $itemData['varian'] ?? null,
                    'panjang'         => $itemData['panjang'] ?? null,
                    'diameter'        => $itemData['diameter'] ?? null,
                    'sensori_rasa'    => $itemData['sensori_rasa'] ?? null,
                    'sensori_warna'   => $itemData['sensori_warna'] ?? null,
                    'sensori_aroma'   => $itemData['sensori_aroma'] ?? null,
                    'sensori_texture' => $itemData['sensori_texture'] ?? null,
                    'temuan_jamur'    => isset($itemData['temuan_jamur']),
                    'temuan_lendir'   => isset($itemData['temuan_lendir']),
                    'temuan_pinehole' => isset($itemData['temuan_pinehole']),
                    'temuan_kejepit'  => isset($itemData['temuan_kejepit']),
                    'temuan_seal'     => isset($itemData['temuan_seal']),
                    'lab_garam'       => $itemData['lab_garam'] ?? null,
                    'lab_air'         => $itemData['lab_air'] ?? null,
                    'lab_mikro'       => $itemData['lab_mikro'] ?? null,
                ];

                // 'uuid' akan diisi otomatis oleh Model Item
                $pemeriksaanRetain->items()->create($itemPayload);
            }

            DB::commit();

            return redirect()->route('pemeriksaan_retain.index') 
                             ->with('success', 'Data pemeriksaan retain berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing pemeriksaan retain: ' . $e->getMessage());

            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                             ->withInput();
        }
    }

    public function show(PemeriksaanRetain $pemeriksaanRetain)
    {
        
        $pemeriksaanRetain->load('items', 'creator', 'verifiedBy'); 
        
        return view('pemeriksaan_retain.show', compact('pemeriksaanRetain'));
    }

    // $pemeriksaanRetain akan di-resolve menggunakan 'uuid'
    public function edit(PemeriksaanRetain $pemeriksaanRetain)
    {
        $pemeriksaanRetain->load('items');
        return view('pemeriksaan_retain.edit', compact('pemeriksaanRetain'));
    }

    // $pemeriksaanRetain akan di-resolve menggunakan 'uuid'
    public function update(Request $request, PemeriksaanRetain $pemeriksaanRetain)
    {
         $validator = Validator::make($request->all(), [
            'hari' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'items' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $pemeriksaanRetain->update($request->only('hari', 'tanggal', 'keterangan'));

            $pemeriksaanRetain->items()->delete();

            foreach ($request->items as $itemData) {
                 $itemPayload = [
                    'kode_produksi'   => $itemData['kode_produksi'] ?? null,
                    'exp_date'        => $itemData['exp_date'] ?? null,
                    'varian'          => $itemData['varian'] ?? null,
                    'panjang'         => $itemData['panjang'] ?? null,
                    'diameter'        => $itemData['diameter'] ?? null,
                    'sensori_rasa'    => $itemData['sensori_rasa'] ?? null,
                    'sensori_warna'   => $itemData['sensori_warna'] ?? null,
                    'sensori_aroma'   => $itemData['sensori_aroma'] ?? null,
                    'sensori_texture' => $itemData['sensori_texture'] ?? null,
                    'temuan_jamur'    => isset($itemData['temuan_jamur']),
                    'temuan_lendir'   => isset($itemData['temuan_lendir']),
                    'temuan_pinehole' => isset($itemData['temuan_pinehole']),
                    'temuan_kejepit'  => isset($itemData['temuan_kejepit']),
                    'temuan_seal'     => isset($itemData['temuan_seal']),
                    'lab_garam'       => $itemData['lab_garam'] ?? null,
                    'lab_air'         => $itemData['lab_air'] ?? null,
                    'lab_mikro'       => $itemData['lab_mikro'] ?? null,
                ];
                $pemeriksaanRetain->items()->create($itemPayload);
            }

            DB::commit();

            return redirect()->route('pemeriksaan_retain.index')
                             ->with('success', 'Data pemeriksaan retain berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating pemeriksaan retain: ' . $e->getMessage());

            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                             ->withInput();
        }
    }

    // $pemeriksaanRetain akan di-resolve menggunakan 'uuid'
    public function destroy(PemeriksaanRetain $pemeriksaanRetain)
    {
        try {
            $pemeriksaanRetain->delete();
            
            return redirect()->route('pemeriksaan_retain.index')
                             ->with('success', 'Data pemeriksaan retain berhasil dipindahkan ke keranjang sampah.');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function showVerificationPage(Request $request)
    {
        // 1. Buat Query Dasar
        // Pastikan Anda menambahkan relasi 'verifiedBy' di Model
        $baseQuery = PemeriksaanRetain::with('creator', 'items', 'verifiedBy')
                        ->latest('tanggal'); // Urutkan berdasarkan tanggal dibuat

        // 2. Terapkan Filter Umum (dari form)
        $baseQuery->when($request->start_date, fn($q, $date) => $q->where('tanggal', '>=', $date));
        $baseQuery->when($request->end_date, fn($q, $date) => $q->where('tanggal', '<=', $date));

        $baseQuery->when($request->search, function ($q, $search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('hari', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%")
                    ->orWhereHas('items', function ($itemQuery) use ($search) {
                        $itemQuery->where('kode_produksi', 'like', "%{$search}%")
                                  ->orWhere('varian', 'like', "%{$search}%");
                    })
                    ->orWhereHas('creator', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        });

        // 3. Ambil SEMUA data (Pending, Verified, Revision) dalam satu query
        // Tidak ada lagi pemisahan query
        $pemeriksaanRetains = $baseQuery->paginate(20) // Ambil 20 data per halaman
                                       ->withQueryString();

        // 4. Kirim satu set data ke view
        // Variabel '$verifiedData' tidak diperlukan lagi
        return view('pemeriksaan_retain.verification', compact('pemeriksaanRetains'));
    }

    // Method untuk MENYIMPAN hasil verifikasi
    public function submitVerification(Request $request, PemeriksaanRetain $pemeriksaanRetain)
    {
        $request->validate([
            'status_spv' => 'required|in:1,2',
            'catatan_spv' => 'nullable|string|required_if:status_spv,2', // Wajib jika 'Revision'
        ]);

        try {
            $pemeriksaanRetain->update([
                'status_spv'  => $request->status_spv,
                'catatan_spv' => $request->catatan_spv,
                'verified_by' => Auth::user()->uuid, // Menggunakan UUID user yang login
                'verified_at' => now(),
            ]);

            return redirect()->route('pemeriksaan_retain.verification')
                            ->with('success', 'Data berhasil diverifikasi.');

        } catch (\Exception $e) {
            Log::error('Error verifying retain: ' . $e->getMessage());
            return redirect()->back()
                            ->with('error', 'Terjadi kesalahan saat menyimpan verifikasi.');
        }
    }
}