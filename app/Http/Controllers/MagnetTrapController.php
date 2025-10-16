<?php

namespace App\Http\Controllers;

use App\Models\MagnetTrapModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Produk;


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
        // 2. Lakukan validasi seperti biasa
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

        // 3. Tambahkan UUID ke dalam data yang akan disimpan
        $validatedData['uuid'] = (string) Str::uuid();

        // 4. Simpan semua data ke database
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
}

