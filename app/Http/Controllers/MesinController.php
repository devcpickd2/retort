<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesin; 
use Illuminate\Support\Facades\Auth;

class MesinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // pastikan hanya user login
    }

    // Menampilkan semua data mesin sesuai UUID plant user login
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userPlantUuid = Auth::user()->plant; // ambil UUID plant user login

        $mesin = Mesin::where('plant', $userPlantUuid)
        ->when($search, function($query, $search) {
            $query->where('nama_mesin', 'like', "%{$search}%")
            ->orWhere('jenis_mesin', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('mesin.index', compact('mesin'));
    }

    // Tampilkan form tambah mesin
    public function create()
    {
        return view('mesin.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_mesin' => 'required|string|max:255',
            'jenis_mesin' => 'required|string|max:255'
        ]);

        $user = Auth::user(); 

        Mesin::create([
            'username' => $user->username,  
            'plant' => $user->plant,     
            'nama_mesin' => $request->nama_mesin,
            'jenis_mesin' => $request->jenis_mesin
        ]);

        return redirect()->route('mesin.index')->with('success', 'Mesin berhasil ditambahkan');
    }

    // Tampilkan form edit mesin berdasarkan UUID
    public function edit($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $mesin = Mesin::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        return view('mesin.edit', compact('mesin'));
    }

    // Update data mesin
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'nama_mesin' => 'required|string|max:255',
            'jenis_mesin' => 'required|string|max:255'
        ]);

        $userPlantUuid = Auth::user()->plant;

        $mesin = Mesin::where('uuid', $uuid)
        ->where('plant', $userPlantUuid)
        ->firstOrFail();

        $mesin->update([
            'nama_mesin' => $request->nama_mesin,
            'jenis_mesin' => $request->jenis_mesin
        ]);

        return redirect()->route('mesin.index')->with('success', 'Mesin berhasil diupdate');
    }

    // Hapus mesin
    public function destroy($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $mesin = Mesin::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        $mesin->delete();

        return redirect()->route('mesin.index')->with('success', 'Mesin berhasil dihapus');
    }
}
