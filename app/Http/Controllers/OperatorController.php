<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator; 
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    // Menampilkan semua data operator sesuai UUID plant user login
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userPlantUuid = Auth::user()->plant; 

        $operator = Operator::where('plant', $userPlantUuid)
        ->when($search, function($query, $search) {
            $query->where('nama_karyawan', 'like', "%{$search}%")
            ->orWhere('bagian', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('operator.index', compact('operator'));
    }

    // Tampilkan form tambah operator
    public function create()
    {
        return view('operator.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'bagian' => 'required|string|max:255'
        ]);

        $user = Auth::user(); // ambil user login

        Operator::create([
            'username' => $user->username,  // username dari user login
            'plant' => $user->plant,        // UUID plant dari user login
            'nama_karyawan' => $request->nama_karyawan,
            'bagian' => $request->bagian
        ]);

        return redirect()->route('operator.index')->with('success', 'Data Karyawan Pendukung berhasil ditambahkan');
    }

    // Tampilkan form edit operator berdasarkan UUID
    public function edit($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $operator = Operator::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        return view('operator.edit', compact('operator'));
    }

    // Update data operator
    public function update(Request $request, $uuid)
    {
        $request->validate([
         'nama_karyawan' => 'required|string|max:255',
         'bagian' => 'required|string|max:255'
     ]);

        $userPlantUuid = Auth::user()->plant;

        $operator = Operator::where('uuid', $uuid)
        ->where('plant', $userPlantUuid)
        ->firstOrFail();

        $operator->update([
            'nama_karyawan' => $request->nama_karyawan,
            'bagian' => $request->bagian
        ]);

        return redirect()->route('operator.index')->with('success', 'Data Karyawan Pendukung berhasil diupdate');
    }

    // Hapus operator
    public function destroy($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $operator = Operator::where('uuid', $uuid)
        ->where('plant', $userPlantUuid) 
        ->firstOrFail();

        $operator->delete();

        return redirect()->route('operator.index')->with('success', 'Data Karyawan Pendukung berhasil dihapus');
    }
}
