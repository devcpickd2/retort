<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Engineer; 
use Illuminate\Support\Facades\Auth;

class EngineerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // pastikan hanya user login
    }

    // Menampilkan semua data engineer sesuai UUID plant user login
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userPlantUuid = Auth::user()->plant; // ambil UUID plant user login

        $engineer = Engineer::where('plant', $userPlantUuid)
        ->when($search, function($query, $search) {
            $query->where('nama_engineer', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('engineer.index', compact('engineer'));
    }

    // Tampilkan form tambah engineer
    public function create()
    {
        return view('engineer.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_engineer' => 'required|string|max:255'
        ]);

        $user = Auth::user(); // ambil user login

        Engineer::create([
            'username' => $user->username,  // username dari user login
            'plant' => $user->plant,        // UUID plant dari user login
            'nama_engineer' => $request->nama_engineer
        ]);

        return redirect()->route('engineer.index')->with('success', 'Engineer berhasil ditambahkan');
    }

    // Tampilkan form edit engineer berdasarkan UUID
    public function edit($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $engineer = Engineer::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        return view('engineer.edit', compact('engineer'));
    }

    // Update data engineer
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'nama_engineer' => 'required|string|max:255'
        ]);

        $userPlantUuid = Auth::user()->plant;

        $engineer = Engineer::where('uuid', $uuid)
        ->where('plant', $userPlantUuid)
        ->firstOrFail();

        $engineer->update([
            'nama_engineer' => $request->nama_engineer
        ]);

        return redirect()->route('engineer.index')->with('success', 'Engineer berhasil diupdate');
    }

    // Hapus engineer
    public function destroy($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $engineer = Engineer::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        $engineer->delete();

        return redirect()->route('engineer.index')->with('success', 'Engineer berhasil dihapus');
    }
}
