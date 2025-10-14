<?php

namespace App\Http\Controllers;

use App\Models\Pvdc;
use App\Models\Produk;
use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PvdcController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');
        $userPlant  = Auth::user()->plant;

        $data = Pvdc::query()
        ->where('plant', $userPlant) 
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('nama_produk', 'like', "%{$search}%");
            });
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.pvdc.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        $mesins = Mesin::orderBy('nama_mesin')->get();

        return view('form.pvdc.create', compact('produks', 'mesins'));
    }

    public function store(Request $request)
    {
        $username   = Auth::user()->username ?? 'User RTM';
        $userPlant  = Auth::user()->plant;

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'tgl_kedatangan'  => 'required|date',
            'tgl_expired'     => 'required|date',
            'catatan'         => 'nullable|string',
            'data_pvdc'       => 'nullable|array',
        ]);

        $data = $request->only(['date', 'shift', 'nama_produk', 'tgl_kedatangan', 'tgl_expired', 'catatan']);
        $data['username']        = $username;
        $data['plant']           = $userPlant;
        $data['status_spv']      = "0";
        $data['data_pvdc']       = json_encode($request->input('data_pvdc', []), JSON_UNESCAPED_UNICODE);

        Pvdc::create($data);

        return redirect()->route('pvdc.index')
        ->with('success', 'Data No. Lot PVDC berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();
        $mesins = Mesin::orderBy('nama_mesin')->get();

        $pvdcData = !empty($pvdc->data_pvdc) ? json_decode($pvdc->data_pvdc, true) : [];

        return view('form.pvdc.edit', compact('pvdc', 'produks', 'pvdcData', 'mesins'));
    }

    public function update(Request $request, string $uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();
        $username_updated = Auth::user()->username ?? 'User RTM';

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'tgl_kedatangan'  => 'required|date',
            'tgl_expired'     => 'required|date',
            'catatan'         => 'nullable|string',
            'data_pvdc'       => 'nullable|array',
        ]);

        $data_pvdc = $request->input('data_pvdc', []);

        $data = [
            'date' => $request->date,
            'shift' => $request->shift,
            'nama_produk' => $request->nama_produk,
            'tgl_kedatangan' => $request->tgl_kedatangan,
            'tgl_expired' => $request->tgl_expired,
            'catatan' => $request->catatan,
            'username_updated' => $username_updated,
            'data_pvdc' => json_encode($data_pvdc, JSON_UNESCAPED_UNICODE),
        ];

        $pvdc->update($data);
        $pvdc->update(['tgl_update_produksi' => Carbon::parse($pvdc->updated_at)->addHour()]);

        return redirect()->route('pvdc.index')->with('success', 'Data No. Lot PVDC berhasil diperbarui');
    }

    public function verification(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');
        $userPlant  = Auth::user()->plant;

        $data = Pvdc::query()
        ->where('plant', $userPlant) 
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('nama_produk', 'like', "%{$search}%");
            });
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.pvdc.verification', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function updateVerification(Request $request, $uuid)
    {
        $request->validate([
            'status_spv' => 'required|in:1,2',
            'catatan_spv' => 'nullable|string|max:255',
        ]);

        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();

        $pvdc->update([
            'status_spv' => $request->status_spv,
            'catatan_spv' => $request->catatan_spv,
            'nama_spv' => Auth::user()->username,
        ]);

        return redirect()->route('pvdc.verification')
        ->with('success', 'Status Verifikasi Data No. Lot PVDC berhasil diperbarui.');
    }

    public function destroy($uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();
        $pvdc->delete();

        return redirect()->route('pvdc.index')
        ->with('success', 'Data No. Lot PVDC berhasil dihapus');
    }
}
