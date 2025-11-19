<?php

namespace App\Http\Controllers;

use App\Models\Chamber;
use App\Models\Produk;
use App\Models\Operator;
use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChamberController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $date = $request->input('date');
        $userPlant  = Auth::user()->plant;
        
        $data = Chamber::query()
        ->where('plant', $userPlant) 
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('no_chamber', 'like', "%{$search}%");
            });
        })
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.chamber.index', compact('data', 'search', 'date'));
    }

    public function create()
    {
        $userPlant = Auth::user()->plant;

        $produks = Produk::where('plant', $userPlant)->get();
        $list_chambers = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Chamber')
        ->orderBy('nama_mesin')
        ->get(['uuid', 'nama_mesin']);
        
        $operators = Operator::where('plant', $userPlant)
        ->where('bagian', 'Operator')
        ->orderBy('nama_karyawan')
        ->get();

        return view('form.chamber.create', compact('produks', 'list_chambers', 'operators'));
    }

    public function store(Request $request)
    {
        $username   = Auth::user()->username ?? 'User RTM';
        $userPlant  = Auth::user()->plant;
        $nama_produksi = session()->has('selected_produksi')
        ? \App\Models\User::where('uuid', session('selected_produksi'))->first()->name
        : 'Produksi RTT';

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_operator' => 'required',
            'catatan'         => 'nullable|string',
            'verifikasi'       => 'nullable|array',
        ]);

        $data = $request->only(['date', 'shift', 'nama_operator', 'catatan']);
        $data['username']        = $username;
        $data['plant']           = $userPlant;
        $data['status_operator']     = "1";
        $data['tgl_update_operator'] = now()->addHour();
        $data['nama_produksi']       = $nama_produksi;
        $data['status_produksi']     = "1";
        $data['tgl_update_produksi'] = now()->addHour();
        $data['status_spv']          = "0";
        $data['verifikasi']         = json_encode($request->input('verifikasi', []), JSON_UNESCAPED_UNICODE);

        Chamber::create($data);

        return redirect()->route('chamber.index')
        ->with('success', 'Verifikasi Timer Chamber berhasil disimpan');
    }

    public function update(string $uuid)
    {
        $chamber = Chamber::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;

        $produks = Produk::where('plant', $userPlant)->get();
        $list_chambers = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Chamber')
        ->orderBy('nama_mesin')
        ->get(['uuid', 'nama_mesin']);
        $operators = Operator::where('plant', $userPlant)
        ->where('bagian', 'Operator')
        ->orderBy('nama_karyawan')
        ->get();

        $chamberData = !empty($chamber->verifikasi) ? json_decode($chamber->verifikasi, true) : [];

        return view('form.chamber.update', compact('chamber', 'produks', 'chamberData', 'list_chambers', 'operators'));
    }

    public function update_qc(Request $request, string $uuid)
    {
        $chamber = Chamber::where('uuid', $uuid)->firstOrFail();
        $username_updated = Auth::user()->username ?? 'User RTM';

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_operator' => 'required',
            'catatan'         => 'nullable|string',
            'verifikasi'       => 'nullable|array',
        ]);

        $verifikasi = $request->input('verifikasi', []);

        $data = [
            'date' => $request->date,
            'shift' => $request->shift,
            'nama_operator' => $request->nama_operator,
            'catatan' => $request->catatan,
            'username_updated' => $username_updated,
            'verifikasi' => json_encode($verifikasi, JSON_UNESCAPED_UNICODE),
        ];

        $data['tgl_update_operator'] = now()->addHour();
        $data['tgl_update_produksi'] = now()->addHour();

        $chamber->update($data);

        return redirect()->route('chamber.index')->with('success', 'Verifikasi Timer Chamber berhasil diperbarui');
    }

    public function edit(string $uuid)
    {
        $chamber = Chamber::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;

        $produks = Produk::where('plant', $userPlant)->get();
        $list_chambers = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Chamber')
        ->orderBy('nama_mesin')
        ->get(['uuid', 'nama_mesin']);
        $operators = Operator::where('plant', $userPlant)
        ->where('bagian', 'Operator')
        ->orderBy('nama_karyawan')
        ->get();

        $chamberData = !empty($chamber->verifikasi) ? json_decode($chamber->verifikasi, true) : [];

        return view('form.chamber.edit', compact('chamber', 'produks', 'chamberData', 'list_chambers', 'operators'));
    }

    public function edit_spv(Request $request, string $uuid)
    {
        $chamber = Chamber::where('uuid', $uuid)->firstOrFail();
        $username_updated = Auth::user()->username ?? 'User RTM';

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_operator' => 'required',
            'catatan'         => 'nullable|string',
            'verifikasi'       => 'nullable|array',
        ]);

        $verifikasi = $request->input('verifikasi', []);

        $data = [
            'date' => $request->date,
            'shift' => $request->shift,
            'nama_operator' => $request->nama_operator,
            'catatan' => $request->catatan,
            'username_updated' => $username_updated,
            'verifikasi' => json_encode($verifikasi, JSON_UNESCAPED_UNICODE),
        ];

        $data['tgl_update_operator'] = now()->addHour();
        $data['tgl_update_produksi'] = now()->addHour();

        $chamber->update($data);

        return redirect()->route('chamber.verification')->with('success', 'Verifikasi Timer Chamber berhasil diperbarui');
    }

    public function verification(Request $request)
    {
     $search     = $request->input('search');
     $date = $request->input('date');
     $userPlant  = Auth::user()->plant;

     $data = Chamber::query()
     ->where('plant', $userPlant) 
     ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('username', 'like', "%{$search}%")
            ->orWhere('no_chamber', 'like', "%{$search}%");
        });
    })
     ->when($date, function ($query) use ($date) {
        $query->whereDate('date', $date);
    })
     ->orderBy('date', 'desc')
     ->orderBy('created_at', 'desc')
     ->paginate(10)
     ->appends($request->all());

     return view('form.chamber.verification', compact('data', 'search', 'date'));
 }

 public function updateVerification(Request $request, $uuid)
 {
    $request->validate([
        'status_spv' => 'required|in:1,2',
        'catatan_spv' => 'nullable|string|max:255',
    ]);

    $chamber = Chamber::where('uuid', $uuid)->firstOrFail();

    $chamber->update([
        'status_spv' => $request->status_spv,
        'catatan_spv' => $request->catatan_spv,
        'nama_spv' => Auth::user()->username,
        'tgl_update_spv' => now(),
    ]);

    return redirect()->route('chamber.verification')
    ->with('success', 'Status Verifikasi Timer Chamber berhasil diperbarui.');
}

public function destroy($uuid)
{
    $chamber = Chamber::where('uuid', $uuid)->firstOrFail();
    $chamber->delete();

    return redirect()->route('chamber.index')
    ->with('success', 'Verifikasi Timer Chamber  berhasil dihapus');
}
}
