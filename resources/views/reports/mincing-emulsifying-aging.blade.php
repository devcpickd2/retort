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

@foreach ($produks as $produk)
    {{-- HEADER --}}
    <table width="100%">
        <tr>
            <td>
                PT Charoen Pokphand Indonesia<br>
                Food Division
            </td>
        </tr>
    </table>

    <h3 class="center">PEMERIKSAAN MINCING – EMULSIFYING – AGING</h3>

    {{-- INFO --}}
    <table width="100%" class="tbl-header">
        <tr>
            <td width="20%">Hari / Tgl</td>
            <td width="30%">: {{ \Carbon\Carbon::parse($produk->date)->format('d-m-Y') }}</td>
            <td width="15%">Shift</td>
            <td width="15%">: {{ $produk->shift }}</td>
            <td width="20%">Nama Varian : {{ $produk->nama_produk }}</td>
        </tr>
    </table>

    <br>

    {{-- TABLE UTAMA BATCH (Non-Premix) --}}
    <table width="100%" class="tbl-main small">
        <tr>
            <th width="10%" rowspan="2">Bahan Baku dan Bahan Tambahan (Non-Premix)</th>

            @php
                $nonPremixItems = json_decode($produk->non_premix ?? '[]', true);
                $numNonPremixCols = count($nonPremixItems) > 0 ? count($nonPremixItems) : 1;
                $colWidth = 84 / ($numNonPremixCols * 4); // Distribute 84% width among dynamic columns (Kode, °C, pH, Kg, Sens)
            @endphp
            @for($i=1; $i<=$numNonPremixCols; $i++)
                <th colspan="4">{{ $i }}</th>
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

        @php
            $maxRowNonPremix = 15; // Assuming max 15 rows for non-premix items
        @endphp
        @for($i=0; $i<$maxRowNonPremix; $i++)
            <tr>
                <td class="center">{{ $i+1 }}</td>
                <td>{{ $nonPremixItems[$i]['nama_bahan'] ?? '' }}</td>
                @for($j=0; $j<$numNonPremixCols; $j++)
                    <td>{{ $nonPremixItems[$j]['kode_bahan'] ?? '' }}</td>
                    <td>{{ $nonPremixItems[$j]['suhu_bahan'] ?? '' }}</td>
                    <td>{{ $nonPremixItems[$j]['ph_bahan'] ?? '' }}</td>
                    <td>{{ $nonPremixItems[$j]['berat_bahan'] ?? '' }}</td>
                @endfor
            </tr>
        @endfor
    </table>

    <br>

    {{-- PREMIX --}}
    <table width="100%" class="tbl-main small">
        <tr>
            <th width="10%">Premix</th>
            @php
                $premixItems = json_decode($produk->premix ?? '[]', true);
                $numPremixCols = count($premixItems) > 0 ? count($premixItems) : 1;
                $colWidthPremix = 90 / ($numPremixCols * 2); // Distribute 90% width among dynamic columns (Kode, Kg)
            @endphp
            @for($i=1; $i<=$numPremixCols; $i++)
                <th colspan="2">{{ $i }}</th>
            @endfor
        </tr>

        <tr>
            @for($i=1; $i<=$numPremixCols; $i++)
                <th>Kode</th>
                <th>Kg</th>
            @endfor
        </tr>

        @php
            $maxRowPremix = 3; // Assuming max 3 rows for premix items
        @endphp
        @for($i=0; $i<$maxRowPremix; $i++)
            <tr>
                <td class="center">{{ $i+1 }}</td>
                @for($j=0; $j<$numPremixCols; $j++)
                    <td>{{ $premixItems[$j]['kode_premix'] ?? '' }}</td>
                    <td>{{ $premixItems[$j]['berat_premix'] ?? '' }}</td>
                @endfor
            </tr>
        @endfor
    </table>

    <br>

    {{-- WAKTU --}}
    <table width="100%" class="tbl-main small">
        @php
            $waktu = [
                'Waktu mulai' => $produk->waktu_mulai,
                'Waktu selesai' => $produk->waktu_selesai,
                'Suhu Sebelum Grinding' => $produk->suhu_sebelum_grinding,
                'Waktu Mixing Premix Awal' => $produk->waktu_mixing_premix_awal,
                'Waktu Mixing Premix Akhir' => $produk->waktu_mixing_premix_akhir,
                'Waktu Bowl Cutter Awal' => $produk->waktu_bowl_cutter_awal,
                'Waktu Bowl Cutter Akhir' => $produk->waktu_bowl_cutter_akhir,
                'Waktu Aging Emulsi Awal' => $produk->waktu_aging_emulsi_awal,
                'Waktu Aging Emulsi Akhir' => $produk->waktu_aging_emulsi_akhir,
                'Suhu Akhir Emulsi Gel' => $produk->suhu_akhir_emulsi_gel,
                'Waktu Mixing' => $produk->waktu_mixing,
                'Suhu Akhir Mixing' => $produk->suhu_akhir_mixing,
                'Suhu Akhir Emulsifying' => $produk->suhu_akhir_emulsi,
            ];
        @endphp

        @foreach($waktu as $label => $value)
        <tr>
            <td width="40%">{{ $label }}</td>
            <td width="60%">: {{ $value ?? '-' }}</td>
        </tr>
        @endforeach
    </table>

    <br>

    <table width="100%" class="tbl-main small">
        <tr>
            <td width="25%">PARAF QC</td>
            <td width="15%">{{ $produk->username }}</td>
            <td width="25%">PARAF Produksi</td>
            <td width="35%">{{ $produk->nama_produksi }}</td>
        </tr>
    </table>

    <br>

    {{-- CATATAN --}}
    <table width="100%" class="small">
        <tr><td>Catatan: {{ $produk->catatan ?? '-' }}</td></tr>
        <tr><td>Pengukuran pH khusus untuk produksi</td></tr>
        <tr><td>__________________________________________________________</td></tr>
        <tr><td>__________________________________________________________</td></tr>
    </table>

    <br><br>

    <table width="100%" class="sign small">
        <tr><td>Disetujui oleh</td></tr>
        <tr><td><br><br></td></tr>
        <tr><td>(___________________)</td></tr>
        <tr><td>QC SPV</td></tr>
    </table>

    <div style="text-align:right; font-size:8px;">QT 10 / 01</div>

    @if (!$loop->last)
        <div style="page-break-after: always;"></div>
    @endif
@endforeach

</body>
</html>
