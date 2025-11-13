<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use Illuminate\Http\Request; // <-- Pastikan ini di-import
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class BeritaAcaraController extends Controller
{
    /**
     * Menampilkan daftar data.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request) // <-- 1. Tambahkan Request $request
    {
        // 2. Mulai query builder
        $query = BeritaAcara::with('creator')->latest();

        // 3. Tambahkan logika filter (dicopy dari verificationSpv)
        // Filter Tanggal (menggunakan tanggal_kedatangan sebagai acuan)
        if ($request->filled('start_date')) {
            $query->where('tanggal_kedatangan', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('tanggal_kedatangan', '<=', $request->end_date);
        }

        // Filter Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor', 'like', "%{$search}%")
                    ->orWhere('supplier', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%");
            });
        }

        // 4. Eksekusi query dengan paginasi dan appends
        $beritaAcaras = $query->paginate(15)->appends($request->query());

        return view('berita-acara.index', compact('beritaAcaras'));
    }

    /**
     * Menampilkan form create.
     */
    public function create()
    {
        return view('berita-acara.create');
    }

    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        // Validasi bisa ditambahkan di sini
        $validatedData = $request->all(); // Sebaiknya divalidasi

        // Menambahkan created_by (sesuai foreign key 'uuid' di tabel users)
        $validatedData['created_by'] = Auth::user()->uuid;

        // Handle checkbox (jika tidak dicentang, value-nya null)
        $checkboxes = [
            'keputusan_pengembalian', 'keputusan_potongan_harga', 'keputusan_sortir',
            'keputusan_penukaran_barang', 'keputusan_penggantian_biaya'
        ];
        foreach ($checkboxes as $cb) {
            $validatedData[$cb] = $request->has($cb);
        }

        BeritaAcara::create($validatedData);

        return redirect()->route('berita-acara.index')
                         ->with('success', 'Berita Acara berhasil dibuat.');
    }

    /**
     * Menampilkan detail data.
     */
    public function show(BeritaAcara $beritaAcara)
    {
        return view('berita-acara.show', compact('beritaAcara'));
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(BeritaAcara $beritaAcara)
    {
        return view('berita-acara.edit', compact('beritaAcara'));
    }

    /**
     * Update data.
     */
    public function update(Request $request, BeritaAcara $beritaAcara)
    {
        $validatedData = $request->all(); // Sebaiknya divalidasi

        // Handle checkbox
        $checkboxes = [
            'keputusan_pengembalian', 'keputusan_potongan_harga', 'keputusan_sortir',
            'keputusan_penukaran_barang', 'keputusan_penggantian_biaya'
        ];
        foreach ($checkboxes as $cb) {
            $validatedData[$cb] = $request->has($cb);
        }

        $beritaAcara->update($validatedData);

        return redirect()->route('berita-acara.index')
                         ->with('success', 'Berita Acara berhasil diperbarui.');
    }

    /**
     * Menghapus data (Soft Delete).
     */
    public function destroy(BeritaAcara $beritaAcara)
    {
        $beritaAcara->delete();
        return redirect()->route('berita-acara.index')
                         ->with('success', 'Berita Acara berhasil dihapus.');
    }

    // --- METODE VERIFIKASI (SESUAI CONTOH ANDA) ---

    /**
     * Menampilkan halaman verifikasi untuk SPV.
     */
    public function verificationSpv(Request $request)
    {
        // Logika filter di sini SUDAH BENAR dan tidak perlu diubah.
        $query = BeritaAcara::query()->latest(); // Hanya tampilkan yg pending

        // Filter Tanggal
        if ($request->filled('start_date')) {
            $query->where('tanggal_kedatangan', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('tanggal_kedatangan', '<=', $request->end_date);
        }

        // Filter Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor', 'like', "%{$search}%")
                    ->orWhere('supplier', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%");
            });
        }

        $beritaAcaras = $query->with('creator')
            ->paginate(15)
            ->appends($request->query());

        return view('berita-acara.verification-spv', compact('beritaAcaras'));
    }

    /**
     * Memproses verifikasi dari SPV.
     */
    public function verifySpv(Request $request, BeritaAcara $beritaAcara)
    {
        // Validasi
        $validatedData = $request->validate([
            'status_spv' => [
                'required',
                Rule::in([1, 2]), // Harus 1 (Verified) atau 2 (Revision)
            ],
            'catatan_spv' => [
                'nullable',
                'required_if:status_spv,2', // Wajib jika status = 2 (Revision)
                'string',
            ],
        ]);

        try {
            // Update data disposisi
            $beritaAcara->status_spv = $validatedData['status_spv'];
            $beritaAcara->catatan_spv = $validatedData['catatan_spv'];
            // Gunakan UUID user yang login, sesuai skema migration
            $beritaAcara->spv_verified_by = Auth::user()->uuid; 
            $beritaAcara->spv_verified_at = now();
            $beritaAcara->save();

            $message = $validatedData['status_spv'] == 1 ? 'Data berhasil diverifikasi.' : 'Data ditandai untuk revisi.';
            return redirect()->route('berita-acara.verification.spv')->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Error verifikasi SPV: ' . $e->getMessage());
            return redirect()->route('berita-acara.verification.spv')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
}