<?php

namespace App\Http\Controllers;

use App\Models\Pvdc;
use App\Models\Produk;
use App\Models\Mesin;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PvdcController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $date = $request->input('date');
        $userPlant  = Auth::user()->plant;

        $data = Pvdc::query()
        ->where('plant', $userPlant) 
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('nama_produk', 'like', "%{$search}%")
                ->orWhere('kode_produksi', 'like', "%{$search}%")
                ->orWhere('nama_supplier', 'like', "%{$search}%")
                ->orWhere('no_lot', 'like', "%{$search}%");
            });
        })
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.pvdc.index', compact('data', 'search', 'date'));
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

        return view('form.pvdc.create', compact('produks', 'mesins', 'suppliers'));
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
            'tgl_kedatangan'  => 'required|date',
            'tgl_expired'     => 'required|date',
            'catatan'         => 'nullable|string',
            'data_pvdc'       => 'nullable|array',
        ]);

        $data = $request->only(['date', 'shift', 'nama_produk', 'nama_supplier', 'tgl_kedatangan', 'tgl_expired', 'catatan']);
        $data['username']        = $username;
        $data['plant']           = $userPlant;
        $data['status_spv']      = "0";
        $data['data_pvdc']       = json_encode($request->input('data_pvdc', []), JSON_UNESCAPED_UNICODE);

        Pvdc::create($data);

        return redirect()->route('pvdc.index')
        ->with('success', 'Data No. Lot PVDC berhasil disimpan');
    }

    public function update(string $uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();
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

        $pvdcData = !empty($pvdc->data_pvdc) ? json_decode($pvdc->data_pvdc, true) : [];

        return view('form.pvdc.update', compact('pvdc', 'produks', 'pvdcData', 'mesins', 'suppliers'));
    }

    public function update_qc(Request $request, string $uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();
        $username_updated = Auth::user()->username ?? 'User RTT';

        $request->validate([
            'date'            => 'required|date',
            'shift'           => 'required',
            'nama_produk'     => 'required',
            'nama_supplier'   => 'required',
            'tgl_kedatangan'  => 'required|date',
            'tgl_expired'     => 'required|date',
            'catatan'         => 'nullable|string',
            'data_pvdc'       => 'nullable|array',
            'data_pvdc_old'   => 'nullable|array', 
        ]);

        $data_pvdc_old = $request->input('data_pvdc_old', []);
        $data_pvdc_new = $request->input('data_pvdc', []);

        $combined_pvdc = array_merge($data_pvdc_old, $data_pvdc_new);

        $data = [
            'date'             => $request->date,
            'shift'            => $request->shift,
            'nama_produk'      => $request->nama_produk,
            'nama_supplier'    => $request->nama_supplier,
            'tgl_kedatangan'   => $request->tgl_kedatangan,
            'tgl_expired'      => $request->tgl_expired,
            'catatan'          => $request->catatan,
            'username_updated' => $username_updated,
            'data_pvdc'        => json_encode($combined_pvdc, JSON_UNESCAPED_UNICODE),
        ];

        $pvdc->update($data);

        return redirect()->route('pvdc.index')->with('success', 'Data No. Lot PVDC berhasil diperbarui');
    }

    public function edit(string $uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();
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

        $pvdcData = !empty($pvdc->data_pvdc) ? json_decode($pvdc->data_pvdc, true) : [];

        return view('form.pvdc.edit', compact('pvdc', 'produks', 'pvdcData', 'mesins', 'suppliers'));
    }

    public function edit_spv(Request $request, string $uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'date'            => 'required|date',
            'shift'           => 'required',
            'nama_produk'     => 'required',
            'nama_supplier'   => 'required',
            'tgl_kedatangan'  => 'required|date',
            'tgl_expired'     => 'required|date',
            'catatan'         => 'nullable|string',
            'data_pvdc'       => 'nullable|array',
            'data_pvdc_old'   => 'nullable|array', 
        ]);

        $data_pvdc_old = $request->input('data_pvdc_old', []);
        $data_pvdc_new = $request->input('data_pvdc', []);

        $combined_pvdc = array_merge($data_pvdc_old, $data_pvdc_new);

        $data = [
            'date'             => $request->date,
            'shift'            => $request->shift,
            'nama_produk'      => $request->nama_produk,
            'nama_supplier'    => $request->nama_supplier,
            'tgl_kedatangan'   => $request->tgl_kedatangan,
            'tgl_expired'      => $request->tgl_expired,
            'catatan'          => $request->catatan,
            'data_pvdc'        => json_encode($combined_pvdc, JSON_UNESCAPED_UNICODE),
        ];

        $pvdc->update($data);

        return redirect()->route('pvdc.verification')->with('success', 'Data No. Lot PVDC berhasil diperbarui');
    }

    public function verification(Request $request)
    {
        $search     = $request->input('search');
        $date = $request->input('date');
        $userPlant  = Auth::user()->plant;

        $data = Pvdc::query()
        ->where('plant', $userPlant) 
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('nama_produk', 'like', "%{$search}%")
                ->orWhere('kode_produksi', 'like', "%{$search}%")
                ->orWhere('nama_supplier', 'like', "%{$search}%")
                ->orWhere('no_lot', 'like', "%{$search}%");
            });
        })
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.pvdc.verification', compact('data', 'search', 'date'));
    }

    public function updateVerification(Request $request, $uuid)
    {
        $request->validate([
            'status_spv' => 'required|in:1,2',
            'catatan_spv' => 'nullable|string|max:255',
            'tgl_update_spv'
        ]);

        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();

        $pvdc->update([
            'status_spv' => $request->status_spv,
            'catatan_spv' => $request->catatan_spv,
            'nama_spv' => Auth::user()->username,
            'tgl_update_spv' => now(),
        ]);

        return redirect()->route('pvdc.verification')
        ->with('success', 'Status Verifikasi Data No. Lot PVDC berhasil diperbarui.');
    }

    public function destroy($uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();
        $pvdc->delete();

        return redirect()->route('pvdc.verification')
        ->with('success', 'Data No. Lot PVDC berhasil dihapus');
    }
}
