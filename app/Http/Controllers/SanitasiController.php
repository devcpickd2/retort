<?php

namespace App\Http\Controllers;

use App\Models\Sanitasi;
use App\Models\Area_sanitasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanitasiController extends Controller 
{
    public function index(Request $request)
    {
       $search    = $request->input('search');
       $date      = $request->input('date');
       $userPlant  = Auth::user()->plant;

       $data = Sanitasi::query()
       ->where('plant', $userPlant)
       ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('username', 'like', "%{$search}%")
            ->orWhere('area', 'like', "%{$search}%");
        });
    })
       ->when($date, function ($query) use ($date) {
        $query->whereDate('date', $date);
    })
       ->orderBy('date', 'desc')
       ->orderBy('created_at', 'desc')
       ->paginate(10)
       ->appends($request->all());

       return view('form.sanitasi.index', compact('data', 'search', 'date'));
   }

   public function create()
   {
    $userPlant = Auth::user()->plant;
    $areas = Area_sanitasi::where('plant', $userPlant)->get();

    return view('form.sanitasi.create', compact('areas'));
}

public function store(Request $request)
{
    $user = Auth::user();
    $username = $user->username ?? 'User RTM';
    $userPlant = $user->plant;


    $nama_produksi = session()->has('selected_produksi')
    ? \App\Models\User::where('uuid', session('selected_produksi'))->first()?->name ?? 'Produksi RTT'
    : 'Produksi RTT';

    $request->validate([
        'date'        => 'required|date',
        'shift'       => 'required|string',
        'area'        => 'required|string',
        'pemeriksaan' => 'nullable|array',
    ]);

    $data = $request->only(['date', 'shift', 'area']);

    $data['username']            = $username;
    $data['plant']               = $userPlant;
    $data['nama_produksi']       = $nama_produksi;
    $data['status_produksi']     = "1";
    $data['tgl_update_produksi'] = now()->addHour();
    $data['status_spv']          = "0";
    $data['pemeriksaan']         = json_encode($request->input('pemeriksaan', []), JSON_UNESCAPED_UNICODE);

    Sanitasi::create($data);

    return redirect()->route('sanitasi.index')
    ->with('success', 'Kontrol Sanitasi berhasil disimpan');
}

public function update(string $uuid)
{
    $sanitasi = Sanitasi::where('uuid', $uuid)->firstOrFail();
    $userPlant = Auth::user()->plant;
    $areas = Area_sanitasi::where('plant', $userPlant)->get();
    $sanitasiData = !empty($sanitasi->pemeriksaan)
    ? json_decode($sanitasi->pemeriksaan, true)
    : [];

    return view('form.sanitasi.update', compact('sanitasi', 'sanitasiData', 'areas'));
}

public function update_qc(Request $request, string $uuid)
{
    $sanitasi = Sanitasi::where('uuid', $uuid)->firstOrFail();

    $username_updated = Auth::user()->username ?? 'User QC';

    // Validasi input
    $request->validate([
        'date'        => 'required|date',
        'shift'       => 'required|string',
        'area'        => 'required|string',
        'pemeriksaan' => 'nullable|array',
    ]);

    $data = [
        'date'        => $request->date,
        'shift'       => $request->shift,
        'area'        => $request->area,
        'pemeriksaan' => json_encode($request->input('pemeriksaan', []), JSON_UNESCAPED_UNICODE),
        'username_updated' => $username_updated,
        'updated_at'       => now(),
    ];

    $sanitasi->update($data);

    return redirect()->route('sanitasi.index')
    ->with('success', 'Data QC berhasil diperbarui');
}

public function edit(string $uuid)
{
   $sanitasi = Sanitasi::where('uuid', $uuid)->firstOrFail();
   $userPlant = Auth::user()->plant;
   $areas = Area_sanitasi::where('plant', $userPlant)->get();
   $sanitasiData = !empty($sanitasi->pemeriksaan)
   ? json_decode($sanitasi->pemeriksaan, true)
   : [];

   return view('form.sanitasi.edit', compact('sanitasi', 'sanitasiData', 'areas'));
}

public function edit_spv(Request $request, string $uuid)
{
    $sanitasi = Sanitasi::where('uuid', $uuid)->firstOrFail();

    $request->validate([
        'date'        => 'required|date',
        'shift'       => 'required|string',
        'area'        => 'required|string',
        'pemeriksaan' => 'nullable|array',
    ]);

    $data = [
        'date'        => $request->date,
        'shift'       => $request->shift,
        'area'        => $request->area,
        'pemeriksaan' => json_encode($request->input('pemeriksaan', []), JSON_UNESCAPED_UNICODE),
        'updated_at'  => now(),
    ];

    $sanitasi->update($data);

    return redirect()->route('sanitasi.verification')
    ->with('success', 'Data QC berhasil diperbarui');
}

public function verification(Request $request)
{
    $search     = $request->input('search');
    $date       = $request->input('date');
    $userPlant  = Auth::user()->plant;

    $data = Sanitasi::query()
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

    return view('form.sanitasi.verification', compact('data', 'search', 'date'));
}

public function updateVerification(Request $request, $uuid)
{
    $request->validate([
        'status_spv'  => 'required|in:1,2',
        'catatan_spv' => 'nullable|string|max:255',
    ]);

    $sanitasi = Sanitasi::where('uuid', $uuid)->firstOrFail();

    $sanitasi->update([
        'status_spv'      => $request->status_spv,
        'catatan_spv'     => $request->catatan_spv,
        'nama_spv'        => Auth::user()->username,
        'tgl_update_spv'  => now(),
    ]);

    return redirect()->route('sanitasi.verification')
    ->with('success', 'Status Verifikasi Pengecekan sanitasi berhasil diperbarui.');
}

public function destroy($uuid)
{
    $sanitasi = Sanitasi::where('uuid', $uuid)->firstOrFail();
    $sanitasi->delete();

    return redirect()->route('sanitasi.verification')
    ->with('success', 'Pengecekan sanitasi berhasil dihapus');
}
}
