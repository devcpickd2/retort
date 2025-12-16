<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-size: 8px; }
        table { border-collapse: collapse; }

        .title {
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }

        .small { font-size: 7px; }
        .center { text-align: center; }
        .right { text-align: right; }
        .sign { text-align: center; }

        .tbl-main, .tbl-main th, .tbl-main td {
            border: 0.3px solid #000;
        }

        .tbl-main th {
            text-align: center;
            vertical-align: middle;
            font-size: 7px;
        }

        .tbl-header td {
            padding: 2px;
            font-size: 8px;
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
<h2 class="title">PENGECEKAN KLORIN</h2>
<br>
<br>


{{-- TABEL UTAMA --}}
<table width="100%" class="tbl-main small">
    @php
    $date = $request->input('date');
    $formattedDate = $date ? \Carbon\Carbon::parse($date)->format('d-m-Y') : '';
    @endphp
    <tr>
        <th colspan="3">Hari / Tanggal : {{ $formattedDate }}</th>
        <th colspan="2" class="center">Paraf</th>
    </tr>
    <tr>
        <th class="center">Pukul</th>
        <th class="center">Foot Basin</th>
        <th class="center">Hand Basin</th>
        <th class="center">QC</th>
        <th class="center">Produksi</th>
    </tr>
    @if($klorins->count() > 0)
        @foreach($klorins as $klorin)
        <tr>
            <td class="center">{{ \Carbon\Carbon::parse($klorin->pukul)->format('H:i') }}</td>
            <td class="center">{{ $klorin->footbasin ? '√' : '' }}</td>
            <td class="center">{{ $klorin->handbasin ? '√' : '' }}</td>
            <td class="center">{{ $klorin->username ?? '' }}</td>
            <td class="center">{{ $klorin->nama_produksi ?? '' }}</td>
        </tr>
        @endforeach
    @else
        <tr>
            <td class="center">-</td>
            <td class="center">-</td>
            <td class="center">-</td>
            <td class="center">-</td>
            <td class="center">-</td>
        </tr>
    @endif
</table>
<div style="text-align:right; font-size:8px;font-style:italic;">QT 25 / 00</div>
<br>

<table width="100%" class="small">
    <tr>
        <td>Keterangan : √ Sesuai Standar</td>
    </tr>
    <tr>
        <td>Catatan :</td>
    </tr>
</table>

<br><br>

<table width="100%" class="small">
    <tr>
        <td width="60%"></td>
        <td width="40%" class="sign">
            Disetujui Oleh,<br><br><br>
            ( ___________________ )<br>
            QC SPV
        </td>
    </tr>
</table>

</body>
</html>
