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
use App\Models\User;
use Illuminate\Support\Facades\Response;

class Labelisasi_pvdcController extends Controller
{
    public function index(Request $request)
    {
        $search        = $request->input('search');
        $date          = $request->input('date');
        $shift         = $request->input('shift');
        $namaProduk    = $request->input('nama_produk');
        $userPlant     = Auth::user()->plant;

    // Ambil list produk untuk dropdown
        $produks = Labelisasi_pvdc::where('plant', $userPlant)
        ->select('nama_produk')
        ->distinct()
        ->orderBy('nama_produk')
        ->get();

    // Query utama PVDC
        $data = Labelisasi_pvdc::query()
        ->where('plant', $userPlant)

        // Filter pencarian bebas
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('nama_produk', 'like', "%{$search}%")
                ->orWhere('nama_supplier', 'like', "%{$search}%");
            });
        })

        // Filter berdasarkan tanggal
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })

        // Filter shift
        ->when($shift, function ($query) use ($shift) {
            $query->where('shift', $shift);
        })

        // Filter nama produk
        ->when($namaProduk, function ($query) use ($namaProduk) {
            $query->where('nama_produk', $namaProduk);
        })

        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.labelisasi_pvdc.index', compact('data', 'produks', 'search', 'date', 'shift', 'namaProduk'));
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
            'data_pvdc' => 'required|array|min:1',
            'data_pvdc.*.mesin' => 'required|string',
            'data_pvdc.*.kode_batch' => 'required|string',
            'data_pvdc.*.kode_produksi' => 'required|file|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $dataPvdc = [];
        foreach($request->data_pvdc as $item) {
            $file = $item['kode_produksi'];
            $filename = time().'_'.Str::random(8).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('public/uploads/pvdc', $filename);
            $url = Storage::url($path);

            $dataPvdc[] = [
                'mesin' => $item['mesin'],
                'kode_batch' => $item['kode_batch'],
                'file' => $url,
                'keterangan' => $item['keterangan'] ?? null,
            ];
        }

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
            'labelisasi' => json_encode($dataPvdc, JSON_UNESCAPED_UNICODE),
        ]);

        return response()->json([
            'success' => true,
            'redirect_url' => route('labelisasi_pvdc.index'),
            'message' => 'Data Labelisasi PVDC berhasil disimpan.'
        ]);
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

    public function exportPdf(Request $request)
    {
    // Bersihkan output buffer supaya TCPDF tidak error
        if (ob_get_length()) ob_end_clean();

        require_once base_path('vendor/tecnickcom/tcpdf/tcpdf.php');

        $date        = $request->date;
        $shift       = $request->shift;
        $nama_produk = $request->nama_produk;

    // Ambil data PVDC
        $labelisasi_pvdc = Labelisasi_pvdc::whereDate('date', $date)
        ->where('shift', $shift)
        ->where('nama_produk', $nama_produk)
        ->first();

        if (!$labelisasi_pvdc) {
            return back()->with('error', 'Data PVDC tidak ditemukan.');
        }

    // Decode JSON
        $dataPvdc = json_decode($labelisasi_pvdc->labelisasi, true) ?? [];

    // Setup PDF Landscape LEGAL
        $pdf = new \TCPDF('L', 'mm', 'LEGAL', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

    // ===========================
    // HEADER
    // ===========================
        $pdf->SetFont('times', 'I', 7);
        $pdf->Cell(0, 3, "PT. Charoen Pokphand Indonesia", 0, 1, 'L');
        $pdf->Cell(0, 3, "Food Division", 0, 1, 'L');
        $pdf->Ln(2);
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(0, 10, "DATA LABELISASI PVDC", 0, 1, 'C');

        $pdf->SetFont('times', '', 10);
        $pdf->Cell(0, 6, "Tanggal: " . date('d-m-Y', strtotime($labelisasi_pvdc->date)) .
            " | Shift: " . $labelisasi_pvdc->shift .
            " | Produk: " . $labelisasi_pvdc->nama_produk, 0, 1, 'C');
        $pdf->Ln(5);

    // ===========================
    // TABEL LABELISASI (2 DATA PER BARIS)
    // ===========================
        $pdf->SetFont('times', '', 10);

        $rows = array_chunk($dataPvdc, 2);
        $blockWidth = ($pdf->getPageWidth() - 20) / 2;
        $lineHeight = 6;

        foreach ($rows as $row) {
            $yStart = $pdf->GetY();
            $xStart = 10;

        // ----- BARIS MESIN -----
            foreach ($row as $item) {
                $pdf->SetXY($xStart, $yStart);
                $pdf->Cell($blockWidth, $lineHeight, "Mesin: " . ($item['mesin'] ?? '-'), 1, 0, 'L');
                $xStart += $blockWidth;
            }
            $pdf->Ln($lineHeight);
            $xStart = 10;

        // ----- BARIS KODE BATCH + KETERANGAN -----
            foreach ($row as $item) {
                $pdf->SetXY($xStart, $pdf->GetY());
                $pdf->Cell($blockWidth * 0.5, $lineHeight, "Kode Batch: " . ($item['kode_batch'] ?? '-'), 1, 0, 'L');
                $pdf->Cell($blockWidth * 0.5, $lineHeight, "Keterangan: " . ($item['keterangan'] ?? '-'), 1, 0, 'L');
                $xStart += $blockWidth;
            }
            $pdf->Ln($lineHeight);
            $xStart = 10;

        // ----- BARIS GAMBAR -----
            foreach ($row as $item) {
                $pdf->SetXY($xStart, $pdf->GetY());
                $pdf->Cell($blockWidth, 30, "", 1, 0);

                if (!empty($item['file'])) {
                // Path fisik server untuk TCPDF
                    $imgPath = public_path(str_replace('/storage/', 'storage/', $item['file']));
                    if (file_exists($imgPath)) {
                        $pdf->Image($imgPath, $xStart + 2, $pdf->GetY() + 2, $blockWidth - 4, 26, '', '', '', true);
                    }
                }

                $xStart += $blockWidth;
            }
            $pdf->Ln(32);
        }

        $all_data = Labelisasi_pvdc::whereDate('date', $date)
        ->where('shift', $shift)
        ->where('nama_produk', $nama_produk)
        ->get();

        $notes = $all_data->pluck('catatan')->filter()->toArray();
        $notes_text = !empty($notes) ? implode(', ', $notes) : '-';

        $pdf->SetFont('times', 'B', 9);
        $pdf->Cell(0, 6, 'Catatan:', 0, 1);

        $pdf->SetFont('times', '', 8);
        $pdf->MultiCell(0, 5, $notes_text, 0, 'L');
        $pdf->Ln(5);

    // ===========================
    // TANDA TANGAN + QR
    // ===========================
        $last = $all_data->last();
        $qc_user  = User::where('username', $last->username)->first();
        $spv_user = User::where('username', $last->nama_spv ?? '')->first();

        $qc_tgl  = $last->created_at ? $last->created_at->format('d-m-Y H:i') : '-';
        $spv_tgl = $last->tgl_update_spv ? date('d-m-Y H:i', strtotime($last->tgl_update_spv)) : '-';

        $barcode_size = 15;
        $page_width = $pdf->getPageWidth();
        $margin = 50;
        $usable_width = $page_width - ($margin * 2);
        $gap = ($usable_width - (2 * $barcode_size)) / 1;

        $x_positions = [
            $margin,
            $margin + $barcode_size + $gap
        ];

        $y_start = $pdf->GetY() + 5;

        if ($last->status_spv == 1 && $spv_user) {
        // QC
            $pdf->SetXY($x_positions[0], $y_start);
            $pdf->SetFont('times', '', 10);
            $pdf->Cell($barcode_size, 6, 'Dibuat Oleh', 0, 1, 'C');

            $qc_text = "Jabatan: QC Inspector\nNama: {$qc_user->name}\nTgl Dibuat: {$qc_tgl}";
            $pdf->write2DBarcode($qc_text, 'QRCODE,L', $x_positions[0], $y_start + 8, $barcode_size, $barcode_size);

            $pdf->SetXY($x_positions[0], $y_start + 8 + $barcode_size);
            $pdf->SetFont('times', '', 8);
            $pdf->MultiCell($barcode_size, 5, "QC Inspector", 0, 'C');

        // SPV
            $pdf->SetXY($x_positions[1], $y_start);
            $pdf->Cell($barcode_size, 6, 'Disetujui Oleh', 0, 1, 'C');

            $spv_text = "Jabatan: Supervisor QC\nNama: {$spv_user->name}\nTgl Verifikasi: {$spv_tgl}";
            $pdf->write2DBarcode($spv_text, 'QRCODE,L', $x_positions[1], $y_start + 8, $barcode_size, $barcode_size);

            $pdf->SetXY($x_positions[1], $y_start + 8 + $barcode_size);
            $pdf->SetFont('times', '', 8);
            $pdf->MultiCell($barcode_size, 5, "Supervisor QC", 0, 'C');
        } else {
            $pdf->SetXY($x_positions[1], $y_start + 20);
            $pdf->SetFont('times', '', 11);
            $pdf->SetTextColor(255, 0, 0);
            $pdf->Cell($barcode_size, 6, 'Data belum diverifikasi', 0, 1, 'C');
            $pdf->SetTextColor(0);
        }

    // OUTPUT PDF
        $pdf->Output("Labelisasi_PVDC_{$labelisasi_pvdc->date}_Shift_{$labelisasi_pvdc->shift}.pdf", 'I');
        exit;
    }

}
