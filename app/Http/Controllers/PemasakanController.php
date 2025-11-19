<?php

namespace App\Http\Controllers;

use App\Models\Pemasakan;
use App\Models\Produk;
use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasakanController extends Controller 
{
    public function index(Request $request)
    {
       $search    = $request->input('search');
       $date      = $request->input('date');
       $userPlant  = Auth::user()->plant;

       $data = Pemasakan::query()
       ->where('plant', $userPlant)
       ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produk', 'like', "%{$search}%")
            ->orWhere('kode_produksi', 'like', "%{$search}%");
        });
    })
       ->when($date, function ($query) use ($date) {
        $query->whereDate('date', $date);
    })
       ->orderBy('date', 'desc')
       ->orderBy('created_at', 'desc')
       ->paginate(10)
       ->appends($request->all());

       return view('form.pemasakan.index', compact('data', 'search', 'date'));
   }

   public function create()
   {
    $userPlant = Auth::user()->plant;
    $produks = Produk::where('plant', $userPlant)->get();
    $list_chambers = Mesin::where('plant', $userPlant)
    ->where('jenis_mesin', 'Chamber')
    ->orderBy('nama_mesin')
    ->get(['uuid', 'nama_mesin']);

    return view('form.pemasakan.create', compact('produks', 'list_chambers'));
}

public function store(Request $request)
{
    $username   = Auth::user()->username ?? 'User RTM';
    $userPlant  = Auth::user()->plant;
    $nama_produksi = session()->has('selected_produksi')
    ? \App\Models\User::where('uuid', session('selected_produksi'))->first()->name
    : 'Produksi RTT';

    $request->validate([
        'date'          => 'required|date',
        'shift'         => 'required',
        'nama_produk'   => 'required',
        'kode_produksi' => 'required|string',
        'no_chamber'    => 'required',
        'berat_produk'  => 'required|numeric',
        'suhu_produk'   => 'required|numeric',
        'jumlah_tray'   => 'required|string',
        'total_reject'  => 'nullable|numeric',
        'catatan'       => 'nullable|string',
        'cooking'       => 'nullable|array',
    ]);

    $data = $request->only([
        'date', 'shift', 'nama_produk', 'kode_produksi',
        'no_chamber', 'berat_produk', 'suhu_produk', 'jumlah_tray',
        'total_reject', 'catatan',
    ]);

    $data['username']            = $username;
    $data['plant']               = $userPlant;
    $data['nama_produksi']       = $nama_produksi;
    $data['status_produksi']     = "1";
    $data['tgl_update_produksi'] = now()->addHour();
    $data['status_spv']          = "0";
    $data['cooking']             = json_encode($request->input('cooking', []), JSON_UNESCAPED_UNICODE);

    Pemasakan::create($data);

    return redirect()->route('pemasakan.index')->with('success', 'Pengecekan Pemasakan berhasil disimpan');
}

/** ====================== QC ====================== **/
public function update(string $uuid)
{
    $pemasakan = Pemasakan::where('uuid', $uuid)->firstOrFail();
    $userPlant = Auth::user()->plant;
    $produks = Produk::where('plant', $userPlant)->get();
    $list_chambers = Mesin::where('plant', $userPlant)
    ->where('jenis_mesin', 'Chamber')
    ->orderBy('nama_mesin')
    ->get(['uuid', 'nama_mesin']);

    $pemasakanData = !empty($pemasakan->cooking)
    ? json_decode($pemasakan->cooking, true)
    : [];

    return view('form.pemasakan.update', compact('pemasakan', 'produks', 'pemasakanData', 'list_chambers'));
}

public function update_qc(Request $request, string $uuid)
{
    $pemasakan = Pemasakan::where('uuid', $uuid)->firstOrFail();
    $username_updated = Auth::user()->username ?? 'User QC';

    $request->validate([
        'date'          => 'required|date',
        'shift'         => 'required',
        'nama_produk'   => 'required',
        'kode_produksi' => 'required|string',
        'no_chamber'    => 'required',
        'berat_produk'  => 'required|numeric',
        'suhu_produk'   => 'required|numeric',
        'jumlah_tray'   => 'required|string',
        'total_reject'  => 'nullable|numeric',
        'catatan'       => 'nullable|string',
        'cooking'       => 'nullable|array',
    ]);

    $data = [
        'date'             => $request->date,
        'shift'            => $request->shift,
        'nama_produk'      => $request->nama_produk,
        'kode_produksi'    => $request->kode_produksi,
        'no_chamber'       => $request->no_chamber,
        'berat_produk'     => $request->berat_produk,
        'suhu_produk'      => $request->suhu_produk,
        'jumlah_tray'      => $request->jumlah_tray,
        'total_reject'     => $request->total_reject,
        'catatan'          => $request->catatan,
        'username_updated' => $username_updated,
        'cooking'          => json_encode($request->input('cooking', []), JSON_UNESCAPED_UNICODE),
    ];

    $pemasakan->update($data);

    return redirect()->route('pemasakan.index')->with('success', 'Data QC berhasil diperbarui');
}

