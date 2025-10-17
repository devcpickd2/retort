<?php

// app/Http/Controllers/RawMaterialInspectionController.php

namespace App\Http\Controllers;

use App\Models\RawMaterialInspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RawMaterialInspectionController extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $inspections = RawMaterialInspection::latest()->paginate(10);
        return view('raw_material.IndexRawMaterial', compact('inspections'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('raw_material.CreateRawMaterial');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // Validasi bisa ditambahkan di sini sesuai kebutuhan
        $request->validate([
            'bahan_baku' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
            // ...tambahkan validasi lainnya
            'details.*.kode_batch' => 'required|string',
            'details.*.tanggal_produksi' => 'required|date',
            'details.*.exp' => 'required|date',
            'details.*.jumlah' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->except(['_token', 'details', 'dokumen_halal_file', 'dokumen_coa_file']);
            
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
                foreach ($request->details as $detail) {
                    $inspection->productDetails()->create($detail);
                }
            }

            DB::commit();
            return redirect()->route('inspections.index')->with('success', 'Data berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    
    // Menampilkan form edit
    public function edit(RawMaterialInspection $inspection)
    {
        return view('inspections.edit', compact('inspection'));
    }

    // Mengupdate data
    public function update(Request $request, RawMaterialInspection $inspection)
    {
        // Validasi
        $request->validate([
            'bahan_baku' => 'required|string|max:255',
            // ...tambahkan validasi lainnya
        ]);

        DB::beginTransaction();
        try {
            $data = $request->except(['_token', '_method', 'details', 'dokumen_halal_file', 'dokumen_coa_file']);

            // Handle file upload jika ada file baru
            if ($request->hasFile('dokumen_halal_file')) {
                if ($inspection->dokumen_halal_file) {
                    Storage::disk('public')->delete($inspection->dokumen_halal_file);
                }
                $data['dokumen_halal_file'] = $request->file('dokumen_halal_file')->store('halal_docs', 'public');
            }
            if ($request->hasFile('dokumen_coa_file')) {
                 if ($inspection->dokumen_coa_file) {
                    Storage::disk('public')->delete($inspection->dokumen_coa_file);
                }
                $data['dokumen_coa_file'] = $request->file('dokumen_coa_file')->store('coa_docs', 'public');
            }

            // Update Inspection
            $inspection->update($data);

            // Hapus detail lama dan buat yang baru (simplifikasi)
            $inspection->productDetails()->delete();
            if ($request->has('details')) {
                foreach ($request->details as $detail) {
                    $inspection->productDetails()->create($detail);
                }
            }

            DB::commit();
            return redirect()->route('inspections.index')->with('success', 'Data berhasil diupdate.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    // Menghapus data (Soft Delete)
    public function destroy(RawMaterialInspection $inspection)
    {
        $inspection->delete();
        return redirect()->route('inspections.index')->with('success', 'Data berhasil dihapus.');
    }

}
