<!DOCTYPE html>
<html>
<head>
    <title>Checklist Cleaning Magnet Trap</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid black; padding: 4px; text-align: center; }
        
        /* Header Khusus */
        .header-table td { border: 1px solid black; padding: 5px; }
        .logo-section { width: 15%; text-align: center; }
        .title-section { width: 55%; font-weight: bold; font-size: 14px; text-align: center; }
        .doc-info-section { width: 30%; text-align: left; font-size: 10px; }
        
        /* Table Data */
        .data-table th { background-color: #f0f0f0; }
        .col-no { width: 5%; }
        .col-batch { width: 10%; }
        .col-pukul { width: 10%; }
        .col-temuan { width: 10%; }
        .col-ket { width: 35%; }
        .col-paraf { width: 10%; }

        /* Footer */
        .footer-box { width: 200px; border: 1px solid black; float: right; text-align: center; margin-top: 10px; }
        .footer-content { height: 60px; }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="logo-section">
                <img src="{{ public_path('images/logo-cp.png') }}" style="width: 50px; height: auto;" alt="Logo">
                <br><b>CP FOOD DIVISION</b>
            </td>
            <td class="title-section">
                FORM<br><br>
                CHECKLIST CLEANING MAGNET TRAP
            </td>
            <td class="doc-info-section" style="padding: 0;">
                <table style="border: none; margin: 0; width: 100%;">
                    <tr>
                        <td style="border: none; border-bottom: 1px solid black; text-align: left;">No. Dokumen : FR-QC-61</td>
                    </tr>
                    <tr>
                        <td style="border: none; border-bottom: 1px solid black; text-align: left;">Revisi : 2</td>
                    </tr>
                    <tr>
                        <td style="border: none; border-bottom: 1px solid black; text-align: left; background-color: yellow;">Tanggal Efektif : 16-April-2020</td>
                    </tr>
                    <tr>
                        <td style="border: none; text-align: left;">Halaman : 1 dari 1</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Batch Ke-</th>
                <th rowspan="2">Pukul</th>
                <th colspan="2">Tgl : {{ now()->format('d-M-Y') }} </th>
                <th colspan="3">PARAF</th>
            </tr>
            <tr>
                <th>Jumlah Temuan</th>
                <th>Keterangan</th>
                <th>QC</th>
                <th>Prod</th>
                <th>Eng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->kode_batch }}</td>
                <td>{{ $item->pukul }}</td>
                <td>{{ $item->jumlah_temuan }}</td>
                <td style="text-align: left;">{{ $item->keterangan }}</td>
                <td>{{ $item->verified_by_spv_uuid ? 'V' : '' }}</td> 
                <td>{{ $item->created_by ? 'V' : '' }}</td>
                <td></td>
            </tr>
            @endforeach

            @for($i = 0; $i < (15 - count($data)); $i++)
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endfor
        </tbody>
    </table>

    <div class="footer-box">
        <div style="border-bottom: 1px solid black; padding: 2px;">Disetujui oleh,</div>
        <div class="footer-content">
            <br><br>
        </div>
        <div style="border-top: 1px solid black; padding: 2px; font-weight: bold;">QC.SPV.</div>
    </div>

</body>
</html>