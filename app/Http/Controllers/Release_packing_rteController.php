<?php

namespace App\Http\Controllers;

use App\Models\Release_packing_rte;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Release_packing_rteController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $date       = $request->input('date');
        $userPlant  = Auth::user()->plant;

        $data = Release_packing_rte::query()
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

        return view('form.release_packing_rte.index', compact('data', 'search', 'date'));
    }

    public function create()
    {
        $userPlant = Auth::user()->plant;
        $produks = Produk::where('plant', $userPlant)->get();

        return view('form.release_packing_rte.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username   = Auth::user()->username ?? 'User RTM';
        $userPlant  = Auth::user()->plant;

        $request->validate([
            'date'                   => 'required|date',
            'nama_produk'            => 'required|string',
            'kode_produksi'          => 'required|string',
            'expired_date'           => 'required',
            'reject'                 => 'nullable|integer',
            'release'                => 'nullable|integer',
            'keterangan'             => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'nama_produk', 'kode_produksi', 'expired_date',
            'reject', 'release', 'keterangan'
        ]);

    // Tambahan default
        $data['username']            = $username;
        $data['plant']               = $userPlant;
        $data['status_spv']          = "0";

        Release_packing_rte::create($data);

        return redirect()->route('release_packing_rte.index')->with('success', 'Data Release Packing RTE disimpan');
    }

    public function update(string $uuid)
    {
        $release_packing_rte = Release_packing_rte::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;
        $produks = Produk::where('plant', $userPlant)->get();

        return view('form.release_packing_rte.update', compact('release_packing_rte', 'produks'));
    }

    public function update_qc(Request $request, string $uuid)
    {
        $release_packing_rte = Release_packing_rte::where('uuid', $uuid)->firstOrFail();
        $username_updated = Auth::user()->username ?? 'User QC';

        $request->validate([
            'date'                   => 'required|date',
            'nama_produk'            => 'required|string',
            'kode_produksi'          => 'required|string',
            'expired_date'           => 'required',
            'reject'                 => 'nullable|integer',
            'release'                => 'nullable|integer',
            'keterangan'             => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'nama_produk', 'kode_produksi', 'expired_date',
            'reject', 'release', 'keterangan'
        ]);

        $data['username_updated'] = $username_updated;

        $release_packing_rte->update($data);

        return redirect()->route('release_packing_rte.index')->with('success', 'Data Release Packing RTE berhasil diperbarui');
    }

    public function edit(string $uuid)
    {
        $release_packing_rte = Release_packing_rte::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;
        $produks = Produk::where('plant', $userPlant)->get();

        return view('form.release_packing_rte.edit', compact('release_packing_rte', 'produks'));
    }

    public function edit_spv(Request $request, string $uuid)
    {
        $release_packing_rte = Release_packing_rte::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'date'                   => 'required|date',
            'nama_produk'            => 'required|string',
            'kode_produksi'          => 'required|string',
            'expired_date'           => 'required',
            'reject'                 => 'nullable|integer',
            'release'                => 'nullable|integer',
            'keterangan'             => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'nama_produk', 'kode_produksi', 'expired_date',
            'reject', 'release', 'keterangan'
        ]);

        $release_packing_rte->update($data);

        return redirect()->route('release_packing_rte.verification')->with('success', 'Data Release Packing RTE berhasil diperbarui');
    }

    public function verification(Request $request)
    {
        $search     = $request->input('search');
        $date       = $request->input('date');
        $userPlant  = Auth::user()->plant;

        $data = Release_packing_rte::query()
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

        return view('form.release_packing_rte.verification', compact('data', 'search', 'date'));
    }

    public function updateVerification(Request $request, $uuid)
    {
        $request->validate([
            'status_spv'  => 'required|in:1,2',
            'catatan_spv' => 'nullable|string|max:255',
        ]);

        $release_packing_rte = Release_packing_rte::where('uuid', $uuid)->firstOrFail();

        $release_packing_rte->update([
            'status_spv'      => $request->status_spv,
            'catatan_spv'     => $request->catatan_spv,
            'nama_spv'        => Auth::user()->username,
            'tgl_update_spv'  => now(),
        ]);

        return redirect()->route('release_packing_rte.verification')
        ->with('success', 'Status Verifikasi Data Release Packing RTE diperbarui.');
    }

    public function destroy($uuid)
    {
        $release_packing_rte = Release_packing_rte::where('uuid', $uuid)->firstOrFail();
        $release_packing_rte->delete();

        return redirect()->route('release_packing_rte.verification')
        ->with('success', 'Data Release Packing RTE berhasil dihapus');
    }
}
