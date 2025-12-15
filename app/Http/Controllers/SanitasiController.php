<?php

namespace App\Http\Controllers;

use App\Models\Sanitasi;
use App\Models\Area_sanitasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCPDF;

class SanitasiController extends Controller 
{
   public function index(Request $request)
    {
       $search    = $request->input('search');
       $date      = $request->input('date');
       $shift     = $request->input('shift');
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
       ->when($shift, function ($query) use ($shift) {
        $query->where('shift', $shift);
    })
       ->orderBy('date', 'desc')
       ->orderBy('shift', 'desc')
       ->orderBy('created_at', 'desc')
       ->paginate(10)
       ->appends($request->all());

       return view('form.sanitasi.index', compact('data', 'search', 'date', 'shift'));
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

public function exportPdf(Request $request)
{
    $date = $request->input('date');
    $shift = $request->input('shift');
    $userPlant = Auth::user()->plant;

    $sanitasies = Sanitasi::query()
        ->where('plant', $userPlant)
        ->when($date, function ($query) use ($date) {
            $query->whereDate('date', $date);
        })
        ->when($shift, function ($query) use ($shift) {
            $query->where('shift', $shift);
        })
        ->orderBy('date', 'asc')
        ->orderBy('shift', 'asc')
        ->orderBy('created_at', 'asc')
        ->get();

    // Clear any previous output buffers to prevent "TCPDF ERROR: Some data has already been output"
    if (ob_get_length()) {
        ob_end_clean();
    }

    // Create new TCPDF object
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name/Company');
    $pdf->SetTitle('Kontrol Sanitasi');
    $pdf->SetSubject('Kontrol Sanitasi');

    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // Set font
    $pdf->SetFont('helvetica', '', 8);

    // Add a page
    $pdf->AddPage('P', 'A3'); // Landscape A3 for many columns

    // Convert the Blade view to HTML
    $html = view('reports.kontrol-sanitasi', compact('sanitasies', 'request'))->render();

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    // Generate filename with filter info
    $filename = 'Kontrol_Sanitasi';
    if ($date) {
        $filename .= '_' . date('Ymd', strtotime($date));
    }
    if ($shift) {
        $filename .= '_Shift_' . $shift;
    }
    $filename .= '_' . date('His') . '.pdf';

    // Close and output PDF document (Inline/Preview)
    $pdf->Output($filename, 'I');

    exit();
}
}
