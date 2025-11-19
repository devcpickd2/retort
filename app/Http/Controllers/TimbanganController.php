<?php

namespace App\Http\Controllers;

use App\Models\Timbangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TimbanganController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $date       = $request->input('date');
        $userPlant  = Auth::user()->plant;
        
        $data = Timbangan::query()
        ->where('plant', $userPlant)
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('peneraan', 'like', "%{$search}%");
            });
        })
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.timbangan.index', compact('data', 'search', 'date'));
    }

    public function create()
    {
        return view('form.timbangan.create');
    }

    public function store(Request $request)
    {
        $username  = Auth::user()->username ?? 'User RTM';
        $userPlant = Auth::user()->plant;

        $request->validate([
            'date'     => 'required|date',
            'shift'    => 'required',
            'peneraan' => 'nullable|array',
        ]);

        Timbangan::create([
            'uuid'       => Str::uuid(),
            'date'       => $request->date,
            'shift'      => $request->shift,
            'username'   => $username,
            'plant'      => $userPlant,
            'status_spv' => "0",
            'peneraan'   => json_encode($request->peneraan, JSON_UNESCAPED_UNICODE),
        ]);

        return redirect()->route('timbangan.index')
        ->with('success', 'Peneraan Timbangan berhasil disimpan');
    }

    public function update(string $uuid)
    {
        $timbangan = Timbangan::where('uuid', $uuid)->firstOrFail();

    // Decode JSON peneraan => array of objects (stdClass)
        $peneraan = [];
        if (!empty($timbangan->peneraan)) {
            $decoded = json_decode($timbangan->peneraan);
            if (is_array($decoded)) {
                $peneraan = $decoded;
            }
        }

        if (empty($peneraan)) {
            $peneraan = [
                (object)[
                    'kode_timbangan' => '',
                    'standar' => '',
                    'pukul' => '',
                    'hasil_tera' => '',
                    'tindakan_perbaikan' => '',
                ]
            ];
        }

        return view('form.timbangan.update', compact('timbangan', 'peneraan'));
    }

    public function update_qc(Request $request, string $uuid)
    {
        $timbangan = Timbangan::where('uuid', $uuid)->firstOrFail();
        $usernameUpdated = Auth::user()->username ?? 'User RTM';

        $request->validate([
            'date'     => 'required|date',
            'shift'    => 'required',
            'peneraan' => 'nullable|array',
        ]);

        $timbangan->update([
            'date'             => $request->date,
            'shift'            => $request->shift,
            'username_updated' => $usernameUpdated,
            'peneraan'         => json_encode($request->peneraan, JSON_UNESCAPED_UNICODE),
        ]);

        return redirect()->route('timbangan.index')
        ->with('success', 'Peneraan Timbangan berhasil diperbarui');
    }


    public function edit(string $uuid)
    {
        $timbangan = Timbangan::where('uuid', $uuid)->firstOrFail();

    // Decode JSON peneraan => array of objects (stdClass)
        $peneraan = [];
        if (!empty($timbangan->peneraan)) {
            $decoded = json_decode($timbangan->peneraan);
            if (is_array($decoded)) {
                $peneraan = $decoded;
            }
        }

        if (empty($peneraan)) {
            $peneraan = [
                (object)[
                    'kode_timbangan' => '',
                    'standar' => '',
                    'pukul' => '',
                    'hasil_tera' => '',
                    'tindakan_perbaikan' => '',
                ]
            ];
        }

        return view('form.timbangan.edit', compact('timbangan', 'peneraan'));
    }

    public function edit_spv(Request $request, string $uuid)
    {
        $timbangan = Timbangan::where('uuid', $uuid)->firstOrFail();
        $usernameUpdated = Auth::user()->username ?? 'User RTM';

        $request->validate([
            'date'     => 'required|date',
            'shift'    => 'required',
            'peneraan' => 'nullable|array',
        ]);

        $timbangan->update([
            'date'             => $request->date,
            'shift'            => $request->shift,
            'username_updated' => $usernameUpdated,
            'peneraan'         => json_encode($request->peneraan, JSON_UNESCAPED_UNICODE),
        ]);

        return redirect()->route('timbangan.verification')
        ->with('success', 'Peneraan Timbangan berhasil diperbarui');
    }

    public function verification(Request $request)
    {
        $search     = $request->input('search');
        $date       = $request->input('date');
        $userPlant  = Auth::user()->plant;
        
        $data = Timbangan::query()
        ->where('plant', $userPlant)
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('peneraan', 'like', "%{$search}%");
            });
        })
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.timbangan.verification', compact('data', 'search', 'date'));
    }

    public function updateVerification(Request $request, $uuid)
    {
        $request->validate([
            'status_spv'  => 'required|in:1,2',
            'catatan_spv' => 'nullable|string|max:255',
        ]);

        $timbangan = Timbangan::where('uuid', $uuid)->firstOrFail();

        $timbangan->update([
            'status_spv'      => $request->status_spv,
            'catatan_spv'     => $request->catatan_spv,
            'nama_spv'        => Auth::user()->username,
            'tgl_update_spv'  => now(),
        ]);

        return redirect()->route('timbangan.verification')
        ->with('success', 'Status verifikasi peneraan timbangan berhasil diperbarui.');
    }

    public function destroy($uuid)
    {
        $timbangan = Timbangan::where('uuid', $uuid)->firstOrFail();
        $timbangan->delete();

        return redirect()->route('timbangan.verification')
        ->with('success', '🗑️ Peneraan Timbangan berhasil dihapus.');
    }
}
