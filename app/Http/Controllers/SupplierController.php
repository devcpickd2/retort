<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier; 
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // pastikan hanya user login
    }

    // Menampilkan semua data supplier sesuai UUID plant user login
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userPlantUuid = Auth::user()->plant; // ambil UUID plant user login

        $supplier = Supplier::where('plant', $userPlantUuid)
        ->when($search, function($query, $search) {
            $query->where('nama_supplier', 'like', "%{$search}%")
            ->orWhere('jenis_barang', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('supplier.index', compact('supplier'));
    }

    // Tampilkan form tambah supplier
    public function create()
    {
        return view('supplier.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255'
        ]);

        $user = Auth::user();

        Supplier::create([
            'username' => $user->username,  
            'plant' => $user->plant,       
            'nama_supplier' => $request->nama_supplier,
            'jenis_barang' => $request->jenis_barang
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan');
    }

    // Tampilkan form edit supplier berdasarkan UUID
    public function edit($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $supplier = Supplier::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        return view('supplier.edit', compact('supplier'));
    }

    // Update data supplier
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255'
        ]);

        $userPlantUuid = Auth::user()->plant;

        $supplier = Supplier::where('uuid', $uuid)
        ->where('plant', $userPlantUuid)
        ->firstOrFail();

        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'jenis_barang' => $request->jenis_barang
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diupdate');
    }

    // Hapus supplier
    public function destroy($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $supplier = Supplier::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus');
    }
}
