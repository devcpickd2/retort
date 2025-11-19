<?php

namespace App\Http\Controllers;

use App\Models\Labelisasi_pvdc;
use App\Models\Produk;
use App\Models\Mesin;
use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Labelisasi_pvdcController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $date = $request->input('date');
        $userPlant  = Auth::user()->plant;

        $data = Labelisasi_pvdc::query()
        ->where('plant', $userPlant)
        ->when($search, fn($q) => $q->where(function ($sub) use ($search) {
            $sub->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produk', 'like', "%{$search}%");
        }))
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.labelisasi_pvdc.index', compact('data', 'search', 'date'));
    }

    public function create()
    {
        $userPlant = Auth::user()->plant;

        $produks   = Produk::where('plant', $userPlant)->get();
        $mesins = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Stuffing')
        ->orderBy('nama_mesin')
        ->get(['uuid', 'nama_mesin']);
        
        $operators = Operator::where('plant', $userPlant)
        ->where('bagian', 'Operator')
        ->orderBy('nama_karyawan')
        ->get();

        session()->forget('pvdc_temp');

        return view('form.labelisasi_pvdc.create', compact('produks', 'mesins', 'operators'));
    }

    public function saveRowTemp(Request $request)
    {
        try {
            $request->validate([
                'mesin' => 'required|string',
                'kode_batch' => 'required|string',
                'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'keterangan' => 'nullable|string',
            ]);

            $file = $request->file('file');

            $path = 'public/uploads/pvdc_temp';
            $filename = time() . '_' . Str::random(8) . '.jpg';

            $this->compressAndStore($file, $path, $filename);

            $url = Storage::url("uploads/pvdc_temp/{$filename}");

            $tempData = session()->get('pvdc_temp', []);
            $tempData[] = [
                'mesin' => $request->mesin,
                'kode_batch' => $request->kode_batch,
                'file' => $url,
                'keterangan' => $request->keterangan ?? null,
            ];

            session()->put('pvdc_temp', $tempData);

            return response()->json([
                'success' => true,
                'file' => $url,
                'message' => 'Data berhasil disimpan sementara dengan gambar terkompresi.'
            ]);
        } catch (\Exception $e) {
            \Log::error('saveRowTemp Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function storeFinal(Request $request)
    {
        $username = Auth::user()->username ?? 'User RTT';
        $userPlant = Auth::user()->plant;
        $uuid = Str::uuid()->toString();

        $request->validate([
            'date' => 'required|date',
            'shift' => 'required|string',
            'nama_produk' => 'required|string',
            'nama_operator' => 'required|string',
        ]);

        $tempData = session()->get('pvdc_temp', []);

        if (empty($tempData)) {
            return response()->json(['success' => false, 'message' => 'Belum ada data PVDC yang diinputkan!']);
        }

        try {
            Labelisasi_pvdc::create([
                'uuid' => $uuid,
                'date' => $request->date,
                'shift' => $request->shift,
                'nama_produk' => $request->nama_produk,
                'nama_operator' => $request->nama_operator,
                'username' => $username,
                'plant' => $userPlant,
                'status_operator' => "1",
                'status_spv' => "0",
                'labelisasi' => json_encode($tempData, JSON_UNESCAPED_UNICODE),
            ]);

            session()->forget('pvdc_temp');

            return response()->json([
                'success' => true,
                'redirect_url' => route('labelisasi_pvdc.index'),
                'message' => 'Data Labelisasi PVDC berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function update($uuid)
    {
        $labelisasi_pvdc = Labelisasi_pvdc::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;

        $produks   = Produk::where('plant', $userPlant)->get();
        $mesins = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Stuffing')
        ->orderBy('nama_mesin')
        ->get(['uuid', 'nama_mesin']);
        $operators = Operator::where('plant', $userPlant)
        ->where('bagian', 'Operator')
        ->orderBy('nama_karyawan')
        ->get();

        $labelisasi_pvdcData = json_decode($labelisasi_pvdc->labelisasi, true) ?? [];
        session()->put('pvdc_temp', $labelisasi_pvdcData);

        return view('form.labelisasi_pvdc.update', compact(
            'labelisasi_pvdc',
            'produks',
            'mesins',
            'operators',
            'labelisasi_pvdcData'
        ));
    }

    public function update_qc(Request $request, $uuid)
    {
        $labelisasi_pvdc = Labelisasi_pvdc::where('uuid', $uuid)->firstOrFail();
        $username_updated = Auth::user()->username ?? 'User RTT';

        $request->validate([
            'date' => 'required|date',
            'shift' => 'required|string',
            'nama_produk' => 'required|string',
            'nama_operator' => 'required|string',
        ]);

        $updatedData = [];
        $tempData = session()->get('pvdc_temp', []);

        if ($request->has('data_pvdc')) {
            foreach ($request->data_pvdc as $row) {
                $mesin = $row['mesin'] ?? '-';
                $keterangan = $row['keterangan'] ?? null;
                $fileUrl = null;

                if (isset($row['kode_produksi']) && $row['kode_produksi'] instanceof \Illuminate\Http\UploadedFile) {
                    $file = $row['kode_produksi'];

                    $path = 'public/uploads/pvdc_temp';
                    $filename = time() . '_' . Str::random(8) . '.jpg';
                    $this->compressAndStore($file, $path, $filename);

                    $fileUrl = Storage::url("uploads/pvdc_temp/{$filename}");
                } else {
                    $old = collect($tempData)->firstWhere('mesin', $mesin);
                    $fileUrl = $old['file'] ?? null;
                }

                $updatedData[] = [
                    'mesin' => $mesin,
                    'kode_batch' => $row['kode_batch'] ?? '-',
                    'file' => $fileUrl,
                    'keterangan' => $keterangan,
                ];
            }
        }

        try {
            $labelisasi_pvdc->update([
                'date' => $request->date,
                'shift' => $request->shift,
                'nama_produk' => $request->nama_produk,
                'nama_operator' => $request->nama_operator,
                'username_updated' => $username_updated,
                'labelisasi' => json_encode($updatedData, JSON_UNESCAPED_UNICODE),
            ]);

            session()->forget('pvdc_temp');

            return response()->json([
                'success' => true,
                'redirect_url' => route('labelisasi_pvdc.index'),
                'message' => 'Data Labelisasi PVDC berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui: ' . $e->getMessage()]);
        }
    }


    public function edit($uuid)
    {
        $labelisasi_pvdc = Labelisasi_pvdc::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;

        $produks   = Produk::where('plant', $userPlant)->get();
        $mesins = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Stuffing')
        ->orderBy('nama_mesin')
        ->get(['uuid', 'nama_mesin']);
        $operators = Operator::where('plant', $userPlant)
        ->where('bagian', 'Operator')
        ->orderBy('nama_karyawan')
        ->get();

        $labelisasi_pvdcData = json_decode($labelisasi_pvdc->labelisasi, true) ?? [];
        session()->put('pvdc_temp', $labelisasi_pvdcData);

        return view('form.labelisasi_pvdc.edit', compact(
            'labelisasi_pvdc',
            'produks',
            'mesins',
            'operators',
            'labelisasi_pvdcData'
        ));
    }

    public function edit_spv(Request $request, $uuid)
    {
        $labelisasi_pvdc = Labelisasi_pvdc::where('uuid', $uuid)->firstOrFail();
        $username_updated = Auth::user()->username ?? 'User RTT';

        $request->validate([
            'date' => 'required|date',
            'shift' => 'required|string',
            'nama_produk' => 'required|string',
            'nama_operator' => 'required|string',
        ]);

        $updatedData = [];
        $tempData = session()->get('pvdc_temp', []);

        if ($request->has('data_pvdc')) {
            foreach ($request->data_pvdc as $row) {
                $mesin = $row['mesin'] ?? '-';
                $keterangan = $row['keterangan'] ?? null;
                $fileUrl = null;

                if (isset($row['kode_produksi']) && $row['kode_produksi'] instanceof \Illuminate\Http\UploadedFile) {
                    $file = $row['kode_produksi'];

                    $path = 'public/uploads/pvdc_temp';
                    $filename = time() . '_' . Str::random(8) . '.jpg';
                    $this->compressAndStore($file, $path, $filename);

                    $fileUrl = Storage::url("uploads/pvdc_temp/{$filename}");
                } else {
                    $old = collect($tempData)->firstWhere('mesin', $mesin);
                    $fileUrl = $old['file'] ?? null;
                }

                $updatedData[] = [
                    'mesin' => $mesin,
                    'kode_batch' => $row['kode_batch'] ?? '-',
                    'file' => $fileUrl,
                    'keterangan' => $keterangan,
                ];
            }
        }

        try {
            $labelisasi_pvdc->update([
                'date' => $request->date,
                'shift' => $request->shift,
                'nama_produk' => $request->nama_produk,
                'nama_operator' => $request->nama_operator,
                'username_updated' => $username_updated,
                'labelisasi' => json_encode($updatedData, JSON_UNESCAPED_UNICODE),
            ]);

            session()->forget('pvdc_temp');

            return response()->json([
                'success' => true,
                'redirect_url' => route('labelisasi_pvdc.verification'),
                'message' => 'Data Labelisasi PVDC berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui: ' . $e->getMessage()]);
        }
    }
    public function verification(Request $request)
    {
        $search     = $request->input('search');
        $date       = $request->input('date');
        $userPlant  = Auth::user()->plant;

        $data = Labelisasi_pvdc::query()
        ->where('plant', $userPlant)
        ->when($search, fn($q) => $q->where(function ($sub) use ($search) {
            $sub->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produk', 'like', "%{$search}%");
        }))
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.labelisasi_pvdc.verification', compact('data', 'search', 'date'));
    }

    public function updateVerification(Request $request, $uuid)
    {
        $request->validate([
            'status_spv' => 'required|in:1,2',
            'catatan_spv' => 'nullable|string|max:255',
        ]);

        $labelisasi_pvdc = Labelisasi_pvdc::where('uuid', $uuid)->firstOrFail();

        $labelisasi_pvdc->update([
            'status_spv' => $request->status_spv,
            'catatan_spv' => $request->catatan_spv,
            'nama_spv' => Auth::user()->username,
            'tgl_update_spv' => now(),
        ]);

        return redirect()->route('labelisasi_pvdc.verification')
        ->with('success', 'Status Verifikasi Labelisasi PVDC berhasil diperbarui.');
    }

    public function destroy($uuid)
    {
        $labelisasi_pvdc = Labelisasi_pvdc::where('uuid', $uuid)->firstOrFail();
        $labelisasi_pvdc->delete();

        return redirect()->route('labelisasi_pvdc.verification')
        ->with('success', 'Data Labelisasi PVDC berhasil dihapus.');
    }

    // ========================= HELPER KOMPRES GAMBAR =========================
    private function compressAndStore($file, $path, $filename)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)
        ->scale(width: 1280)
        ->toJpeg(quality: 75);

        Storage::put("{$path}/{$filename}", (string) $image);
    }
}
