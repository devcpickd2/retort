<?php

namespace App\Http\Controllers;

use App\Models\Stuffing;
use App\Models\Mincing;
use App\Models\Produk;
use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StuffingController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $date       = $request->input('date');
        $userPlant  = Auth::user()->plant;
        
        $data = Stuffing::with('mincing')  
        ->where('plant', $userPlant) 
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('nama_produk', 'like', "%{$search}%")
                ->orWhere('kode_produksi', 'like', "%{$search}%")
                ->orWhere('kode_mesin', 'like', "%{$search}%");
            });
        })
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.stuffing.index', compact('data', 'search', 'date'));
    }

    public function create()
    {
        $userPlant = Auth::user()->plant;
        $batches = Mincing::latest()->take(2)->get();
        $produks = Produk::where('plant', $userPlant)->get();
        $mesins = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Stuffing')
        ->orderBy('nama_mesin')
        ->get(['uuid', 'nama_mesin']);

        return view('form.stuffing.create', compact('produks', 'mesins', 'batches'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $username   = Auth::user()->username ?? 'User RTM';
        $userPlant  = Auth::user()->plant;

        $nama_produksi = 'Produksi RTT';
        if (session()->has('selected_produksi')) {
            $user = \App\Models\User::where('uuid', session('selected_produksi'))->first();
            if ($user) $nama_produksi = $user->name;
        }

        $validated = $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'kode_produksi' => 'required|exists:mincings,uuid',
            // 'kode_produksi'  => 'required',
            'exp_date'       => 'required|date',
            'kode_mesin'  => 'required|string',
            'jam_mulai'   => 'required',
            'suhu'        => 'nullable|numeric',
            'sensori'            => 'nullable|string',
            'kecepatan_stuffing' => 'nullable|numeric',
            'panjang_pcs'     => 'nullable|numeric',
            'berat_pcs'       => 'nullable|numeric',
            'cek_vakum'       => 'nullable|string',
            'kebersihan_seal' => 'nullable|string',
            'kekuatan_seal'   => 'nullable|string',
            'diameter_klip'   => 'nullable|numeric',
            'print_kode'      => 'nullable|string',
            'lebar_cassing'   => 'nullable|numeric',
            'catatan'         => 'nullable|string',
        ]);

        foreach(['suhu','kecepatan_stuffing','panjang_pcs','berat_pcs','diameter_klip','lebar_cassing'] as $numField){
            $validated[$numField] = $validated[$numField] ?: null;
        }

        $validated['username'] = $username;
        $validated['plant'] = $userPlant;
        $validated['nama_produksi'] = $nama_produksi;
        $validated['status_produksi'] = "1";
        $validated['tgl_update_produksi'] = now()->addHour();
        $validated['status_spv'] = "0";

        Stuffing::create($validated);

        return redirect()->route('stuffing.index')->with('success', 'Pemeriksaan Stuffing Sosis Retort berhasil disimpan');
    }

    public function update(string $uuid)
    {
        $stuffing = Stuffing::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;

        $produks = Produk::where('plant', $userPlant)->get();
        $mesins = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Stuffing')
        ->orderBy('nama_mesin')
        ->get();

        return view('form.stuffing.update', compact('stuffing', 'produks', 'mesins'));
    }

    public function update_qc(Request $request, string $uuid)
    {
        $stuffing = Stuffing::where('uuid', $uuid)->firstOrFail();
        $username_updated = Auth::user()->username ?? 'User RTM';

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'kode_produksi'  => 'required',
            'exp_date'       => 'required|date',
            'kode_mesin'  => 'required',
            'jam_mulai'   => 'required',
            'suhu'        => 'nullable|numeric',
            'sensori'            => 'nullable|string',
            'kecepatan_stuffing' => 'nullable|numeric',
            'panjang_pcs'     => 'nullable|numeric',
            'berat_pcs'       => 'nullable|numeric',
            'cek_vakum'       => 'nullable|string',
            'kebersihan_seal' => 'nullable|string',
            'kekuatan_seal'   => 'nullable|string',
            'diameter_klip'   => 'nullable|numeric',
            'print_kode'      => 'nullable|string',
            'lebar_cassing'   => 'nullable|numeric',
            'catatan'         => 'nullable|string',
        ]);

        $data = [
            'date' => $request->date,
            'shift' => $request->shift,
            'nama_produk' => $request->nama_produk,
            'kode_produksi' => $request->kode_produksi,
            'exp_date' => $request->exp_date,
            'kode_mesin' => $request->kode_mesin,
            'jam_mulai' => $request->jam_mulai,
            'suhu' => $request->suhu,
            'sensori' => $request->sensori,
            'kecepatan_stuffing' => $request->kecepatan_stuffing,
            'panjang_pcs' => $request->panjang_pcs,
            'berat_pcs' => $request->berat_pcs,
            'cek_vakum' => $request->cek_vakum,
            'kebersihan_seal' => $request->kebersihan_seal,
            'kekuatan_seal' => $request->kekuatan_seal,
            'diameter_klip' => $request->diameter_klip,
            'print_kode' => $request->print_kode,
            'lebar_cassing' => $request->lebar_cassing,
            'catatan' => $request->catatan,
            'username_updated' => $username_updated,
        ];
        $stuffing->update($data);
        return redirect()->route('stuffing.index')->with('success', 'Pemeriksaan Stuffing Sosis Retort berhasil diperbarui');
    }

    public function edit(string $uuid)
    {
        $stuffing = Stuffing::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;

        $produks = Produk::where('plant', $userPlant)->get();
        $mesins = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Stuffing')
        ->orderBy('nama_mesin')
        ->get();

        return view('form.stuffing.edit', compact('stuffing', 'produks', 'mesins'));
    }

    public function edit_spv(Request $request, string $uuid)
    {
        $stuffing = Stuffing::where('uuid', $uuid)->firstOrFail();
        $username_updated = Auth::user()->username ?? 'User RTM';

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'kode_produksi'  => 'required',
            'exp_date'       => 'required|date',
            'kode_mesin'  => 'required',
            'jam_mulai'   => 'required',
            'suhu'        => 'nullable|numeric',
            'sensori'            => 'nullable|string',
            'kecepatan_stuffing' => 'nullable|numeric',
            'panjang_pcs'     => 'nullable|numeric',
            'berat_pcs'       => 'nullable|numeric',
            'cek_vakum'       => 'nullable|string',
            'kebersihan_seal' => 'nullable|string',
            'kekuatan_seal'   => 'nullable|string',
            'diameter_klip'   => 'nullable|numeric',
            'print_kode'      => 'nullable|string',
            'lebar_cassing'   => 'nullable|numeric',
            'catatan'         => 'nullable|string',
        ]);

        $data = [
            'date' => $request->date,
            'shift' => $request->shift,
            'nama_produk' => $request->nama_produk,
            'kode_produksi' => $request->kode_produksi,
            'exp_date' => $request->exp_date,
            'kode_mesin' => $request->kode_mesin,
            'jam_mulai' => $request->jam_mulai,
            'suhu' => $request->suhu,
            'sensori' => $request->sensori,
            'kecepatan_stuffing' => $request->kecepatan_stuffing,
            'panjang_pcs' => $request->panjang_pcs,
            'berat_pcs' => $request->berat_pcs,
            'cek_vakum' => $request->cek_vakum,
            'kebersihan_seal' => $request->kebersihan_seal,
            'kekuatan_seal' => $request->kekuatan_seal,
            'diameter_klip' => $request->diameter_klip,
            'print_kode' => $request->print_kode,
            'lebar_cassing' => $request->lebar_cassing,
            'catatan' => $request->catatan,
            'username_updated' => $username_updated,
        ];
        $stuffing->update($data);

        return redirect()->route('stuffing.verification')->with('success', 'Pemeriksaan Stuffing Sosis Retort berhasil diperbarui');
    }

    public function verification(Request $request)
    {
       $search     = $request->input('search');
       $date       = $request->input('date');
       $userPlant  = Auth::user()->plant;

       $data = Stuffing::query()
       ->where('plant', $userPlant) 
       ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produk', 'like', "%{$search}%")
            ->orWhere('kode_produksi', 'like', "%{$search}%")
            ->orWhere('kode_mesin', 'like', "%{$search}%");
        });
    })
       ->when($date, function ($query) use ($date) {
        $query->whereDate('date', $date);
    })
       ->orderBy('date', 'desc')
       ->orderBy('created_at', 'desc')
       ->paginate(10)
       ->appends($request->all());

       return view('form.stuffing.verification', compact('data', 'search', 'date'));
   }

   public function updateVerification(Request $request, $uuid)
   {
    $request->validate([
        'status_spv'   => 'required|in:1,2', 
        'catatan_spv'  => 'nullable|string|max:255',
    ]);

    $stuffing = Stuffing::where('uuid', $uuid)->firstOrFail();

    $username_spv = Auth::user()->username ?? 'SPV';

    // Mencegah status_spv double update
    if ($stuffing->status_spv != 0) {
        return back()->with('error', 'Data sudah diverifikasi sebelumnya!');
    }

    $stuffing->update([
        'status_spv'       => $request->status_spv,
        'catatan_spv'      => $request->catatan_spv,
        'username_spv'     => $username_spv,
        'tgl_update_spv'   => now(),
    ]);

    return redirect()
    ->route('stuffing.verification')
    ->with('success', 'Verifikasi berhasil disimpan.');
}

public function destroy($uuid)
{
    $stuffing = Stuffing::where('uuid', $uuid)->firstOrFail();
    $stuffing->delete();

    return redirect()->route('stuffing.index')
    ->with('success', 'Pemeriksaan Stuffing Sosis Retort berhasil dihapus');
}
}