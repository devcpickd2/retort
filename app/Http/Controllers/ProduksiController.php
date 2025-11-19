<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produksi;
use App\Models\Area_hygiene;
use Illuminate\Support\Facades\Auth; 

class ProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $userPlantUuid = Auth::user()->plant; 

        $produksi = Produksi::where('plant', $userPlantUuid)
        ->when($search, function($query, $search) {
            $query->where('nama_karyawan', 'like', "%{$search}%")
            ->orWhere('area', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('produksi.index', compact('produksi'));
    }

    public function create()
    {
        $userPlant = Auth::user()->plant;
        $areas  = Area_hygiene::where('plant', $userPlant)
        ->orderBy('area')
        ->get();

        return view('produksi.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'area' => 'required|string|max:255'
        ]);

        $user = Auth::user(); 

        Produksi::create([
            'username' => $user->username,  
            'plant' => $user->plant,     
            'nama_karyawan' => $request->nama_karyawan,
            'area' => $request->area
        ]);

        return redirect()->route('produksi.index')
        ->with('success', 'Produksi berhasil ditambahkan');
    }

    public function edit($uuid)
    {
        $userPlantUuid = Auth::user()->plant;

        $produksi = Produksi::where('uuid', $uuid)
        ->where('plant', $userPlantUuid)
        ->firstOrFail();

        $areas  = Area_hygiene::where('plant', $userPlantUuid)
        ->orderBy('area')
        ->get();

        return view('produksi.edit', compact('produksi', 'areas'));
    }

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

        return redirect()->route('produksi.index')
        ->with('success', 'Produksi berhasil diupdate');
    }

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
