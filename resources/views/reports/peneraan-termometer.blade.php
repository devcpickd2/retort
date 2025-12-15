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
<h2 class="title">PENERAAN TERMOMETER</h2>
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
        <td>Hari / Tanggal : {{ $date }}</td>
        <td>Shift : {{ $shift }}</td>
    </tr>
</table>

<br>

{{-- TABEL UTAMA --}}
<table width="100%" class="tbl-main small">
    <tr>
        <th class="center" rowspan="2">KODE TERMOMETER / AREA</th>
        <th class="center" rowspan="2">STANDAR</th>
        <th colspan="2" class="center">PENERAAN</th>
        <th class="center" rowspan="2">TINDAKAN PERBAIKAN</th>
        <th class="center" rowspan="2">DIBUAT<br>QC</th>
        <th class="center" rowspan="2">DIKETAHUI<br>SPV QC</th>
    </tr>
    <tr>
        <th class="center">PUKUL</th>
        <th class="center">HASIL TERA</th>
    </tr>

    @php
    $allPeneraan = [];
    foreach($items as $item) {
        $peneraan = $item->peneraan;
        if(is_array($peneraan)) {
            $allPeneraan = array_merge($allPeneraan, $peneraan);
        }
    }
    @endphp

    @foreach($allPeneraan as $peneraan)
    <tr>
        <td style="height:35px;">{{ $peneraan['kode_thermometer'] ?? '' }} / {{ $peneraan['area'] ?? '' }}</td>
        <td class="center">{{ $peneraan['standar'] ?? '' }}</td>
        <td>{{ $peneraan['pukul'] ?? '' }}</td>
        <td>{{ $peneraan['hasil_tera'] ?? '' }}</td>
        <td>{{ $peneraan['tindakan_perbaikan'] ?? '' }}</td>
        <td></td>
        <td></td>
    </tr>
    @endforeach

    @if(count($allPeneraan) < 8)
    @for($i = count($allPeneraan); $i < 8; $i++)
    <tr>
        <td style="height:35px;"></td>
        <td class="center"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @endfor
    @endif
</table>

<div style="text-align:right; font-size:8px;font-style:italic">QT 40 / 00</div>

{{-- KETERANGAN --}}
<table width="100%" class="small">
    <tr>
        <td>
            <strong>Keterangan :</strong><br>
            - Tera termometer dilakukan di setiap awal shift<br>
            - Termometer ditera dengan memasukkan sensor (probe) ke es (0 °C)<br>
            - Jika ada selisih angka display suhu dengan suhu standar,
              beri keterangan (+) atau (–) angka selisih (faktor koreksi)<br>
            - Jika faktor koreksi &lt; 0,5 °C, termometer perlu perbaikan
        </td>
    </tr>
</table>



</body>
</html>
