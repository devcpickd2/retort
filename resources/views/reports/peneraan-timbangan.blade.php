<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-size: 9px; }
        table { border-collapse: collapse; }

        .title {
            font-size: 13px;
            font-weight: bold;
            text-align: center;
        }

        .small { font-size: 8px; }
        .center { text-align: center; }
        .sign { text-align: center; }

        .tbl-main, .tbl-main th, .tbl-main td {
            border: 0.4px solid #000;
        }

        .tbl-main th {
            font-size: 8px;
            text-align: center;
            vertical-align: middle;
        }

        .tbl-header td {
            padding: 2px;
            font-size: 9px;
        }
    </style>
</head>

<body>

{{-- HEADER --}}

<table width="100%">
    <tr>
        <td class="small" width="40%">
            PT Charoen Pokphand Indonesia<br>
            Food Division
        </td>
        
    </tr>
</table>
<h2 class="title">PENERAAN TIMBANGAN</h2>
<br>
<br>

{{-- INFO --}}
@php
$firstItem = $items->first();
$date = $firstItem ? \Carbon\Carbon::parse($firstItem->date)->format('d-m-Y') : '';
$shift = $firstItem ? $firstItem->shift : '';
@endphp
<table width="100%" class="tbl-header">
    <tr>
        <td width="15%">Hari / Tanggal</td>
        <td width="35%">: {{ $date }}</td>
        <td width="10%">Shift</td>
        <td width="40%">: {{ $shift }}</td>
    </tr>
</table>

<br>

{{-- TABEL UTAMA --}}
<table width="100%" class="tbl-main small">
    <tr>
        <th rowspan="2" class="center">KODE TIMBANGAN</th>
        <th rowspan="2" class="center">STANDAR (gr)</th>
        <th colspan="2" class="center">PENERAAN</th>
        <th rowspan="2" class="center">TINDAKAN PERBAIKAN</th>
    </tr>
    <tr>
        <th class="center">PUKUL</th>
        <th class="center">HASIL TERA</th>
    </tr>

    @php
    $allPeneraan = [];
    foreach($items as $item) {
        $peneraan = json_decode($item->peneraan, true);
        if(is_array($peneraan)) {
            $allPeneraan = array_merge($allPeneraan, $peneraan);
        }
    }
    @endphp

    @foreach($allPeneraan as $peneraan)
    <tr>
        <td style="height:40px;">{{ $peneraan['kode_timbangan'] ?? '' }}</td>
        <td>{{ $peneraan['standar'] ?? '' }}</td>
        <td>{{ $peneraan['pukul'] ?? '' }}</td>
        <td>{{ $peneraan['hasil_tera'] ?? '' }}</td>
        <td>{{ $peneraan['tindakan_perbaikan'] ?? '' }}</td>
    </tr>
    @endforeach

    @if(count($allPeneraan) < 6)
    @for($i = count($allPeneraan); $i < 6; $i++)
    <tr>
        <td style="height:40px;"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @endfor
    @endif
</table>
<div style="text-align:right; font-size:8px;font-style:italic">QT 57 / 00</div>
<br>

{{-- KETERANGAN --}}
<table width="100%" class="small">
    <tr>
        <td>
            <strong>Keterangan :</strong><br>
            - Tera timbangan dilakukan di setiap awal produksi<br>
            - Timbangan ditera menggunakan anak timbangan standar<br>
            - Jika ada selisih angka timbang dengan berat timbangan standar,
              beri keterangan (+) atau (–) angka selisih
        </td>
    </tr>
</table>
<br><br>
<br>

{{-- TTD --}}
<table width="100%" class="small">
    <tr>
        <td width="50%" class="sign">
            Dibuat oleh,<br><br><br>
            ( ___________________ )<br>
            QC
        </td>
        <td width="50%" class="sign">
            Diketahui oleh,<br><br><br>
            ( ___________________ )<br>
            QC SPV
        </td>
    </tr>
</table>



</body>
</html>
