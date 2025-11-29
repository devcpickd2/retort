<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\supplier_rm; 
use Illuminate\Support\Facades\Auth;

class Supplier_rmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // pastikan hanya user login
    }

    // Menampilkan semua data supplier_rm sesuai UUID plant user login
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userPlantUuid = Auth::user()->plant; // ambil UUID plant user login

        $supplier_rm = supplier_rm::where('plant', $userPlantUuid)
        ->when($search, function($query, $search) {
            $query->where('nama_supplier', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('supplier_rm.index', compact('supplier_rm'));
    }

    // Tampilkan form tambah supplier_rm
    public function create()
    {
        return view('supplier_rm.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255'
        ]);

        $user = Auth::user(); // ambil user login

        supplier_rm::create([
            'username' => $user->username,  // username dari user login
            'plant' => $user->plant,        // UUID plant dari user login
            'nama_supplier' => $request->nama_supplier
        ]);

        return redirect()->route('supplier_rm.index')->with('success', 'Supplier RM berhasil ditambahkan');
    }

    // Tampilkan form edit supplier_rm berdasarkan UUID
    public function edit($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $supplier_rm = supplier_rm::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        return view('supplier_rm.edit', compact('supplier_rm'));
    }

    // Update data supplier_rm
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255'
        ]);

        $userPlantUuid = Auth::user()->plant;

        $supplier_rm = supplier_rm::where('uuid', $uuid)
        ->where('plant', $userPlantUuid)
        ->firstOrFail();

        $supplier_rm->update([
            'nama_supplier' => $request->nama_supplier
        ]);

        return redirect()->route('supplier_rm.index')->with('success', 'Supplier RM berhasil diupdate');
    }

    // Hapus supplier_rm
    public function destroy($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $supplier_rm = supplier_rm::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        $supplier_rm->delete();

        return redirect()->route('supplier_rm.index')->with('success', 'Supplier RM berhasil dihapus');
    }
}
