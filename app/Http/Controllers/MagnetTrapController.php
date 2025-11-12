<?php

namespace App\Http\Controllers;

use App\Models\MagnetTrapModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;


class MagnetTrapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    // Memulai query builder
    $query = MagnetTrapModel::query();

    // 1. Filter berdasarkan pencarian nama produk
    $query->when($request->search, function ($q, $search) {
        // Ganti 'nama_produk' jika ingin mencari di kolom lain
        return $q->where('nama_produk', 'like', "%{$search}%");
    });

    // 2. Filter berdasarkan rentang tanggal (diambil dari kolom created_at)
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $startDate = $request->start_date . ' 00:00:00';
        $endDate = $request->end_date . ' 23:59:59';
        // Ganti 'created_at' jika kolom tanggal Anda berbeda
        $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    // 3. Ambil data yang sudah difilter, urutkan dari yang terbaru, dan paginasi
    // withQueryString() penting agar filter tetap aktif saat pindah halaman
    $data = $query->latest()->paginate(10)->withQueryString();

    // 4. Kirim data ke view
    return view('magnet_trap.IndexMagnetTrap', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ganti 'magnet_trap.create' jika nama file view Anda berbeda
        $produks = Produk::orderBy('nama_produk', 'asc')->get();
        return view('magnet_trap.CreateMagnetTrap ', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nama_produk' => 'required',
            'kode_batch' => 'required|string|max:255',
            'pukul' => 'required',
            'jumlah_temuan' => 'required|integer|min:0',
            'status' => 'required|in:v,x',
            'keterangan' => 'nullable|string',
            'produksi_id' => 'required|integer',
            'engineer_id' => 'required|integer',
        ]);

        // 3. Tambahkan UUID untuk record ini
        $validatedData['uuid'] = (string) Str::uuid();

        // 4. Tambahkan UUID user yang sedang login sebagai 'created_by'
        // Ini mengasumsikan Model User Anda punya kolom 'uuid'
        $validatedData['created_by'] = Auth::user()->uuid;

        // 5. Simpan semua data ke database
        MagnetTrapModel::create($validatedData);

        return redirect()->route('checklistmagnettrap.index')
                         ->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MagnetTrapModel  $checklistmagnettrap
     * @return \Illuminate\Http\Response
     */
    public function show(MagnetTrapModel $checklistmagnettrap)
    {
        return view('magnet_trap.show', compact('checklistmagnettrap'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MagnetTrapModel  $checklistmagnettrap
     * @return \Illuminate\Http\Response
     */
    public function edit(MagnetTrapModel $checklistmagnettrap)
    {
        $produks = Produk::orderBy('nama_produk', 'asc')->get();
        
        return view('magnet_trap.EditMagnetTrap', compact('checklistmagnettrap', 'produks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MagnetTrapModel  $checklistmagnettrap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MagnetTrapModel $checklistmagnettrap)
    {
         $request->validate([
            'nama_produk' => 'required',
            'kode_batch' => 'required|string|max:255',
            'pukul' => 'required',
            'jumlah_temuan' => 'required|integer|min:0',
            'status' => 'required|in:v,x',
            'keterangan' => 'nullable|string',
            'produksi_id' => 'required|integer',
            'engineer_id' => 'required|integer',
        ]);

        $checklistmagnettrap->update($request->all());

        return redirect()->route('checklistmagnettrap.index')
                         ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MagnetTrapModel  $checklistmagnettrap
     * @return \Illuminate\Http\Response
     */
    public function destroy(MagnetTrapModel $checklistmagnettrap)
    {
        $checklistmagnettrap->delete();

        return redirect()->route('checklistmagnettrap.index')
                         ->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Menampilkan halaman verifikasi untuk SPV.
     */
    public function showVerificationPage(Request $request)
    {
        // 1. Mulai query builder
        $query = MagnetTrapModel::query();

        // 2. Terapkan filter pencarian jika ada
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            
            // Ganti 'nama_produk' dan 'kode_batch' dengan nama kolom yang sesuai di database Anda
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_produk', 'like', '%' . $searchTerm . '%')
                  ->orWhere('kode_batch', 'like', '%' . $searchTerm . '%');
                // Tambahkan ->orWhere() lain jika ingin mencari di kolom lain
            });
        }

        // 3. Terapkan filter tanggal awal (start_date) jika ada
        if ($request->filled('start_date')) {
            // Ganti 'created_at' dengan nama kolom tanggal Anda (misal: 'tanggal_inspeksi')
            $query->whereDate('created_at', '>=', $request->input('start_date'));
        }

        // 4. Terapkan filter tanggal akhir (end_date) jika ada
        if ($request->filled('end_date')) {
            // Ganti 'created_at' dengan nama kolom tanggal Anda (misal: 'tanggal_inspeksi')
            $query->whereDate('created_at', '<=', $request->input('end_date'));
        }

        // 5. Eksekusi query dengan urutan terbaru, paginasi, dan tambahkan parameter filter ke link paginasi
        $data = $query->latest() // Mengurutkan dari yang terbaru (sama seperti sebelumnya)
                       ->paginate(10) // Paginasi data
                       ->appends($request->all()); // <-- Ini penting agar filter tetap aktif saat pindah halaman

        // 6. Kirim data ke view
        return view('magnet_trap.verification', compact('data'));
    }

    /**
     * Handle the SPV verification update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request, $uuid)
    {
        $request->validate([
            'status_spv' => 'required|in:1,2',
            'catatan_spv' => 'nullable|string|max:1000',
        ]);

        // Cari record berdasarkan kolom 'uuid'
        $magnetTrap = MagnetTrapModel::where('uuid', $uuid)->firstOrFail();

        $magnetTrap->status_spv = $request->status_spv;
        
        // Hanya simpan catatan jika statusnya adalah 'Revision', jika tidak, kosongkan.
        $magnetTrap->catatan_spv = ($request->status_spv == 2) ? $request->catatan_spv : null;

        $magnetTrap->verified_by_spv_uuid = Auth::id(); // Asumsi user yang login adalah SPV
        $magnetTrap->verified_at_spv = now();

        $magnetTrap->save();

        return redirect()->back()->with('success', 'Data berhasil diverifikasi.');
    }
}

