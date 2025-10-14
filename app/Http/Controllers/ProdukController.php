<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; 
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // pastikan hanya user login
    }

    // Menampilkan semua data produk sesuai UUID plant user login
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userPlantUuid = Auth::user()->plant; // ambil UUID plant user login

        $produk = Produk::where('plant', $userPlantUuid)
        ->when($search, function($query, $search) {
            $query->where('nama_produk', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('produk.index', compact('produk'));
    }

    // Tampilkan form tambah produk
    public function create()
    {
        return view('produk.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255'
        ]);

        $user = Auth::user(); // ambil user login

        Produk::create([
            'username' => $user->username,  // username dari user login
            'plant' => $user->plant,        // UUID plant dari user login
            'nama_produk' => $request->nama_produk
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Tampilkan form edit produk berdasarkan UUID
    public function edit($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $produk = Produk::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        return view('produk.edit', compact('produk'));
    }

    // Update data produk
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255'
        ]);

        $userPlantUuid = Auth::user()->plant;

        $produk = Produk::where('uuid', $uuid)
        ->where('plant', $userPlantUuid)
        ->firstOrFail();

        $produk->update([
            'nama_produk' => $request->nama_produk
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate');
    }

    // Hapus produk
    public function destroy($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $produk = Produk::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
