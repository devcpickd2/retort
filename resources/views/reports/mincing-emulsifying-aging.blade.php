<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-size: 8px; font-family: sans-serif; }
        .title { font-size: 12px; font-weight: bold; text-align: center; }
        table { border-collapse: collapse; width: 100%; }

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
            background-color: #f2f2f2;
        }

        .center { text-align: center; }
        .small { font-size: 7px; }
        .sign { text-align: center; }
        .page-break { page-break-after: always; }
    </style>
</head>

<body>

@foreach ($produks as $produk)
    @php
        // Helper untuk menghindari TypeError: Argument #1 ($json) must be of type string, array given
        $safeDecode = function($data) {
            if (is_array($data)) return $data;
            return json_decode($data ?? '[]', true) ?? [];
        };

        $nonPremixItems = $safeDecode($produk->non_premix);
        $premixItems    = $safeDecode($produk->premix);
        $suhuGrinding = $safeDecode($produk->suhu_sebelum_grinding);

        $numNonPremixCols = count($nonPremixItems) > 0 ? count($nonPremixItems) : 1;
        $numPremixCols    = count($premixItems) > 0 ? count($premixItems) : 1;
    @endphp

    {{-- HEADER --}}
    <table>
        <tr>
            <td style="font-weight: bold;">
                PT Charoen Pokphand Indonesia<br>
                Food Division
            </td>
        </tr>
    </table>

    <h3 class="center">PEMERIKSAAN MINCING – EMULSIFYING – AGING</h3>

    {{-- INFO --}}
    <table class="tbl-header">
        <tr>
            <td width="15%">Hari / Tgl</td>
            <td width="25%">: {{ \Carbon\Carbon::parse($produk->date)->format('d-m-Y') }}</td>
            <td width="10%">Shift</td>
            <td width="15%">: {{ $produk->shift }}</td>
            <td width="35%">Nama Varian: {{ $produk->nama_produk }}</td>
        </tr>
    </table>

    <br>

    {{-- TABLE UTAMA BATCH (Non-Premix) --}}
    <table class="tbl-main small">
        <tr>
            <th width="15%" rowspan="2">Bahan Baku dan Bahan Tambahan (Non-Premix)</th>
            @for($i=1; $i<=$numNonPremixCols; $i++)
                <th colspan="4">Batch {{ $i }}</th>
            @endfor
        </tr>
        <tr>
            @for($i=1; $i<=$numNonPremixCols; $i++)
                <th>Kode</th>
                <th>(°C)</th>
                <th>pH</th>
                <th>Kg</th>
            @endfor
        </tr>

        @php $maxRowNonPremix = 12; @endphp
        @for($i=0; $i<$maxRowNonPremix; $i++)
            <tr>
                <td style="padding-left: 5px;">
                    {{-- Menampilkan nama bahan di kolom pertama --}}
                    {{ $nonPremixItems[$i]['nama_bahan'] ?? ($i + 1) }}
                </td>
                @for($j=0; $j<$numNonPremixCols; $j++)
                    <td class="center">{{ $nonPremixItems[$j]['kode_bahan'] ?? '' }}</td>
                    <td class="center">{{ $nonPremixItems[$j]['suhu_bahan'] ?? '' }}</td>
                    <td class="center">{{ $nonPremixItems[$j]['ph_bahan'] ?? '' }}</td>
                    <td class="center">{{ $nonPremixItems[$j]['berat_bahan'] ?? '' }}</td>
                @endfor
            </tr>
        @endfor
    </table>

    <br>

    {{-- PREMIX --}}
    <table class="tbl-main small">
        <tr>
            <th width="15%" rowspan="2">Premix</th>
            @for($i=1; $i<=$numPremixCols; $i++)
                <th colspan="2">Batch {{ $i }}</th>
            @endfor
        </tr>
        <tr>
            @for($i=1; $i<=$numPremixCols; $i++)
                <th>Kode</th>
                <th>Kg</th>
            @endfor
        </tr>

        @php $maxRowPremix = 3; @endphp
        @for($i=0; $i<$maxRowPremix; $i++)
            <tr>
                <td class="center">{{ $i+1 }}</td>
                @for($j=0; $j<$numPremixCols; $j++)
                    <td class="center">{{ $premixItems[$j]['kode_premix'] ?? '' }}</td>
                    <td class="center">{{ $premixItems[$j]['berat_premix'] ?? '' }}</td>
                @endfor
            </tr>
        @endfor
    </table>

    <br>

    {{-- WAKTU & SUHU GRINDING (Dinamis) --}}
    <table class="tbl-main small">
        <tr>
            <td width="40%" style="padding-left: 5px;">Waktu Preparation</td>
            <td width="60%">: {{ $produk->waktu_mulai ?? '-' }} s/d {{ $produk->waktu_selesai ?? '-' }}</td>
        </tr>
        
        {{-- Menampilkan data Daging dari input dinamis --}}
        @if(count($suhuGrinding) > 0)
            @foreach($suhuGrinding as $sg)
            <tr>
                <td style="padding-left: 5px;">Suhu Sebelum Grinding ({{ $sg['daging'] ?? 'Daging' }})</td>
                <td>: {{ $sg['suhu'] ?? '-' }} °C</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td style="padding-left: 5px;">Suhu Sebelum Grinding</td>
                <td>: -</td>
            </tr>
        @endif

        <tr>
            <td style="padding-left: 5px;">Waktu Mixing Premix</td>
            <td>: {{ $produk->waktu_mixing_premix_awal ?? '-' }} s/d {{ $produk->waktu_mixing_premix_akhir ?? '-' }}</td>
        </tr>
        <tr>
            <td style="padding-left: 5px;">Waktu Bowl Cutter / Aging Emulsi</td>
            <td>: {{ $produk->waktu_bowl_cutter_awal ?? '-' }} s/d {{ $produk->waktu_aging_emulsi_akhir ?? '-' }}</td>
        </tr>
        <tr>
            <td style="padding-left: 5px;">Suhu Akhir Emulsi Gel (Std < 5°C)</td>
            <td>: {{ $produk->suhu_akhir_emulsi_gel ?? '-' }} °C</td>
        </tr>
        <tr>
            <td style="padding-left: 5px;">Suhu Akhir Mixing (Std 2–5°C)</td>
            <td>: {{ $produk->suhu_akhir_mixing ?? '-' }} °C</td>
        </tr>
        <tr>
            <td style="padding-left: 5px;">Suhu Akhir Emulsifying (Std 14±2°C)</td>
            <td>: {{ $produk->suhu_akhir_emulsi ?? '-' }} °C</td>
        </tr>
    </table>

    <br>

    {{-- PARAF --}}
    <table class="tbl-main small">
        <tr>
            <td width="25%" class="center">PARAF QC</td>
            <td width="25%" class="center" style="height: 30px;">{{ $produk->username }}</td>
            <td width="25%" class="center">PARAF Produksi</td>
            <td width="25%" class="center">{{ $produk->nama_produksi ?? '..........' }}</td>
        </tr>
    </table>

    <br>

    {{-- CATATAN --}}
    <table class="small">
        <tr><td>Catatan: {{ $produk->catatan ?? '-' }}</td></tr>
        <tr><td>__________________________________________________________________________________________</td></tr>
    </table>

    <br>

    <table class="sign small">
        <tr>
            <td width="70%"></td>
            <td width="30%">
                Disetujui oleh,<br><br><br><br>
                (___________________)<br>
                QC SPV
            </td>
        </tr>
    </table>

    <div style="text-align:right; font-size:7px; margin-top: 10px;">Form QT 10 / 01</div>

    @if (!$loop->last)
        <div class="page-break"></div>
    @endif
@endforeach

</body>
</html>