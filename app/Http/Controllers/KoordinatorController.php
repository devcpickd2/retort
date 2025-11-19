<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Koordinator; 
use Illuminate\Support\Facades\Auth;

class KoordinatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // pastikan hanya user login
    }

    // Menampilkan semua data koordinator sesuai UUID plant user login
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userPlantUuid = Auth::user()->plant; // ambil UUID plant user login

        $koordinator = Koordinator::where('plant', $userPlantUuid)
        ->when($search, function($query, $search) {
            $query->where('nama_koordinator', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('koordinator.index', compact('koordinator'));
    }

    // Tampilkan form tambah koordinator
    public function create()
    {
        return view('koordinator.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_koordinator' => 'required|string|max:255'
        ]);

        $user = Auth::user(); // ambil user login

        Koordinator::create([
            'username' => $user->username,  // username dari user login
            'plant' => $user->plant,        // UUID plant dari user login
            'nama_koordinator' => $request->nama_koordinator
        ]);

        return redirect()->route('koordinator.index')->with('success', 'Koordinator Area berhasil ditambahkan');
    }

    // Tampilkan form edit koordinator berdasarkan UUID
    public function edit($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $koordinator = Koordinator::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        return view('koordinator.edit', compact('koordinator'));
    }

    // Update data koordinator
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'nama_koordinator' => 'required|string|max:255'
        ]);

        $userPlantUuid = Auth::user()->plant;

        $koordinator = Koordinator::where('uuid', $uuid)
        ->where('plant', $userPlantUuid)
        ->firstOrFail();

        $koordinator->update([
            'nama_koordinator' => $request->nama_koordinator
        ]);

        return redirect()->route('koordinator.index')->with('success', 'Koordinator Area berhasil diupdate');
    }

    // Hapus koordinator
    public function destroy($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $koordinator = Koordinator::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        $koordinator->delete();

        return redirect()->route('koordinator.index')->with('success', 'Koordinator Area berhasil dihapus');
    }
}
