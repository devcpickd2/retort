<?php

namespace App\Http\Controllers;

use App\Models\Wire;
use App\Models\Produk;
use App\Models\Mesin;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WireController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $date = $request->input('date');
        $userPlant  = Auth::user()->plant;

        $data = Wire::query()
        ->where('plant', $userPlant) 
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('nama_produk', 'like', "%{$search}%")
                ->orWhere('nama_supplier', 'like', "%{$search}%")
                ->orWhere('data_wire', 'like', "%{$search}%");
            });
        })
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date); 
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.wire.index', compact('data', 'search', 'date'));
    }

    public function create()
    {
        $userPlant = Auth::user()->plant;

        $produks = Produk::where('plant', $userPlant)->get();
        $mesins = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Stuffing')
        ->orderBy('nama_mesin')
        ->get();

        $suppliers = Supplier::where('plant', $userPlant)
        ->where('jenis_barang', 'Packaging')
        ->orderBy('nama_supplier')
        ->get();

        return view('form.wire.create', compact('produks', 'mesins', 'suppliers'));
    }

    public function store(Request $request)
    {
        $username   = Auth::user()->username ?? 'User RTM';
        $userPlant  = Auth::user()->plant;

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'nama_supplier' => 'required',
            'catatan'         => 'nullable|string',
            'data_wire'       => 'nullable|array',
        ]);

        $data = $request->only(['date', 'shift', 'nama_produk', 'nama_supplier', 'catatan']);
        $data['username']        = $username;
        $data['plant']           = $userPlant;
        $data['status_spv']      = "0";
        $data['data_wire']       = json_encode($request->input('data_wire', []), JSON_UNESCAPED_UNICODE);

        Wire::create($data);

        return redirect()->route('wire.index')
        ->with('success', 'Data No. Lot Wire berhasil disimpan');
    }

    public function update(string $uuid)
    {
        $wire = Wire::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;

        $produks = Produk::where('plant', $userPlant)->get();
        $mesins = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Stuffing')
        ->orderBy('nama_mesin')
        ->get();

        $suppliers = Supplier::where('plant', $userPlant)
        ->where('jenis_barang', 'Packaging')
        ->orderBy('nama_supplier')
        ->get();

        $wireData = !empty($wire->data_wire) ? json_decode($wire->data_wire, true) : [];

        return view('form.wire.update', compact('wire', 'produks', 'wireData', 'mesins', 'suppliers'));
    }

    public function update_qc(Request $request, string $uuid)
    {
        $wire = Wire::where('uuid', $uuid)->firstOrFail();
        $username_updated = Auth::user()->username ?? 'User RTM';

        $request->validate([
            'date'           => 'required|date',
            'shift'          => 'required',
            'nama_produk'    => 'required|string',
            'nama_supplier'  => 'required|string',
            'catatan'        => 'nullable|string',
            'data_wire'      => 'nullable|array',
        ]);

        $data_wire = $request->input('data_wire', []);

        $wire->update([
            'date'             => $request->date,
            'shift'            => $request->shift,
            'nama_produk'      => $request->nama_produk,
            'nama_supplier'    => $request->nama_supplier,
            'catatan'          => $request->catatan,
            'username_updated' => $username_updated,
            'data_wire'        => json_encode($data_wire, JSON_UNESCAPED_UNICODE),
        ]);

        return redirect()->route('wire.index')->with('success', 'Data No. Lot Wire berhasil diperbarui');
    }

    public function edit(string $uuid)
    {
        $wire = Wire::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;

        $produks = Produk::where('plant', $userPlant)->get();
        $mesins = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Stuffing')
        ->orderBy('nama_mesin')
        ->get();

        $suppliers = Supplier::where('plant', $userPlant)
        ->where('jenis_barang', 'Packaging')
        ->orderBy('nama_supplier')
        ->get();

        $wireData = !empty($wire->data_wire) ? json_decode($wire->data_wire, true) : [];

        return view('form.wire.edit', compact('wire', 'produks', 'wireData', 'mesins', 'suppliers'));
    }

    public function edit_spv(Request $request, string $uuid)
    {
        $wire = Wire::where('uuid', $uuid)->firstOrFail();
        $username_updated = Auth::user()->username ?? 'User RTM';

        $request->validate([
            'date'           => 'required|date',
            'shift'          => 'required',
            'nama_produk'    => 'required|string',
            'nama_supplier'  => 'required|string',
            'catatan'        => 'nullable|string',
            'data_wire'      => 'nullable|array',
        ]);

        $data_wire = $request->input('data_wire', []);

        $wire->update([
            'date'             => $request->date,
            'shift'            => $request->shift,
            'nama_produk'      => $request->nama_produk,
            'nama_supplier'    => $request->nama_supplier,
            'catatan'          => $request->catatan,
            'username_updated' => $username_updated,
            'data_wire'        => json_encode($data_wire, JSON_UNESCAPED_UNICODE),
        ]);

        return redirect()->route('wire.verification')->with('success', 'Data No. Lot Wire berhasil diperbarui');
    }

    public function verification(Request $request)
    {
     $search     = $request->input('search');
     $date = $request->input('date');
     $userPlant  = Auth::user()->plant;

     $data = Wire::query()
     ->where('plant', $userPlant) 
     ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produk', 'like', "%{$search}%")
            ->orWhere('nama_supplier', 'like', "%{$search}%")
            ->orWhere('data_wire', 'like', "%{$search}%");
        });
    })
     ->when($date, function ($query) use ($date) {
        $query->whereDate('date', $date);
    })
     ->orderBy('date', 'desc')
     ->orderBy('created_at', 'desc')
     ->paginate(10)
     ->appends($request->all());

     return view('form.wire.verification', compact('data', 'search', 'date'));
 }

 public function updateVerification(Request $request, $uuid)
 {
    $request->validate([
        'status_spv' => 'required|in:1,2',
        'catatan_spv' => 'nullable|string|max:255',
        'tgl_update_spv'
    ]);

    $wire = Wire::where('uuid', $uuid)->firstOrFail();

    $wire->update([
        'status_spv' => $request->status_spv,
        'catatan_spv' => $request->catatan_spv,
        'nama_spv' => Auth::user()->username,
        'tgl_update_spv' => now(),
    ]);

    return redirect()->route('wire.verification')
    ->with('success', 'Status Verifikasi Data No. Lot Wire berhasil diperbarui.');
}

public function destroy($uuid)
{
    $wire = Wire::where('uuid', $uuid)->firstOrFail();
    $wire->delete();

    return redirect()->route('wire.verification')
    ->with('success', 'Data No. Lot Wire berhasil dihapus');
}
}
