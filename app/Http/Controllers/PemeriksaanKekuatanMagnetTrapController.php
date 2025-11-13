<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanKekuatanMagnetTrap; // Model diubah
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

// Nama class diubah
class PemeriksaanKekuatanMagnetTrapController extends Controller
{
    /**
     * Menampilkan daftar data dengan filter.
     */
    public function index(Request $request)
    {
        // Model & variabel diubah
        $query = PemeriksaanKekuatanMagnetTrap::with('creator')->latest();

        // Filter Tanggal
        if ($request->filled('start_date')) {
            $query->where('tanggal', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('tanggal', '<=', $request->end_date);
        }

        // Filter Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->Where('kondisi_magnet_trap', 'like', "%{$search}%")
                    ->orWhere('petugas_qc', 'like', "%{$search}%");
            });
        }

        // Variabel diubah
        $pemeriksaanKekuatanMagnetTraps = $query->paginate(15)->appends($request->query());

        // View path & variabel diubah
        return view('pemeriksaan-kekuatan-magnet-trap.index', compact('pemeriksaanKekuatanMagnetTraps'));
    }

    /**
     * Menampilkan form create.
     */
    public function create()
    {
        // View path diubah
        return view('pemeriksaan-kekuatan-magnet-trap.create');
    }

    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->all();
        $validatedData['created_by'] = Auth::user()->uuid;
        $validatedData['parameter_sesuai'] = $request->input('parameter_sesuai', 0) == '1';

        // Model diubah
        PemeriksaanKekuatanMagnetTrap::create($validatedData);

        // Route name diubah
        return redirect()->route('pemeriksaan-kekuatan-magnet-trap.index')
                         ->with('success', 'Pemeriksaan Kekuatan Magnet Trap berhasil dibuat.');
    }

    /**
     * Menampilkan detail data.
     */
    // Variabel & Type-hint diubah
    public function show(PemeriksaanKekuatanMagnetTrap $pemeriksaanKekuatanMagnetTrap)
    {
        // View path & variabel diubah
        return view('pemeriksaan-kekuatan-magnet-trap.show', compact('pemeriksaanKekuatanMagnetTrap'));
    }

    /**
     * Menampilkan form edit.
     */
    // Variabel & Type-hint diubah
    public function edit(PemeriksaanKekuatanMagnetTrap $pemeriksaanKekuatanMagnetTrap)
    {
        // View path & variabel diubah
        return view('pemeriksaan-kekuatan-magnet-trap.edit', compact('pemeriksaanKekuatanMagnetTrap'));
    }

    /**
     * Update data.
     */
    // Variabel & Type-hint diubah
    public function update(Request $request, PemeriksaanKekuatanMagnetTrap $pemeriksaanKekuatanMagnetTrap)
    {
        $validatedData = $request->all();
        $validatedData['parameter_sesuai'] = $request->input('parameter_sesuai', 0) == '1';

        $pemeriksaanKekuatanMagnetTrap->update($validatedData);

        // Route name diubah
        return redirect()->route('pemeriksaan-kekuatan-magnet-trap.index')
                         ->with('success', 'Pemeriksaan Kekuatan Magnet Trap berhasil diperbarui.');
    }

    /**
     * Menghapus data (Soft Delete).
     */
    // Variabel & Type-hint diubah
    public function destroy(PemeriksaanKekuatanMagnetTrap $pemeriksaanKekuatanMagnetTrap)
    {
        $pemeriksaanKekuatanMagnetTrap->delete();
        // Route name diubah
        return redirect()->route('pemeriksaan-kekuatan-magnet-trap.index')
                         ->with('success', 'Pemeriksaan Kekuatan Magnet Trap berhasil dihapus.');
    }

    // --- METODE VERIFIKASI (SPV QC) ---

    /**
     * Menampilkan halaman verifikasi untuk SPV (menampilkan semua data).
     */
    public function verificationSpv(Request $request)
    {
        // Model diubah
        $query = PemeriksaanKekuatanMagnetTrap::query()->latest(); 

        // Filter Tanggal
        if ($request->filled('start_date')) {
            $query->where('tanggal', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('tanggal', '<=', $request->end_date);
        }

        // Filter Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
             $query->where(function ($q) use ($search) {
                $q->Where('kondisi_magnet_trap', 'like', "%{$search}%")
                    ->orWhere('petugas_qc', 'like', "%{$search}%");
            });
        }

        // Variabel diubah
        $pemeriksaanKekuatanMagnetTraps = $query->with('creator', 'verifier')
            ->paginate(15)
            ->appends($request->query());

        // View path & variabel diubah
        return view('pemeriksaan-kekuatan-magnet-trap.verification-spv', compact('pemeriksaanKekuatanMagnetTraps'));
    }

    /**
     * Memproses verifikasi dari SPV.
     */
    // Variabel & Type-hint diubah
    public function verifySpv(Request $request, PemeriksaanKekuatanMagnetTrap $pemeriksaanKekuatanMagnetTrap)
    {
        $validatedData = $request->validate([
            'status_spv' => ['required', Rule::in([1, 2])], 
            'catatan_spv' => ['nullable', 'required_if:status_spv,2', 'string'],
        ]);

        try {
            $pemeriksaanKekuatanMagnetTrap->status_spv = $validatedData['status_spv'];
            $pemeriksaanKekuatanMagnetTrap->catatan_spv = $validatedData['catatan_spv'];
            $pemeriksaanKekuatanMagnetTrap->verified_by = Auth::user()->uuid; 
            $pemeriksaanKekuatanMagnetTrap->verified_at = now();
            $pemeriksaanKekuatanMagnetTrap->save();

            $message = $validatedData['status_spv'] == 1 ? 'Data berhasil diverifikasi.' : 'Data ditandai untuk revisi.';
            // Route name diubah
            return redirect()->route('pemeriksaan-kekuatan-magnet-trap.verification.spv')->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Error verifikasi SPV Magnet Trap: ' . $e->getMessage());
            // Route name diubah
            return redirect()->route('pemeriksaan-kekuatan-magnet-trap.verification.spv')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
}