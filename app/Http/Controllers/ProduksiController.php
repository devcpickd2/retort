<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produksi;
use Illuminate\Support\Facades\Auth; // gunakan Auth untuk ambil user login

class ProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // pastikan hanya user login
    }

    // Menampilkan semua data produksi sesuai plant user login
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userPlantUuid = Auth::user()->plant; // UUID plant user login

        $produksi = Produksi::where('plant', $userPlantUuid) // filter sesuai plant
            ->when($search, function($query, $search) {
                $query->where('nama_karyawan', 'like', "%{$search}%")
                      ->orWhere('area', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('produksi.index', compact('produksi'));
    }

    // Tampilkan form tambah produksi
    public function create()
    {
        return view('produksi.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'area' => 'required|string|max:255'
        ]);

        $user = Auth::user(); // ambil data user login

        Produksi::create([
            'username' => $user->username,   // username dari user login
            'plant' => $user->plant,         // plant UUID dari user login
            'nama_karyawan' => $request->nama_karyawan,
            'area' => $request->area
        ]);

        return redirect()->route('produksi.index')->with('success', 'Produksi berhasil ditambahkan');
    }

    // Tampilkan form edit
    public function edit($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $produksi = Produksi::where('uuid', $uuid)
                            ->where('plant', $userPlantUuid) // hanya edit produksi sesuai plant
                            ->firstOrFail();

        return view('produksi.edit', compact('produksi'));
    }

    // Update data produksi
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'area' => 'required|string|max:255'
        ]);

        $userPlantUuid = Auth::user()->plant;

        $produksi = Produksi::where('uuid', $uuid)
                            ->where('plant', $userPlantUuid)
                            ->firstOrFail();

        $produksi->update([
            'nama_karyawan' => $request->nama_karyawan,
            'area' => $request->area
        ]);

        return redirect()->route('produksi.index')->with('success', 'Produksi berhasil diupdate');
    }

    // Hapus data produksi
    public function destroy($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $produksi = Produksi::where('uuid', $uuid)
                            ->where('plant', $userPlantUuid)
                            ->firstOrFail();

        $produksi->delete();

        return redirect()->route('produksi.index')->with('success', 'Produksi berhasil dihapus');
    }
}
