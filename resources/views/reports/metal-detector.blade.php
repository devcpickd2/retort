<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-size: 8px; }
        .title { font-size: 12px; font-weight: bold; text-align: center; }
        table { border-collapse: collapse; }

        .tbl-header td {
            padding: 2px;
            font-size: 8px;
        }

        .tbl-main, .tbl-main th, .tbl-main td {
            border: 0.3px solid #000;
        }

        .tbl-main th {
            font-size: 7px;
            text-align: center;
            vertical-align: middle;
        }

        .center { text-align: center; }
        .small { font-size: 7px; }
        .sign { text-align: center; }
    </style>
</head>

<body>



@php
$dates = $metals->groupBy(function ($item) {
    return $item->date;
});
@endphp

@foreach ($dates as $date => $dataPerDate)

{{-- HEADER LOGO + TITLE --}}
<table width="100%">
    <tr>
        <td class="small" width="40%">
            PT Charoen Pokphand Indonesia<br>
            Food Division
        </td>
        
    </tr>
</table>
<h2 class="title">PENGECEKAN METAL DETECTOR</h2>
<br>
<br>

@php
    $dateFilter = request('date') ? \Carbon\Carbon::parse(request('date'))->format('d-m-Y') : 'All Dates';
@endphp

<table width="100%" class="tbl-header">
    <tr>
        <td>Hari/ Tanggal : {{ $dateFilter }}</td>
    </tr>
</table>
<br>

<table width="100%" class="tbl-main small">
    <tr>
        <th rowspan="2" class="center">Pukul</th>
        <th rowspan="2" class="center">FE 1.0 mm</th>
        <th rowspan="2" class="center">NFE 1.5 mm</th>
        <th rowspan="2" class="center">SUS {{ Auth::user()->plant == '2debd595-89c4-4a7e-bf94-e623cc220ca6' ? '2.5' : '2.0' }} mm</th>
        <th colspan="2" class="center">Paraf</th>
    </tr>
    <tr>
        <th class="center">QC</th>
        <th class="center">Produksi</th>
    </tr>

    @for($i = 0; $i < 24; $i++)
        @php
            $hour = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
            $record = $dataPerDate->where('pukul', $hour)->first();
        @endphp
        <tr>
            <td class="center">{{ $hour }}</td>
            <td class="center">{{ $record && $record->fe == 'Terdeteksi' ? '✓' : '' }}</td>
            <td class="center">{{ $record && $record->nfe == 'Terdeteksi' ? '✓' : '' }}</td>
            <td class="center">{{ $record && $record->sus == 'Terdeteksi' ? '✓' : '' }}</td>
            <td class="center">{{ $record ? $record->username : '' }}</td>
            <td class="center">{{ $record ? $record->nama_produksi : '' }}</td>
        </tr>
    @endfor

</table>

<div style="text-align:right; font-size:8px;font-style:italic">QT 26 / 00</div>

<br>
<table>
    <tr>
        <td width="50%">
            <table width="100%" class="small">
                <tr>
                    <td>Keterangan : ✓ terdeteksi</td>
                    <td></td>
                </tr>
                <tr>
                    <td >
                        Catatan :
                    </td>
                </tr>
            </table>
        </td>
        <td width="50%">
            <table width="100%" class="sign small">
                <tr><td>Disetujui Oleh,</td></tr>
                <tr><td><br><br></td></tr>
                <tr><td>(___________________)</td></tr>
                <tr><td>QC SPV</td></tr>
            </table>
        </td>
    </tr>
</table>







@if (!$loop->last)
    <div style="page-break-after: always;"></div>
@endif
@endforeach

</body>
</html>
