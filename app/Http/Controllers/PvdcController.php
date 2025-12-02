<?php

namespace App\Http\Controllers;

use App\Models\Pvdc;
use App\Models\Produk;
use App\Models\Mesin;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class PvdcController extends Controller
{
    public function index(Request $request)
    {
        $search        = $request->input('search');
        $date          = $request->input('date');
        $shift         = $request->input('shift');
        $namaProduk    = $request->input('nama_produk');
        $userPlant     = Auth::user()->plant;

    // Ambil list produk untuk dropdown
        $produks = Pvdc::where('plant', $userPlant)
        ->select('nama_produk')
        ->distinct()
        ->orderBy('nama_produk')
        ->get();

    // Query utama PVDC
        $data = Pvdc::query()
        ->where('plant', $userPlant)

        // Filter pencarian bebas
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('nama_produk', 'like', "%{$search}%")
                ->orWhere('nama_supplier', 'like', "%{$search}%")
                ->orWhere('catatan', 'like', "%{$search}%");
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

        return view('form.pvdc.index', compact('data', 'produks', 'search', 'date', 'shift', 'namaProduk'));
    }


    public function create()
    {
        $userPlant = Auth::user()->plant; 

        $produks = Produk::where('plant', $userPlant)->get();
        $mesins = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Stuffing') 
        ->orderBy('nama_mesin')
        ->get();

        $suppliers = Supplier::where('plant', $userPlant)
        ->where('jenis_barang', 'Packaging')
        ->orderBy('nama_supplier')
        ->get();

        return view('form.pvdc.create', compact('produks', 'mesins', 'suppliers'));
    }

    public function store(Request $request)
    {
        $username   = Auth::user()->username ?? 'User RTM';
        $userPlant  = Auth::user()->plant;

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'nama_supplier' => 'required',
            'tgl_kedatangan'  => 'required|date',
            'tgl_expired'     => 'required|date',
            'catatan'         => 'nullable|string',
            'data_pvdc'       => 'nullable|array',
        ]);

        $data = $request->only(['date', 'shift', 'nama_produk', 'nama_supplier', 'tgl_kedatangan', 'tgl_expired', 'catatan']);
        $data['username']        = $username;
        $data['plant']           = $userPlant;
        $data['status_spv']      = "0";
        $data['data_pvdc']       = json_encode($request->input('data_pvdc', []), JSON_UNESCAPED_UNICODE);

        Pvdc::create($data);

        return redirect()->route('pvdc.index')
        ->with('success', 'Data No. Lot PVDC berhasil disimpan');
    }

    public function update(string $uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;

        $produks = Produk::where('plant', $userPlant)->get();
        $mesins = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Stuffing')
        ->orderBy('nama_mesin')
        ->get();

        $suppliers = Supplier::where('plant', $userPlant)
        ->where('jenis_barang', 'Packaging')
        ->orderBy('nama_supplier')
        ->get();

        $pvdcData = !empty($pvdc->data_pvdc) ? json_decode($pvdc->data_pvdc, true) : [];

        return view('form.pvdc.update', compact('pvdc', 'produks', 'pvdcData', 'mesins', 'suppliers'));
    }

    public function update_qc(Request $request, string $uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();
        $username_updated = Auth::user()->username ?? 'User RTT';

        $request->validate([
            'date'            => 'required|date',
            'shift'           => 'required',
            'nama_produk'     => 'required',
            'nama_supplier'   => 'required',
            'tgl_kedatangan'  => 'required|date',
            'tgl_expired'     => 'required|date',
            'catatan'         => 'nullable|string',
            'data_pvdc'       => 'nullable|array',
            'data_pvdc_old'   => 'nullable|array', 
        ]);

        $data_pvdc_old = $request->input('data_pvdc_old', []);
        $data_pvdc_new = $request->input('data_pvdc', []);

        $combined_pvdc = array_merge($data_pvdc_old, $data_pvdc_new);

        $data = [
            'date'             => $request->date,
            'shift'            => $request->shift,
            'nama_produk'      => $request->nama_produk,
            'nama_supplier'    => $request->nama_supplier,
            'tgl_kedatangan'   => $request->tgl_kedatangan,
            'tgl_expired'      => $request->tgl_expired,
            'catatan'          => $request->catatan,
            'username_updated' => $username_updated,
            'data_pvdc'        => json_encode($combined_pvdc, JSON_UNESCAPED_UNICODE),
        ];

        $pvdc->update($data);

        return redirect()->route('pvdc.index')->with('success', 'Data No. Lot PVDC berhasil diperbarui');
    }

    public function edit(string $uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();
        $userPlant = Auth::user()->plant;

        $produks = Produk::where('plant', $userPlant)->get();
        $mesins = Mesin::where('plant', $userPlant)
        ->where('jenis_mesin', 'Stuffing')
        ->orderBy('nama_mesin')
        ->get();

        $suppliers = Supplier::where('plant', $userPlant)
        ->where('jenis_barang', 'Packaging')
        ->orderBy('nama_supplier')
        ->get();

        $pvdcData = !empty($pvdc->data_pvdc) ? json_decode($pvdc->data_pvdc, true) : [];

        return view('form.pvdc.edit', compact('pvdc', 'produks', 'pvdcData', 'mesins', 'suppliers'));
    }

    public function edit_spv(Request $request, string $uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'date'            => 'required|date',
            'shift'           => 'required',
            'nama_produk'     => 'required',
            'nama_supplier'   => 'required',
            'tgl_kedatangan'  => 'required|date',
            'tgl_expired'     => 'required|date',
            'catatan'         => 'nullable|string',
            'data_pvdc'       => 'nullable|array',
            'data_pvdc_old'   => 'nullable|array', 
        ]);

        $data_pvdc_old = $request->input('data_pvdc_old', []);
        $data_pvdc_new = $request->input('data_pvdc', []);

        $combined_pvdc = array_merge($data_pvdc_old, $data_pvdc_new);

        $data = [
            'date'             => $request->date,
            'shift'            => $request->shift,
            'nama_produk'      => $request->nama_produk,
            'nama_supplier'    => $request->nama_supplier,
            'tgl_kedatangan'   => $request->tgl_kedatangan,
            'tgl_expired'      => $request->tgl_expired,
            'catatan'          => $request->catatan,
            'data_pvdc'        => json_encode($combined_pvdc, JSON_UNESCAPED_UNICODE),
        ];

        $pvdc->update($data);

        return redirect()->route('pvdc.verification')->with('success', 'Data No. Lot PVDC berhasil diperbarui');
    }

    public function verification(Request $request)
    {
        $search     = $request->input('search');
        $date = $request->input('date');
        $userPlant  = Auth::user()->plant;

        $data = Pvdc::query()
        ->where('plant', $userPlant) 
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('nama_produk', 'like', "%{$search}%")
                ->orWhere('kode_produksi', 'like', "%{$search}%")
                ->orWhere('nama_supplier', 'like', "%{$search}%")
                ->orWhere('no_lot', 'like', "%{$search}%");
            });
        })
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.pvdc.verification', compact('data', 'search', 'date'));
    }

    public function updateVerification(Request $request, $uuid)
    {
        $request->validate([
            'status_spv' => 'required|in:1,2',
            'catatan_spv' => 'nullable|string|max:255',
            'tgl_update_spv'
        ]);

        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();

        $pvdc->update([
            'status_spv' => $request->status_spv,
            'catatan_spv' => $request->catatan_spv,
            'nama_spv' => Auth::user()->username,
            'tgl_update_spv' => now(),
        ]);

        return redirect()->route('pvdc.verification')
        ->with('success', 'Status Verifikasi Data No. Lot PVDC berhasil diperbarui.');
    }

    public function destroy($uuid)
    {
        $pvdc = Pvdc::where('uuid', $uuid)->firstOrFail();
        $pvdc->delete();

        return redirect()->route('pvdc.verification')
        ->with('success', 'Data No. Lot PVDC berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        require_once base_path('vendor/tecnickcom/tcpdf/tcpdf.php');

        $date  = $request->date;
        $shift = $request->shift;
        $nama_produk = $request->nama_produk;

    // Ambil data PVDC
        $pvdc = Pvdc::whereDate('date', $date)
        ->where('shift', $shift)
        ->where('nama_produk', $nama_produk)
        ->first();

        if (!$pvdc) {
            return back()->with('error', 'Data PVDC tidak ditemukan untuk tanggal, shift, dan produk tersebut.');
        }

    // Decode detail JSON
        $detail = json_decode($pvdc->data_pvdc, true) ?? [];

    // Hari dalam bahasa Indonesia
        $hariList = [
            'Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa',
            'Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu'
        ];
        $hari = $hariList[date('l', strtotime($pvdc->date))] ?? '-';
        $tanggal = date('d-m-Y', strtotime($pvdc->date));

    // PDF Setup
        $pdf = new \TCPDF('P', 'mm', 'LEGAL', true, 'UTF-8', false);
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

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(0, 10, "DATA NO. LOT PVDC", 0, 1, 'C');

        $pdf->SetFont('times', '', 10);
        $pdf->Cell(0, 6, "Hari/Tanggal: $hari, $tanggal | Shift: $pvdc->shift | Produk: $pvdc->nama_produk", 0, 1, 'C');
        $pdf->Ln(2);

        $pdf->SetFont('times', '', 10);

        $col1 = 60;
        $col2 = 60;
        $col3 = 70;

        $pdf->Cell($col1, 6, "Nama Supplier: " . $pvdc->nama_supplier, 0, 0);
        $pdf->Cell($col2, 6, "Tgl Kedatangan: " . date('d-m-Y', strtotime($pvdc->tgl_kedatangan)), 0, 0);
        $pdf->Cell($col3, 6, "Tgl Expired: " . date('d-m-Y', strtotime($pvdc->tgl_expired)), 0, 1);
        $pdf->Ln(3);

// Decode JSON
        $raw = json_decode($pvdc->data_pvdc, true) ?? [];

// Kelompok mesin apa adanya
        $mesinList = $raw;

        $pdf->SetFont('times', '', 10);

        $chunks = array_chunk($mesinList, 3); 

        foreach ($chunks as $row) {

            $blockWidth = ($pdf->getPageWidth() - 20) / 3;
            $lineHeight = 6;
            $startY = $pdf->GetY();
            $startX = 10;

    // ====== BARIS MESIN ======
            foreach ($row as $m) {
                $pdf->SetXY($startX, $startY);
                $pdf->Cell($blockWidth, $lineHeight, "Mesin: " . ($m['mesin'] ?? '-'), 1, 0, 'L');
                $startX += $blockWidth;
            }

            $pdf->Ln($lineHeight);
            $startX = 10;

    // ====== BARIS HEADER DETAIL ======
            foreach ($row as $m) {
                $col1 = $blockWidth * 0.33;
                $col2 = $blockWidth * 0.33;
                $col3 = $blockWidth * 0.34;

                $pdf->SetXY($startX, $pdf->GetY());
                $pdf->Cell($col1, $lineHeight, "Batch", 1, 0, 'C');
                $pdf->Cell($col2, $lineHeight, "No.Lot", 1, 0, 'C');
                $pdf->Cell($col3, $lineHeight, "Waktu", 1, 0, 'C');

                $startX += $blockWidth;
            }

            $pdf->Ln($lineHeight);
            $startX = 10;

    // ====== BARIS DETAIL PER MESIN ======
    // Cari mesin dengan detail terbanyak
            $maxRows = max(array_map(fn($x) => count($x['detail']), $row));

            for ($i = 0; $i < $maxRows; $i++) {
                $startX = 10;

                foreach ($row as $m) {

                    $col1 = $blockWidth * 0.33;
                    $col2 = $blockWidth * 0.33;
                    $col3 = $blockWidth * 0.34;

                    $batch = $m['detail'][$i]['batch']  ?? '';
                    $lot   = $m['detail'][$i]['no_lot'] ?? '';
                    $waktu = $m['detail'][$i]['waktu']  ?? '';

                    $pdf->SetXY($startX, $pdf->GetY());

                    $pdf->Cell($col1, $lineHeight, $batch, 1, 0);
                    $pdf->Cell($col2, $lineHeight, $lot, 1, 0);
                    $pdf->Cell($col3, $lineHeight, $waktu, 1, 0);

                    $startX += $blockWidth;
                }

                $pdf->Ln($lineHeight);
            }

    // ====== KOTAK KOSONG ======
            $startX = 10;

            foreach ($row as $m) {
                $pdf->SetXY($startX, $pdf->GetY());
                $pdf->MultiCell($blockWidth, 18, "", 1, 'L', false, 0);
                $startX += $blockWidth;
            }

            $pdf->Ln(18);
        }


    // ===========================
    // CATATAN
    // ===========================
        $all_data = Pvdc::where('date', $date)
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
        if (ob_get_length()) ob_end_clean();
        $pdf->Output("PVDC_{$pvdc->date}_Shift_{$pvdc->shift}.pdf", 'I');
        exit;
    }



}
