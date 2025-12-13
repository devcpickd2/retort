<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-size: 9px; }
        .title { font-size: 12px; font-weight: bold; text-align: center; }
        table { border-collapse: collapse; }

        .tbl-header td {
            font-size: 9px;
            padding: 2px 0;
        }

        .tbl-main, 
        .tbl-main th, 
        .tbl-main td {
            border: 0.3px solid #000;
        }

        .tbl-main th {
            text-align: center;
            vertical-align: middle;
            font-size: 8px;
        }

        .center { text-align: center; }
        .sign { text-align: center; }
        .small { font-size: 8px; }
    </style>
</head>

<body>

{{-- HEADER LOGO + TITLE --}}
<table width="100%">
    <tr>
        <td class="small" width="40%">
            PT Charoen Pokphand Indonesia<br>
            Food Division
        </td>
        
    </tr>
</table>
<h2 class="title">CHECKLIST CLEANING MAGNET TRAP</h2>
<br>
<br>

@php
    $dateFilter = request('date') ? \Carbon\Carbon::parse(request('date'))->format('d-m-Y') : 'All Dates';
@endphp

<table width="100%" class="tbl-header">
    <tr>
        <td>Tgl : {{ $dateFilter }}</td>
    </tr>
</table>
<br>

{{-- TABLE --}}
<table width="100%" class="tbl-main small">
    <tr>
        <th class="center" rowspan="2" style="width: 50px;">No.</th>
        <th class="center" rowspan="2">Batch Ke-</th>
        <th class="center" rowspan="2">Pukul</th>
        <th class="center" rowspan="2">Jumlah Temuan</th>
        <th class="center" rowspan="2">Keterangan</th>
        <th class="center" colspan="3">Paraf</th>
    </tr>
    <tr>
        <td>QC</td>
        <td>Prod</td>
        <td>Eng</td>
    </tr>

    @forelse($magnetTraps as $index => $item)
    <tr>
        <td class="center">{{ $index + 1 }}</td>
        <td class="center">{{ $item->kode_batch ?? '-' }}</td>
        <td class="center">{{ $item->pukul ? \Carbon\Carbon::parse($item->pukul)->format('H:i') : '-' }}</td>
        <td class="center">{{ $item->jumlah_temuan ?? '-' }}</td>
        <td class="center">{{ Str::limit($item->keterangan ?? '-', 30) }}</td>
        <td class="center">{{ $item->username ?? '-' }}</td>
        <td class="center">{{ $item->produksi->name ?? $item->produksi_id ?? '-' }}</td>
        <td class="center">{{ $item->engineer->name ?? $item->engineer_id ?? '-' }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="8" class="center">Tidak ada data cleaning magnet trap</td>
    </tr>
    @endforelse

</table>
<br>
<table width="100%" class="small">
    <tr>
        <td align="right">
            {{-- SIGN --}}
            <table width="100%">
                <tr>
                    <td width="70%"></td>
                    <td width="30%" class="sign">
                        Disetujui oleh,<br><br><br><br>
                        (___________________)<br>
                        QC SPV
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>



</body>
</html>
