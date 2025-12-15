<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-size: 7px; }
        table { border-collapse: collapse; }
        .title { font-size: 11px; font-weight: bold; text-align: center; }
        .small { font-size: 7px; }
        .center { text-align: center; }
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
        <td width="40%" class="small">
            PT Charoen Pokphand Indonesia<br>
            Food Division
        </td>
        <td width="60%" class="title">
            PERSONAL HYGIENE & KESEHATAN KARYAWAN
        </td>
    </tr>
</table>

<br>

<table width="100%" class="tbl-header">
    <tr>
        <td width="15%">Hari / Tanggal</td>
        <td width="35%">: __________________________</td>
        <td width="10%">Area</td>
        <td width="40%">: __________________________</td>
    </tr>
</table>

<br>

{{-- TABEL UTAMA --}}
<table width="100%" class="tbl-main small">
    <tr>
        <th rowspan="3" width="3%">No</th>
        <th rowspan="3" width="10%">Nama</th>
        <th rowspan="3" width="5%">Waktu</th>
        <th colspan="15">PERSONAL HYGIENE</th>
        <th colspan="8">KESEHATAN KARYAWAN</th>
        <th rowspan="3" width="4%">TOTAL<br>Skor</th>
        <th rowspan="3" width="10%">Keterangan</th>
        <th colspan="2">Paraf</th>
    </tr>

    <tr>
        <th colspan="9">Aksesoris</th>
        <th colspan="6">Atribut Kerja</th>
        <th colspan="8"></th>
        <th rowspan="2">QC</th>
        <th rowspan="2">Prod</th>
    </tr>

    <tr>
        {{-- Aksesoris --}}
        <th>Anting</th>
        <th>Kalung</th>
        <th>Cincin</th>
        <th>Jam tangan</th>
        <th>Peniti</th>
        <th>Bros</th>
        <th>Penyet</th>
        <th>Softlens</th>
        <th>Eyeshadow</th>

        {{-- Atribut kerja --}}
        <th>Scrapper</th>
        <th>Boot</th>
        <th>Masker</th>
        <th>Cap/Hairnet</th>
        <th>Kuku</th>
        <th>Parfum</th>

        {{-- Kesehatan --}}
        <th>Diare</th>
        <th>Demam</th>
        <th>Luka luar</th>
        <th>Batuk</th>
        <th>Radang</th>
        <th>Influenza</th>
        <th>Sakit mata</th>
        <th>Lainnya</th>
    </tr>

    @for($i=1; $i<=23; $i++)
    <tr>
        <td class="center">{{ $i }}</td>
        <td></td>
        <td></td>

        @for($j=1; $j<=15; $j++)
            <td></td>
        @endfor

        @for($k=1; $k<=8; $k++)
            <td></td>
        @endfor

        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @endfor
</table>

<br><br>

<table width="100%" class="small">
    <tr>
        <td width="70%"></td>
        <td width="30%" class="sign">
            Diverifikasi oleh,<br><br><br>
            ( ___________________ )<br>
            QC SPV
        </td>
    </tr>
</table>

</body>
</html>
