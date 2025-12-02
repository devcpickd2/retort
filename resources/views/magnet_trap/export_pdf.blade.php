<!DOCTYPE html>
<html>
<head>
    <title>Checklist Cleaning Magnet Trap</title>
    <style>
        /* TCPDF lebih stabil dengan font Helvetica/Times dan ukuran pt */
        body { font-family: helvetica; font-size: 9pt; }
        
        /* Table Utama */
        table { width: 100%; border-collapse: collapse; }
        
        /* Style Header & Cell Data */
        /* Line-height diatur agar teks tidak terlalu mepet atas-bawah */
        th { border: 1px solid black; background-color: #f0f0f0; font-weight: bold; text-align: center; line-height: 15px; }
        td { border: 1px solid black; text-align: center; line-height: 15px; }

        /* Helper untuk text alignment */
        .text-left { text-align: left; }
        
        /* Footer Table (Tanpa Border Global) untuk Layout Tanda Tangan */
        .footer-layout td { border: none; }
    </style>
</head>
<body>

    <table cellpadding="4">
        <tr>
            <td width="15%" style="border: 1px solid black;">
                <img src="{{ public_path('images/logo-cp.png') }}" width="50" height="auto" alt="Logo">
                <br><b>CP FOOD DIVISION</b>
            </td>
            
            <td width="55%" style="border: 1px solid black;">
                <br><b>FORM</b><br>
                <b>CHECKLIST CLEANING MAGNET TRAP</b>
            </td>
            
            <td width="30%" style="border: 1px solid black; padding: 0;">
                <table cellpadding="3" border="0" style="width: 100%;">
                    <tr>
                        <td align="left" style="border-bottom: 1px solid black; border-top: none; border-left: none; border-right: none;">No. Dokumen : FR-QC-61</td>
                    </tr>
                    <tr>
                        <td align="left" style="border-bottom: 1px solid black; border-top: none; border-left: none; border-right: none;">Revisi : 2</td>
                    </tr>
                    <tr>
                        <td align="left" style="border-bottom: 1px solid black; border-top: none; border-left: none; border-right: none; background-color: yellow;">Tanggal Efektif : 16-April-2020</td>
                    </tr>
                    <tr>
                        <td align="left" style="border: none;">Halaman : 1 dari 1</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <br><br>

    <table cellpadding="4">
        <thead>
            <tr>
                <th width="5%" rowspan="2"><br>No.</th>
                <th width="10%" rowspan="2"><br>Batch Ke-</th>
                <th width="10%" rowspan="2"><br>Pukul</th>
                <th width="45%" colspan="2">Tgl : {{ now()->format('d-M-Y') }} </th>
                <th width="30%" colspan="3">PARAF</th>
            </tr>
            <tr>
                <th width="10%">Jml Temuan</th>
                <th width="35%">Keterangan</th>
                <th width="10%">QC</th>
                <th width="10%">Prod</th>
                <th width="10%">Eng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr nobr="true">
                <td width="5%">{{ $index + 1 }}</td>
                <td width="10%">{{ $item->kode_batch }}</td>
                <td width="10%">{{ $item->pukul }}</td>
                <td width="10%">{{ $item->jumlah_temuan }}</td>
                <td width="35%" align="left">{{ $item->keterangan }}</td>
                <td width="10%">{{ $item->verified_by_spv_uuid ? 'V' : '' }}</td> 
                <td width="10%">{{ $item->created_by ? 'V' : '' }}</td>
                <td width="10%"></td>
            </tr>
            @endforeach
            
            {{-- Loop @for untuk baris kosong SUDAH DIHAPUS --}}
            {{-- Tabel akan otomatis mengikuti jumlah data --}}
        </tbody>
    </table>

    <br>

    <nobr>
        <table class="footer-layout">
            <tr>
                <td width="75%"></td>
                
                <td width="25%">
                    <table style="border: 1px solid black; width: 100%; text-align: center;" cellpadding="2">
                        <tr>
                            <td style="border-bottom: 1px solid black; background-color: #f0f0f0; font-size: 8pt;">Disetujui oleh,</td>
                        </tr>
                        <tr>
                            <td height="60px" style="height: 60px;">
                                <br><br><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid black; font-weight: bold; font-size: 8pt;">QC.SPV.</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </nobr>

</body>
</html>