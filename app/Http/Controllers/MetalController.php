<?php

namespace App\Http\Controllers;

use App\Models\Metal;
use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetalController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $date = $request->input('date');
        $userPlant  = Auth::user()->plant;

        $data = Metal::query()
        ->where('plant', $userPlant)
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%");
        })
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.metal.index', compact('data', 'search', 'date'));
    }

    public function create()
    {
        $userPlant = Auth::user()->plant;

        $engineers = Operator::where('plant', $userPlant)
        ->where('bagian', 'Engineer')
        ->orderBy('nama_karyawan')
        ->get();

        return view('form.metal.create', compact('engineers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'    => 'required|date',
            'pukul'   => 'required|date_format:H:i',
            'catatan' => 'nullable|string',
            'nama_engineer' => 'required|string',
        ]);

        $username  = Auth::user()->username ?? 'None';
        $userPlant = Auth::user()->plant;
        $nama_produksi = session()->has('selected_produksi')
        ? \App\Models\User::where('uuid', session('selected_produksi'))->first()->name
        : 'Produksi RTT';

        $data = [
            'date'  => $request->date,
            'pukul' => $request->pukul,
            'fe'    => $request->fe,
            'nfe'   => $request->nfe,
            'sus'   => $request->sus,
            'catatan' => $request->catatan,
            'nama_engineer'       => $request->nama_engineer,
            'status_engineer'     => "1",
            'nama_produksi'       => $nama_produksi,
            'status_produksi'     => "1",
            'tgl_update_produksi' => now()->addHour(),
            'username'            => $username,
            'plant'               => $userPlant,
            'status_spv'          => "0",
        ];

        Metal::create($data);

        return redirect()->route('metal.index')
        ->with('success', 'Pengecekan Metal Detector berhasil disimpan');
    }

    public function update(string $uuid)
    {
        $metal = Metal::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;

        $engineers = Operator::where('plant', $userPlant)
        ->where('bagian', 'Engineer')
        ->orderBy('nama_karyawan')
        ->get();

        return view('form.metal.update', compact('metal', 'engineers'));
    }

    public function update_qc(Request $request, string $uuid)
    {
        $metal = Metal::where('uuid', $uuid)->firstOrFail();

        $request->merge([
            'pukul' => substr($request->pukul, 0, 5)
        ]);

        $request->validate([
            'date'    => 'required|date',
            'pukul'   => 'required|date_format:H:i',
            'catatan' => 'nullable|string|max:500',
            'nama_engineer' => 'required|string',
        ]);

        $username_updated = Auth::user()->username ?? 'None';
        $nama_produksi = session()->has('selected_produksi')
        ? \App\Models\User::where('uuid', session('selected_produksi'))->first()->name
        : 'Produksi RTT';

        $updateData = [
            'date'  => $request->date,
            'pukul' => $request->pukul,
            'fe'    => $request->fe,
            'nfe'   => $request->nfe,
            'sus'   => $request->sus,
            'catatan'          => $request->catatan,
            'username_updated' => $username_updated,
            'nama_engineer'       => $request->nama_engineer,
            'nama_produksi'    => $nama_produksi,
            'tgl_update_produksi' => now()->addHour(),
        ];

        $metal->update($updateData);

        return redirect()->route('metal.index')
        ->with('success', 'Pengecekan Metal Detector berhasil diperbarui');
    }

    public function edit(string $uuid)
    {
        $metal = Metal::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;

        $engineers = Operator::where('plant', $userPlant)
        ->where('bagian', 'Engineer')
        ->orderBy('nama_karyawan')
        ->get();

        return view('form.metal.edit', compact('metal', 'engineers'));
    }

    public function edit_spv(Request $request, string $uuid)
    {
        $metal = Metal::where('uuid', $uuid)->firstOrFail();

        $request->merge([
            'pukul' => substr($request->pukul, 0, 5)
        ]);

        $request->validate([
            'date'    => 'required|date',
            'pukul'   => 'required|date_format:H:i',
            'catatan' => 'nullable|string|max:500',
            'nama_engineer' => 'required|string',
        ]);

        $updateData = [
            'date'  => $request->date,
            'pukul' => $request->pukul,
            'fe'    => $request->fe,
            'nfe'   => $request->nfe,
            'sus'   => $request->sus,
            'catatan'          => $request->catatan,
            'nama_engineer'       => $request->nama_engineer,
        ];

        $metal->update($updateData);

        return redirect()->route('metal.verification')
        ->with('success', 'Pengecekan Metal Detector berhasil diperbarui');
    }

    public function verification(Request $request)
    {
        $search     = $request->input('search');
        $date = $request->input('date');
        $userPlant  = Auth::user()->plant;

        $data = Metal::query()
        ->where('plant', $userPlant)
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%");
        })
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.metal.verification', compact('data', 'search', 'date'));
    }

    public function updateVerification(Request $request, $uuid)
    {
        $request->validate([
            'status_spv'  => 'required|in:1,2',
            'catatan_spv' => 'nullable|string|max:255',
        ]);

        $metal = Metal::where('uuid', $uuid)->firstOrFail();

        $metal->update([
            'status_spv'  => $request->status_spv,
            'catatan_spv' => $request->catatan_spv,
            'nama_spv'    => Auth::user()->username,
            'tgl_update_spv' => now(),
        ]);

        return redirect()->route('metal.verification')
        ->with('success', 'Status Verifikasi Pengecekan Metal Detector berhasil diperbarui.');
    }

    public function destroy($uuid)
    {
        $metal = Metal::where('uuid', $uuid)->firstOrFail();
        $metal->delete();

        return redirect()->route('metal.verification')
        ->with('success', 'Data Pengecekan Metal Detector berhasil dihapus');
    }
}
