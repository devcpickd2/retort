<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-size: 9px; }
        table { border-collapse: collapse; }

        .title {
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }

        .small { font-size: 8px; }
        .center { text-align: center; }
        .sign { text-align: center; }

        .tbl-main, .tbl-main td {
            border: 0.5px solid #000;
        }

        .tbl-main td {
            padding: 4px;
            vertical-align: top;
        }

        .box {
            border: 0.6px solid #000;
            width: 14px;
            height: 14px;
            display: inline-block;
            margin-right: 6px;
        }

        .line {
            border-bottom: 0.4px solid #000;
            height: 16px;
            margin-bottom: 4px;
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
            FORM BERITA ACARA
        </td>
    </tr>
</table>

<br>

@php
$firstBeritaAcara = $beritaAcaras->first();
$nomor = $firstBeritaAcara ? $firstBeritaAcara->nomor : '';
$namaBarang = $firstBeritaAcara ? $firstBeritaAcara->nama_barang : '';
$jumlahBarang = $firstBeritaAcara ? $firstBeritaAcara->jumlah_barang : '';
$supplier = $firstBeritaAcara ? $firstBeritaAcara->supplier : '';
$uraianMasalah = $firstBeritaAcara ? $firstBeritaAcara->uraian_masalah : '';
$noSuratJalan = $firstBeritaAcara ? $firstBeritaAcara->no_surat_jalan : '';
$doPo = $firstBeritaAcara ? $firstBeritaAcara->do_po : '';
$tanggalKedatangan = $firstBeritaAcara ? \Carbon\Carbon::parse($firstBeritaAcara->tanggal_kedatangan)->format('d-m-Y') : '';
@endphp
<table width="100%" class="tbl-main small">
    <tr>
        <td width="50%">
            Nomor : {{ $nomor }}<br><br>
            Nama Barang : {{ $namaBarang }}<br><br>
            Jumlah Barang : {{ $jumlahBarang }}<br><br>
            Supplier : {{ $supplier }}<br><br>
            Uraian Masalah : {{ $uraianMasalah }}
        </td>
        <td width="50%">
            No Surat Jalan : {{ $noSuratJalan }}<br><br>
            DO / PO : {{ $doPo }}<br><br>
            Tanggal Kedatangan : {{ $tanggalKedatangan }}
        </td>
    </tr>
</table>

<br>

@php
$pengembalian = $firstBeritaAcara && $firstBeritaAcara->keputusan_pengembalian ? '√' : '';
$potonganHarga = $firstBeritaAcara && $firstBeritaAcara->keputusan_potongan_harga ? '√' : '';
$sortir = $firstBeritaAcara && $firstBeritaAcara->keputusan_sortir ? '√' : '';
$penukaranBarang = $firstBeritaAcara && $firstBeritaAcara->keputusan_penukaran_barang ? '√' : '';
$penggantianBiaya = $firstBeritaAcara && $firstBeritaAcara->keputusan_penggantian_biaya ? '√' : '';
@endphp
<table width="100%" class="small">
    <tr>
        <td width="50%">
            Keputusan :<br><br>
            <span class="box">{{ $pengembalian }}</span> Pengembalian Barang<br>
            <span class="box">{{ $potonganHarga }}</span> Potongan Harga<br>
            <span class="box">{{ $sortir }}</span> Sortir
        </td>
        <td width="50%">
            <br><br>
            <span class="box">{{ $penukaranBarang }}</span> Penukaran Barang<br>
            <span class="box">{{ $penggantianBiaya }}</span> Penggantian Biaya<br>
            <span class="box"></span> Lain-lain __________________
        </td>
    </tr>
</table>

<br>

<table width="100%" class="small">
    <tr>
        <td width="100%">Tanggal :</td>
    </tr>
</table>

<br>

<table width="100%" class="small">
    <tr>
        <td width="33%" class="sign">
            Dibuat Oleh,<br><br><br>
            ( _______________ )<br>
            QC Warehouse
        </td>
        <td width="33%" class="sign">
            Mengetahui,<br><br><br>
            ( _______________ )<br>
            PPIC
        </td>
        <td width="33%" class="sign">
            Disetujui Oleh,<br><br><br>
            ( _______________ )<br>
            QC Supervisor
        </td>
    </tr>
</table>

<br><br>

<table width="100%" class="tbl-main small">
    <tr>
        <td>
            <strong>Diisi Oleh Supplier</strong><br><br>
            A. Analisa Penyebab Penyimpangan :
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <br>
            B. Tindak Lanjut Perbaikan dan Pencegahan :
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </td>
    </tr>
</table>

<div style="text-align:right; font-size:8px;">QT 55 / 00</div>

</body>
</html>
