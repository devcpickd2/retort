<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemeriksaan Input Bahan Baku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px; /* Font diperkecil agar muat */
        }
        .header-table, .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        .header-table td, .content-table th, .content-table td {
            border: 1px solid black;
            padding: 3px;
        }
        /* Styling Header Dokumen (Logo dll) */
        .header-title {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
        }
        .header-info {
            font-size: 9px;
        }
        .logo-container {
            text-align: center;
            width: 80px;
        }
        /* Styling Tabel Utama */
        .content-table th {
            text-align: center;
            background-color: #dbe5f1; /* Warna biru muda seperti Excel */
            vertical-align: middle;
        }
        .content-table td {
            vertical-align: top;
        }
        .center { text-align: center; }
        .bg-grey { background-color: #f0f0f0; }
        
        /* Footer Tanda Tangan */
        .footer-container {
            margin-top: 10px;
            width: 100%;
        }
        .signature-table {
            width: 40%;
            float: right;
            border-collapse: collapse;
            text-align: center;
        }
        .signature-table td {
            border: 1px solid black;
            height: 60px; /* Ruang untuk tanda tangan */
            vertical-align: bottom;
        }
        .notes {
            float: left;
            width: 55%;
            font-size: 9px;
        }
        .clear { clear: both; }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td rowspan="3" class="logo-container">
                <img src="{{ public_path('images/logo-cp.png') }}" alt="Logo CP" style="width: 50px;"> 
                <br><b>CP</b><br>FOOD DIVISION
            </td>
            <td rowspan="3" class="header-title">FORM<br>PEMERIKSAAN INPUT BAHAN BAKU</td>
            <td class="header-info" width="150">No. Dokumen : FR-QC-01</td>
        </tr>
        <tr>
            <td class="header-info">Revisi : 3</td>
        </tr>
        <tr>
            <td class="header-info">Tanggal Efektif : 11-12-2024</td>
        </tr>
        <tr>
            <td colspan="3" style="border: none; padding-top: 5px; font-weight: bold;">
                Hari/Tanggal : {{ \Carbon\Carbon::now()->translatedFormat('l / d F Y') }}
            </td>
        </tr>
    </table>

    <table class="content-table">
        <thead>
            <tr>
                <th rowspan="2" width="20">No.</th>
                <th rowspan="2" width="100">Nama Produk</th>
                <th rowspan="2" width="80">Supplier</th>
                <th colspan="2">Tanggal</th>
                <th rowspan="2" width="40">Jumlah Barang</th>
                <th rowspan="2" width="40">Jumlah Sampel</th>
                <th rowspan="2" width="40">Jumlah Reject</th>
                <th colspan="4">Kondisi Fisik*</th>
                <th rowspan="2" width="30">K.A / FFA</th>
                <th rowspan="2" width="20">Logo Halal</th>
                <th rowspan="2">Negara Asal / Produsen</th>
                <th colspan="3">Dokumen</th>
                <th colspan="3">Transporter</th>
                <th rowspan="2">DO / PO</th>
                <th rowspan="2">Ket***</th>
            </tr>
            <tr>
                <th>Lot/Kode/ Batch</th>
                <th>Expire Date</th>
                
                <th width="15">W</th> <th width="15">K</th> <th width="15">A</th> <th width="15">K</th> <th width="15">B</th> <th width="15">T</th> <th width="20">COA</th>
                
                <th>Nopol Mobil</th>
                <th>Suhu Mobil</th>
                <th>Kondisi Mobil**</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($inspections as $inspection)
                {{-- Kita loop detail produk karena 1 inspeksi bisa punya banyak batch --}}
                @foreach($inspection->productDetails as $detail)
                <tr>
                    <td class="center">{{ $no++ }}</td>
                    <td>{{ $inspection->bahan_baku }}</td>
                    <td>{{ $inspection->supplier }}</td>
                    
                    <td>{{ $detail->kode_batch }}</td>
                    <td>{{ \Carbon\Carbon::parse($detail->exp)->format('d-m-Y') }}</td>
                    
                    <td class="center">{{ $detail->jumlah }}</td>
                    <td class="center">{{ $detail->jumlah_sampel }}</td>
                    <td class="center">{{ $detail->jumlah_reject }}</td>
                    
                    <td class="center">{{ $inspection->mobil_check_warna ? 'V' : '-' }}</td>
                    <td class="center">{{ $inspection->mobil_check_kotoran ? 'V' : '-' }}</td>
                    <td class="center">{{ $inspection->mobil_check_aroma ? 'V' : '-' }}</td>
                    <td class="center">{{ $inspection->mobil_check_kemasan ? 'V' : '-' }}</td>
                    
                    <td class="center">{{ $inspection->analisa_ka_ffa ? 'OK' : '-' }}</td>
                    
                    <td class="center">{{ $inspection->analisa_logo_halal ? 'V' : '-' }}</td>
                    
                    <td>
                        {{ $inspection->analisa_negara_asal }} / <br>
                        {{ $inspection->analisa_produsen }}
                    </td>
                    
                    <td class="center">{{ $inspection->dokumen_halal_berlaku ? 'V' : '' }}</td> <td class="center">{{ !$inspection->dokumen_halal_berlaku ? 'V' : '' }}</td> <td class="center">{{ $inspection->dokumen_coa_file ? 'V' : '-' }}</td>
                    
                    <td>{{ $inspection->nopol_mobil }}</td>
                    <td class="center">{{ $inspection->suhu_mobil }}</td>
                    <td>{{ $inspection->kondisi_mobil }}</td>
                    
                    <td>{{ $inspection->do_po }}</td>
                    
                    <td>{{ $inspection->keterangan ?? '-' }}</td>
                </tr>
                @endforeach
            @endforeach
            
            @if($inspections->isEmpty())
            <tr>
                <td colspan="23" class="center">Tidak ada data untuk periode ini.</td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="footer-container">
        <div class="notes">
            <strong>Keterangan:</strong><br>
            * V sesuai spesifikasi/standar<br>
            ** 1: bersih &nbsp; 3: bau &nbsp; 5: basah &nbsp; 7: bebas hama<br>
            &nbsp;&nbsp;&nbsp; 2: kotor &nbsp; 4: bocor &nbsp; 6: kering<br>
            *** 1. Jika raw meat dilakukan pengisian suhu produk<br>
            &nbsp;&nbsp;&nbsp;&nbsp; 2. Pengisi nomor segel: {{ $inspection->no_segel ?? '-' }}<br>
            &nbsp;&nbsp;&nbsp;&nbsp; 3. Pengisian nama supir<br>
            &nbsp;&nbsp;&nbsp;&nbsp; 4. Pengisian bahan baku allergen
        </div>

        <table class="signature-table">
            <tr>
                <td width="50%">Diperiksa oleh:</td>
                <td width="50%">Disetujui oleh:</td>
            </tr>
            <tr>
                <td>
                   <br><br><br>
                   QC Inspector
                </td>
                <td>
                   <br><br><br>
                   QC SPV / Manager
                </td>
            </tr>
        </table>
        <div class="clear"></div>
    </div>

</body>
</html>