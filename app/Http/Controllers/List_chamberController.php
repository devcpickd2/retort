<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\List_chamber; 
use Illuminate\Support\Facades\Auth;

class List_chamberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // pastikan hanya user login
    }

    // Menampilkan semua data list_chamber sesuai UUID plant user login
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userPlantUuid = Auth::user()->plant; // ambil UUID plant user login

        $list_chamber = List_chamber::where('plant', $userPlantUuid)
        ->when($search, function($query, $search) {
            $query->where('no_chamber', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('list_chamber.index', compact('list_chamber'));
    }

    // Tampilkan form tambah list_chamber
    public function create()
    {
        return view('list_chamber.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'no_chamber' => 'required|string|max:255'
        ]);

        $user = Auth::user(); // ambil user login

        List_chamber::create([
            'username' => $user->username,  // username dari user login
            'plant' => $user->plant,        // UUID plant dari user login
            'no_chamber' => $request->no_chamber
        ]);

        return redirect()->route('list_chamber.index')->with('success', 'List Chamber berhasil ditambahkan');
    }

    // Tampilkan form edit list_chamber berdasarkan UUID
    public function edit($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $list_chamber = List_chamber::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        return view('list_chamber.edit', compact('list_chamber'));
    }

    // Update data list_chamber
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'no_chamber' => 'required|string|max:255'
        ]);

        $userPlantUuid = Auth::user()->plant;

        $list_chamber = List_chamber::where('uuid', $uuid)
        ->where('plant', $userPlantUuid)
        ->firstOrFail();

        $list_chamber->update([
            'no_chamber' => $request->no_chamber
        ]);

        return redirect()->route('list_chamber.index')->with('success', 'List Chamber berhasil diupdate');
    }

    // Hapus list_chamber
    public function destroy($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $list_chamber = List_chamber::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        $list_chamber->delete();

        return redirect()->route('list_chamber.index')->with('success', 'List Chamber berhasil dihapus');
    }
}
