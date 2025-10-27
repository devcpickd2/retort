<?php

// app/HttpControllers/RawMaterialInspectionController.php

namespace App\Http\Controllers;

use App\Models\RawMaterialInspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RawMaterialInspectionController extends Controller
{
    // Daftar field boolean (dari tombol OK/Not OK)
    private $booleanFields = [
        'mobil_check_warna', 'mobil_check_kotoran', 'mobil_check_aroma', 'mobil_check_kemasan',
        'analisa_ka_ffa', 'analisa_logo_halal', 'dokumen_halal_berlaku'
    ];

    public function index(Request $request)
    {
        // Mulai query
        $query = RawMaterialInspection::query();

        // Terapkan filter tanggal awal (start_date)
        $query->when($request->filled('start_date'), function ($q) use ($request) {
            // Asumsi kolom tanggal di database adalah 'setup_kedatangan'
            $q->whereDate('setup_kedatangan', '>=', $request->start_date);
        });

        // Terapkan filter tanggal akhir (end_date)
        $query->when($request->filled('end_date'), function ($q) use ($request) {
            $q->whereDate('setup_kedatangan', '<=', $request->end_date);
        });

        // Terapkan filter pencarian (search)
        $query->when($request->filled('search'), function ($q) use ($request) {
            $search = $request->search;
            // Grup 'where' agar 'orWhere' tidak mengganggu filter tanggal
            $q->where(function ($subQuery) use ($search) {
                $subQuery->where('bahan_baku', 'like', "%{$search}%")
                        ->orWhere('supplier', 'like', "%{$search}%");
            });
        });

        // Ambil data setelah difilter, urutkan, dan paginasi
        $inspections = $query->latest() // Mengurutkan dari yang terbaru
                            ->paginate(10)
                            ->withQueryString(); // <-- Penting agar filter tetap ada di link paginasi

        return view('raw_material.IndexRawMaterial', compact('inspections'));
    }

    public function create()
    {
        return view('raw_material.CreateRawMaterial');
    }

    public function store(Request $request)
    {
        // PERUBAHAN: Menambahkan validasi untuk boolean fields
        $booleanFieldRule = 'required|in:0,1';
        
        $validationRules = [
            'setup_kedatangan' => 'required|date',
            'do_po' => 'required|string|max:255',
            'bahan_baku' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
            'nopol_mobil' => 'required|string|max:255',
            'suhu_mobil' => 'required|string|max:50',
            'kondisi_mobil' => 'required|string',
            'no_segel' => 'required|string|max:255',
            'suhu_daging' => 'required|numeric',
            'analisa_negara_asal' => 'required|string|max:255',
            'analisa_produsen' => 'required|string|max:255',
            'dokumen_halal_file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'dokumen_coa_file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            
            'details' => 'required|array|min:1',
            'details.*.kode_batch' => 'required|string',
            'details.*.tanggal_produksi' => 'required|date',
            'details.*.exp' => 'required|date|after:details.*.tanggal_produksi',
            'details.*.jumlah' => 'required|numeric|min:0',
            'details.*.jumlah_sampel' => 'required|numeric|min:0',
            'details.*.jumlah_reject' => 'required|numeric|min:0',
        ];

        // Tambahkan aturan validasi untuk semua boolean field
        foreach ($this->booleanFields as $field) {
            $validationRules[$field] = $booleanFieldRule;
        }

        $request->validate($validationRules);

        DB::beginTransaction();
        try {
            $data = $request->except(['_token', 'details', 'dokumen_halal_file', 'dokumen_coa_file']);

            // PERUBAHAN: Handle boolean (OK/Not OK) fields
            // Konversi '1' (OK) menjadi true, '0' (Not OK) menjadi false
            foreach ($this->booleanFields as $field) {
                $data[$field] = $request->input($field) == '1';
            }
            
            // Handle file upload
            if ($request->hasFile('dokumen_halal_file')) {
                $data['dokumen_halal_file'] = $request->file('dokumen_halal_file')->store('halal_docs', 'public');
            }
            if ($request->hasFile('dokumen_coa_file')) {
                $data['dokumen_coa_file'] = $request->file('dokumen_coa_file')->store('coa_docs', 'public');
            }

            // Create Inspection
            $inspection = RawMaterialInspection::create($data);

            // Create Product Details
            if ($request->has('details')) {
                $inspection->productDetails()->createMany($request->details);
            }

            DB::commit();
            return redirect()->route('inspections.index')->with('success', 'Data berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    
    public function show(RawMaterialInspection $inspection)
    {
        // Load relasi productDetails agar bisa di-loop di view
        // $inspection sudah otomatis di-fetch berdasarkan 'uuid'
        $inspection->load('productDetails');
        
        // Arahkan ke view baru untuk 'show'
        return view('raw_material.ShowRawMaterial', compact('inspection'));
    }

    public function edit(RawMaterialInspection $inspection)
    {
        // Load relasi productDetails agar bisa di-loop di view
        // $inspection sudah otomatis di-fetch berdasarkan 'uuid'
        // berkat method getRouteKeyName() di model
        $inspection->load('productDetails');
        
        return view('raw_material.EditRawMaterial', compact('inspection'));
    }

    /**
     * Mengupdate data inspeksi yang ada di database.
     */
    public function update(Request $request, RawMaterialInspection $inspection)
    {
        // Aturan validasi untuk tombol OK/Not OK
        $booleanFieldRule = 'required|in:0,1';
        
        // Validasi lengkap untuk semua field
        $validationRules = [
            'setup_kedatangan' => 'required|date',
            'do_po' => 'required|string|max:255',
            'bahan_baku' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
            'nopol_mobil' => 'required|string|max:255',
            'suhu_mobil' => 'required|string|max:50',
            'kondisi_mobil' => 'required|string',
            'no_segel' => 'required|string|max:255',
            'suhu_daging' => 'required|numeric',
            'analisa_negara_asal' => 'required|string|max:255',
            'analisa_produsen' => 'required|string|max:255',
            'keterangan' => 'nullable|string',

            // Validasi file: nullable agar tidak wajib diisi ulang
            'dokumen_halal_file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'dokumen_coa_file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            
            // Validasi untuk detail produk (repeatable items)
            'details' => 'required|array|min:1',
            'details.*.kode_batch' => 'required|string',
            'details.*.tanggal_produksi' => 'required|date',
            'details.*.exp' => 'required|date|after:details.*.tanggal_produksi',
            'details.*.jumlah' => 'required|numeric|min:0',
            'details.*.jumlah_sampel' => 'required|numeric|min:0',
            'details.*.jumlah_reject' => 'required|numeric|min:0',
        ];

        // Tambahkan aturan validasi untuk semua boolean field
        // $this->booleanFields harus didefinisikan di atas (di dalam class)
        foreach ($this->booleanFields as $field) {
            $validationRules[$field] = $booleanFieldRule;
        }

        $request->validate($validationRules);

        DB::beginTransaction();
        try {
            // Ambil semua data kecuali token, method, details, dan file
            $data = $request->except([
                '_token', 
                '_method', 
                'details', 
                'dokumen_halal_file', 
                'dokumen_coa_file'
            ]);

            // Handle boolean (OK/Not OK) fields
            // Konversi '1' (OK) menjadi true, '0' (Not OK) menjadi false
            foreach ($this->booleanFields as $field) {
                $data[$field] = $request->input($field) == '1';
            }

            // Handle file upload jika ada file baru
            if ($request->hasFile('dokumen_halal_file')) {
                // Hapus file lama jika ada
                if ($inspection->dokumen_halal_file) {
                    Storage::disk('public')->delete($inspection->dokumen_halal_file);
                }
                // Simpan file baru
                $data['dokumen_halal_file'] = $request->file('dokumen_halal_file')->store('halal_docs', 'public');
            }
            
            if ($request->hasFile('dokumen_coa_file')) {
                 // Hapus file lama jika ada
                if ($inspection->dokumen_coa_file) {
                    Storage::disk('public')->delete($inspection->dokumen_coa_file);
                }
                // Simpan file baru
                $data['dokumen_coa_file'] = $request->file('dokumen_coa_file')->store('coa_docs', 'public');
            }

            // Update data utama di tabel 'raw_material_inspections'
            $inspection->update($data);

            // Hapus detail lama dan buat yang baru (strategi paling sederhana)
            $inspection->productDetails()->delete();
            
            if ($request->has('details')) {
                // Buat ulang product details
                // Eloquent akan otomatis mengisi 'raw_material_inspection_uuid'
                // berdasarkan relasi yang sudah kita definisikan di Model
                $inspection->productDetails()->createMany($request->details);
            }

            DB::commit();
            
            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('inspections.index')->with('success', 'Data berhasil diupdate.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Jika terjadi error, kembali ke form edit dengan pesan error dan input lama
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(RawMaterialInspection $inspection)
    {
        try {
            DB::beginTransaction();
            
            Storage::disk('public')->delete($inspection->dokumen_halal_file);
            Storage::disk('public')->delete($inspection->dokumen_coa_file);
            
            $inspection->productDetails()->delete();
            $inspection->delete();
            
            DB::commit();
            return redirect()->route('inspections.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}