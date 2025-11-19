<?php

namespace App\Http\Controllers;

use App\Models\Gmp;
use App\Models\Produksi;
use App\Models\User;
use App\Models\Area_hygiene;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
// excel
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class GmpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search     = $request->input('search');
        $date = $request->input('date');
        $userPlant  = Auth::user()->plant; 

        $data = Gmp::where('plant', $userPlant) 
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('pemeriksaan', 'like', "%{$search}%");
        })
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.gmp.index', compact('data', 'search', 'date'));
    }

    public function create()
    {
        $userPlant = Auth::user()->plant;
        $areas = Area_hygiene::orderBy('area', 'asc')->get();

        $karyawanByArea = [];
        foreach ($areas as $area) {
            $karyawanByArea[$area->area] = Produksi::where('area', $area->area)
            ->where('plant', $userPlant)
            ->pluck('nama_karyawan')
            ->toArray();
        }

        return view('form.gmp.create', compact('areas', 'karyawanByArea'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $user = Auth::user();

        $data = [
            'date' => $request->date,
            'username' => $user->username,
            'plant' => $user->plant,
            'nama_produksi' => session()->has('selected_produksi')
            ? User::where('uuid', session('selected_produksi'))->first()->name
            : null,
            'status_produksi' => "1",
            'status_spv' => "0",
            // Catatan tidak terlihat di form, tapi tetap dipertahankan jika ada
            'catatan' => $request->input('catatan'), 
        ];

        $pemeriksaanData = [];

        // 1. Ambil semua SLUG AREA yang valid
        $areaSlugs = Area_hygiene::orderBy('area', 'asc')->get()->map(function ($area) {
            return Str::slug($area->area, '_');
        })->toArray();

// Ambil semua key dari request yang bentuknya array (berarti tiap area)
        foreach ($request->all() as $key => $value) {
            if (is_array($value)) {
        // Ambil nama area dari key (slug dibalik ke bentuk asli)
                $areaName = str_replace('_', ' ', Str::title($key));

                foreach ($value as $row) {
                    $pemeriksaanData[] = [
                        'area' => $areaName,
                        'nama_karyawan' => $row['nama_karyawan'] ?? '',
                        'pukul' => now()->format('H:i'),

                // Semua checkbox
                        'anting' => $row['anting'] ?? 0,
                        'kalung' => $row['kalung'] ?? 0,
                        'cincin' => $row['cincin'] ?? 0,
                        'jam_tangan' => $row['jam_tangan'] ?? 0,
                        'peniti' => $row['peniti'] ?? 0,
                        'bros' => $row['bros'] ?? 0,
                        'payet' => $row['payet'] ?? 0,
                        'softlens' => $row['softlens'] ?? 0,
                        'eyelashes' => $row['eyelashes'] ?? 0,
                        'seragam' => $row['seragam'] ?? 0,
                        'boot' => $row['boot'] ?? 0,
                        'masker' => $row['masker'] ?? 0,
                        'ciput_hairnet' => $row['ciput_hairnet'] ?? 0,
                        'kuku' => $row['kuku'] ?? 0,
                        'parfum' => $row['parfum'] ?? 0,
                        'make_up' => $row['make_up'] ?? 0,
                        'diare' => $row['diare'] ?? 0,
                        'demam' => $row['demam'] ?? 0,
                        'luka_bakar' => $row['luka_bakar'] ?? 0,
                        'batuk' => $row['batuk'] ?? 0,
                        'radang' => $row['radang'] ?? 0,
                        'influenza' => $row['influenza'] ?? 0,
                        'sakit_mata' => $row['sakit_mata'] ?? 0,

                        'keterangan' => $row['keterangan'] ?? null,
                    ];
                }
            }
        }

        $data['pemeriksaan'] = json_encode($pemeriksaanData);

        $gmp = Gmp::create($data);
        $gmp->update(['tgl_update_produksi' => Carbon::parse($gmp->created_at)->addHour()]);

        return redirect()->route('gmp.index')->with('success', 'Data GMP berhasil disimpan.');
    }

    public function edit(string $uuid)
    {
        $userPlant = Auth::user()->plant;

        $gmp = Gmp::where('uuid', $uuid)
        ->where('plant', $userPlant)
        ->firstOrFail();

        $areas = Area_hygiene::orderBy('area', 'asc')->get();

        $karyawanByArea = [];
        foreach ($areas as $area) {
            $karyawanByArea[$area->area] = Produksi::where('area', $area->area)
            ->where('plant', $userPlant)
            ->pluck('nama_karyawan')
            ->toArray();
        }

        // TODO: Anda perlu memproses $gmp->pemeriksaan (JSON) di view 'form.gmp.edit' untuk menampilkan data yang sudah tersimpan
        return view('form.gmp.edit', compact('gmp', 'areas', 'karyawanByArea'));
    }

    /**
     * PERBAIKAN DITERAPKAN DI SINI: Hanya memproses data yang sesuai dengan SLUG AREA.
     */
    public function update(Request $request, string $uuid)
    {
        $userPlant = Auth::user()->plant;

        $gmp = Gmp::where('uuid', $uuid)
        ->where('plant', $userPlant)
        ->firstOrFail();

        $request->validate([
            'date' => 'required|date',
        ]);

        $data = [
            'date' => $request->date,
            'username_updated' => Auth::user()->username,
            'plant' => $userPlant,
            'nama_produksi' => session()->has('selected_produksi')
            ? User::where('uuid', session('selected_produksi'))->first()->name
            : null,
            // Catatan tidak terlihat di form, tapi tetap dipertahankan jika ada
            'catatan' => $request->input('catatan'),
        ];

        $pemeriksaanData = [];

        // 1. Ambil semua SLUG AREA yang valid
        $areaSlugs = Area_hygiene::orderBy('area', 'asc')->get()->map(function ($area) {
            return Str::slug($area->area, '_');
        })->toArray();

        // 2. Loop hanya pada input request yang namanya sesuai dengan SLUG AREA
        foreach ($areaSlugs as $slug) {
            // Periksa apakah request memiliki field dengan slug ini dan merupakan array
            if ($request->has($slug) && is_array($request->input($slug))) {
                $value = $request->input($slug); // Data array pemeriksaan untuk area ini
                $areaName = str_replace('_', ' ', Str::title($slug));

                foreach ($value as $row) {
                    $pemeriksaanData[] = [
                        'area' => $areaName,
                        'nama_karyawan' => $row['nama_karyawan'] ?? '',
                        'pukul' => now()->format('H:i'),

                        // 23 Checkbox dari Blade
                        'anting' => $row['anting'] ?? 0,
                        'kalung' => $row['kalung'] ?? 0,
                        'cincin' => $row['cincin'] ?? 0,
                        'jam_tangan' => $row['jam_tangan'] ?? 0,
                        'peniti' => $row['peniti'] ?? 0,
                        'bros' => $row['bros'] ?? 0,
                        'payet' => $row['payet'] ?? 0,
                        'softlens' => $row['softlens'] ?? 0,
                        'eyelashes' => $row['eyelashes'] ?? 0,
                        'seragam' => $row['seragam'] ?? 0,
                        'boot' => $row['boot'] ?? 0,
                        'masker' => $row['masker'] ?? 0,
                        'ciput_hairnet' => $row['ciput_hairnet'] ?? 0,
                        'kuku' => $row['kuku'] ?? 0,
                        'parfum' => $row['parfum'] ?? 0,
                        'make_up' => $row['make_up'] ?? 0,
                        'diare' => $row['diare'] ?? 0,
                        'demam' => $row['demam'] ?? 0,
                        'luka_bakar' => $row['luka_bakar'] ?? 0,
                        'batuk' => $row['batuk'] ?? 0,
                        'radang' => $row['radang'] ?? 0,
                        'influenza' => $row['influenza'] ?? 0,
                        'sakit_mata' => $row['sakit_mata'] ?? 0,

                        'keterangan' => $row['keterangan'] ?? null,
                    ];
                }
            }
        }

        $data['pemeriksaan'] = json_encode($pemeriksaanData);

        $gmp->update($data);
        $gmp->update(['tgl_update_produksi' => Carbon::parse($gmp->updated_at)->addHour()]);

        return redirect()->route('gmp.index')->with('success', 'Data GMP berhasil diperbarui.');
    }

    public function verification(Request $request)
    {
        $search     = $request->input('search');
        $date = $request->input('date');
        $userPlant  = Auth::user()->plant;

        $data = Gmp::where('plant', $userPlant)
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('pemeriksaan', 'like', "%{$search}%");
        })
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.gmp.verification', compact('data', 'search', 'date'));
    }

    public function updateVerification(Request $request, $uuid)
    {
        $request->validate([
            'status_spv' => 'required|in:1,2',
            'catatan_spv' => 'nullable|string|max:255',
        ]);

        $userPlant = Auth::user()->plant;

        $gmp = Gmp::where('uuid', $uuid)
        ->where('plant', $userPlant)
        ->firstOrFail();

        $gmp->status_spv = $request->status_spv;
        $gmp->catatan_spv = $request->catatan_spv;
        $gmp->nama_spv = Auth::user()->username;
        $gmp->tgl_update_spv = now();
        $gmp->save();

        return redirect()->route('gmp.verification')
        ->with('success', 'Status verifikasi berhasil diperbarui.');
    }

    public function destroy(string $uuid)
    {
        $userPlant = Auth::user()->plant;

        $gmp = Gmp::where('uuid', $uuid)
        ->where('plant', $userPlant)
        ->firstOrFail();

        $gmp->delete();

        return redirect()->route('gmp.index')
        ->with('success', 'Data GMP Karyawan berhasil dihapus');
    }

    public function export(Request $request)
    {
        $date = $request->input('date');       
        $atribut = $request->input('atribut'); 

        if (!$date || !$atribut) {
            return redirect()->route('gmp.verification')
            ->with('error', 'Pilih bulan dan atribut terlebih dahulu.');
        }

        try {
            [$tahun, $bulan] = explode('-', $date);
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, (int)$bulan, (int)$tahun);

            $data = Gmp::whereNotNull($atribut)
            ->where('date', 'like', "$date%")
            ->orderBy('date', 'asc')
            ->get(['date', $atribut]);

            if ($data->isEmpty()) {
                return redirect()->route('gmp.verification')
                ->with('error', "Tidak ada data untuk bulan {$date}");
            }

        // Rekap data per karyawan
            $rekap = [];
            foreach ($data as $row) {
                $tgl = (int)date('d', strtotime($row->date));

            // Pastikan json decode jika masih string
                $json = $row->$atribut;
                if (is_string($json)) {
                    $json = json_decode($json, true);
                }
                if (!$json || !is_array($json)) continue;

                foreach ($json as $karyawan) {
                    $nama = $karyawan['nama_karyawan'] ?? 'Unknown';
                    if (!isset($rekap[$nama])) {
                        $rekap[$nama] = [];
                        for ($d = 1; $d <= $daysInMonth; $d++) {
                            $rekap[$nama][$d] = [
                                'seragam' => 0,
                                'boot'    => 0,
                                'masker'  => 0,
                                'ciput'   => 0,
                                'parfum'  => 0,
                            ];
                        }
                    }

                    $rekap[$nama][$tgl] = [
                        'seragam' => isset($karyawan['seragam']) ? (int)$karyawan['seragam'] : 0,
                        'boot'    => isset($karyawan['boot'])    ? (int)$karyawan['boot']    : 0,
                        'masker'  => isset($karyawan['masker'])  ? (int)$karyawan['masker']  : 0,
                        'ciput'   => isset($karyawan['ciput'])   ? (int)$karyawan['ciput']   : 0,
                        'parfum'  => isset($karyawan['parfum'])  ? (int)$karyawan['parfum']  : 0,
                    ];
                }
            }

            $templatePath = storage_path('app/templates/gmp_karyawan.xlsx');
            $spreadsheet  = IOFactory::load($templatePath);
            $sheet        = $spreadsheet->getActiveSheet();

            $bulanTahun = \Carbon\Carbon::createFromFormat('Y-m', $date)->format('F Y');

            $atributMap = [
                'mp_chamber' => 'MP - CHAMBER - SANITASI',
                'karantina_packing' => 'KARANTINA - PACKING',
                'filling_susun'=> 'FILLING - SUSUN',
                'sampling_fg'=> 'SAMPLING FG',
            ];

            $atributDisplay = $atributMap[$atribut] ?? $atribut;

            $sheet->setCellValue('B3', $bulanTahun);
            $sheet->setCellValue('B4', $atributDisplay);

            $uniqueDates = $data->pluck('date')->unique()->sort()->values();

            $col = 2;
            $headerRow = 7;

            foreach ($uniqueDates as $tglFull) {
                $tglDay = date('d-m-Y', strtotime($tglFull));
                $sheet->setCellValueByColumnAndRow($col, $headerRow, $tglDay);
                $col += 5;
            }

            $totalColIndex = 157; 
            $sheet->setCellValueByColumnAndRow($totalColIndex, $headerRow, '');

            $rowNum = 15;
            foreach ($rekap as $nama => $harian) {
                $sheet->setCellValue("A{$rowNum}", $nama);

                $col = 2;
                $total = 0;

                foreach ($uniqueDates as $tglFull) {
                    $tglNum = (int)date('d', strtotime($tglFull));

                    $seragam = $harian[$tglNum]['seragam'] ?? 0;
                    $boot    = $harian[$tglNum]['boot']    ?? 0;
                    $masker  = $harian[$tglNum]['masker']  ?? 0;
                    $ciput   = $harian[$tglNum]['ciput']   ?? 0;
                    $parfum  = $harian[$tglNum]['parfum']  ?? 0;

                    $sheet->setCellValueByColumnAndRow($col,     $rowNum, $seragam);
                    $sheet->setCellValueByColumnAndRow($col + 1, $rowNum, $boot);
                    $sheet->setCellValueByColumnAndRow($col + 2, $rowNum, $masker);
                    $sheet->setCellValueByColumnAndRow($col + 3, $rowNum, $ciput);
                    $sheet->setCellValueByColumnAndRow($col + 4, $rowNum, $parfum);

                    $total += (int)$seragam + (int)$boot + (int)$masker + (int)$ciput + (int)$parfum;

                    $col += 5;
                }

                $sheet->setCellValueByColumnAndRow($totalColIndex, $rowNum, $total);

                $lastColLetter = Coordinate::stringFromColumnIndex($totalColIndex);
                $sheet->getStyle("A{$rowNum}:{$lastColLetter}{$rowNum}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER);

                $rowNum++;
            }

            $filename = "Rekap_GMP_{$atribut}_{$date}.xlsx";
            if (ob_get_contents()) ob_end_clean();

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment; filename=\"{$filename}\"");
            header('Cache-Control: max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;

        } catch (\Throwable $e) {
            \Log::error("Export GMP gagal: ".$e->getMessage());
            return redirect()
            ->route('gmp.verification')
            ->with('error', 'Gagal export: '.$e->getMessage());
        }
    }

}