/** ====================== SPV ====================== **/
public function edit(string $uuid)
{
    $pemasakan = Pemasakan::where('uuid', $uuid)->firstOrFail();
    $userPlant = Auth::user()->plant;
    $produks = Produk::where('plant', $userPlant)->get();
    $list_chambers = Mesin::where('plant', $userPlant)
    ->where('jenis_mesin', 'Chamber')
    ->orderBy('nama_mesin')
    ->get(['uuid', 'nama_mesin']);

    $pemasakanData = !empty($pemasakan->cooking)
    ? json_decode($pemasakan->cooking, true)
    : [];

    return view('form.pemasakan.edit', compact('pemasakan', 'produks', 'pemasakanData', 'list_chambers'));
}

public function edit_spv(Request $request, string $uuid)
{
    $pemasakan = Pemasakan::where('uuid', $uuid)->firstOrFail();

    $request->validate([
        'date'          => 'required|date',
        'shift'         => 'required',
        'nama_produk'   => 'required',
        'kode_produksi' => 'required|string',
        'no_chamber'    => 'required',
        'berat_produk'  => 'required|numeric',
        'suhu_produk'   => 'required|numeric',
        'jumlah_tray'   => 'required|string',
        'total_reject'  => 'nullable|numeric',
        'catatan'       => 'nullable|string',
        'cooking'       => 'nullable|array',
    ]);

    $pemasakan->update([
        'date'             => $request->date,
        'shift'            => $request->shift,
        'nama_produk'      => $request->nama_produk,
        'kode_produksi'    => $request->kode_produksi,
        'no_chamber'       => $request->no_chamber,
        'berat_produk'     => $request->berat_produk,
        'suhu_produk'      => $request->suhu_produk,
        'jumlah_tray'      => $request->jumlah_tray,
        'total_reject'     => $request->total_reject,
        'catatan'          => $request->catatan,
        'cooking'          => json_encode($request->input('cooking', []), JSON_UNESCAPED_UNICODE),
    ]);

    return redirect()->route('pemasakan.verification')->with('success', 'Data SPV berhasil diperbarui');
}

public function verification(Request $request)
{
    $search     = $request->input('search');
    $date       = $request->input('date');
    $userPlant  = Auth::user()->plant;

    $data = Pemasakan::query()
    ->where('plant', $userPlant)
    ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produk', 'like', "%{$search}%")
            ->orWhere('kode_produksi', 'like', "%{$search}%");
        });
    })
    ->when($date, function ($query) use ($date) {
        $query->whereDate('date', $date);
    })
    ->orderBy('date', 'desc')
    ->orderBy('created_at', 'desc')
    ->paginate(10)
    ->appends($request->all());

    return view('form.pemasakan.verification', compact('data', 'search', 'date'));
}

public function updateVerification(Request $request, $uuid)
{
    $request->validate([
        'status_spv'  => 'required|in:1,2',
        'catatan_spv' => 'nullable|string|max:255',
    ]);

    $pemasakan = Pemasakan::where('uuid', $uuid)->firstOrFail();

    $pemasakan->update([
        'status_spv'      => $request->status_spv,
        'catatan_spv'     => $request->catatan_spv,
        'nama_spv'        => Auth::user()->username,
        'tgl_update_spv'  => now(),
    ]);

    return redirect()->route('pemasakan.verification')
    ->with('success', 'Status Verifikasi Pengecekan Pemasakan berhasil diperbarui.');
}

public function destroy($uuid)
{
    $pemasakan = Pemasakan::where('uuid', $uuid)->firstOrFail();
    $pemasakan->delete();

    return redirect()->route('pemasakan.verification')
    ->with('success', 'Pengecekan Pemasakan berhasil dihapus');
}
}
