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
<table width="100%">
    <tr>
        <td width="40%" class="small">
            PT Charoen Pokphand Indonesia<br>
            Food Division
        </td>
        <td width="60%" class="title">
            PENGECEKAN METAL DETECTOR
        </td>
    </tr>
</table>

<br>

<table width="100%" class="tbl-main small">
    <tr>
        <th rowspan="3" width="10%" class="center">Pukul</th>
        <th colspan="4">Hari / Tanggal : <span style="font-weight: normal;">{{ \Carbon\Carbon::parse($date)->format('l, d-m-Y') }}</span></th>
    </tr>
    <tr>
        
        <th rowspan="2" class="center">FE 1.0<br>mm</th>
        <th rowspan="2" class="center">NFE 1.5<br>mm</th>
        <th rowspan="2" class="center">SUS {{ Auth::user()->plant == '2debd595-89c4-4a7e-bf94-e623cc220ca6' ? '2.5' : '2.0' }}<br>mm</th>
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

<div style="text-align:right; font-size:8px;">QT 26 / 00</div>

<br>

<table width="100%" class="small">
    <tr>
        <td width="40%">Keterangan : ✓ terdeteksi</td>
        <td width="60%"></td>
    </tr>
    <tr>
        <td colspan="2">
            Catatan :
            @php
                $notes = $dataPerDate->pluck('catatan')->filter()->join('; ');
            @endphp
            {{ $notes ?? '_________________________________________________' }}<br><br>
            _________________________________________________________
        </td>
    </tr>
</table>

<br><br>

<table width="100%" class="sign small">
    <tr><td>Disetujui Oleh,</td></tr>
    <tr><td><br><br></td></tr>
    <tr><td>(___________________)</td></tr>
    <tr><td>QC SPV</td></tr>
</table>



@if (!$loop->last)
    <div style="page-break-after: always;"></div>
@endif
@endforeach

</body>
</html>
