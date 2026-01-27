<!DOCTYPE html>
<html>
<head>
    <title>Laporan Verifikasi Timer Chamber</title>
    <style>
        /* CSS Dasar untuk TCPDF */
        body {
            font-family: helvetica;
            font-size: 8pt; /* Ukuran font standar */
        }

        /* Reset Table */
        table {
            border-collapse: collapse;
            width: 100%;
            border-spacing: 0;
        }

        /* Style Border */
        th, td {
            border: 1px solid #000000;
        }

        /* Utility Classes */
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        
        /* Header Style (Tanpa Border) */
        .header-table td { border: none; }
        .title { font-size: 14pt; font-weight: bold; text-align: center; }
        .sub-title { font-size: 9pt; }
        
        /* Background Colors */
        .bg-header { background-color: #E0E0E0; font-weight: bold; }
        .bg-sub-header { background-color: #F0F0F0; font-weight: bold; }

        /* Font Sizes Specific */
        .f-small { font-size: 7pt; } /* Untuk data tabel yang padat */
        .f-norm { font-size: 8pt; }

        /* Status Colors */
        .status-ok { color: #006400; font-weight: bold; }
        .status-rev { color: #8B0000; font-weight: bold; }
    </style>
</head>
<body>

    <table class="header-table" cellpadding="2" cellspacing="0">
        <tr>
            <td width="20%">
                <div class="text-bold" style="font-size: 10pt;">PT Charoen Pokphand Indonesia</div>
                <div class="sub-title">Food Division</div>
            </td>
            <td width="60%" class="title">
                LAPORAN VERIFIKASI TIMER CHAMBER
            </td>
            <td width="20%" style="text-align: right; font-size: 7pt;">
                Dicetak: {{ date('d-m-Y H:i') }}<br>
                Oleh: {{ Auth::user()->username ?? 'System' }}
            </td>
        </tr>
    </table>

    <div style="border-bottom: 2px solid #000; height: 1px; line-height: 1px;"></div>
    <br>

    <table class="header-table" cellpadding="2" cellspacing="0">
        <tr>
            <td width="100%" style="font-size: 9pt;">
                <strong>Tanggal:</strong> {{ $request->date ? \Carbon\Carbon::parse($request->date)->format('d-m-Y') : 'SEMUA' }} &nbsp;&nbsp;|&nbsp;&nbsp; 
                <strong>Shift:</strong> {{ $request->shift ? $request->shift : 'SEMUA' }}
            </td>
        </tr>
    </table>
    <br>

    <table cellpadding="3" cellspacing="0">
        <thead>
            <tr class="bg-header">
                <th width="3%" class="text-center">No</th>
                <th width="7%" class="text-center">Tanggal</th>
                <th width="4%" class="text-center">Shift</th>
                <th width="75%" class="text-center">Detail Verifikasi (Rentang Ukur)</th>
                <th width="6%" class="text-center">Opr</th>
                <th width="5%" class="text-center">Sts</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $item)
            <tr nobr="true">
                <td width="3%" class="text-center f-norm">{{ $index + 1 }}</td>
                <td width="7%" class="text-center f-norm">{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                <td width="4%" class="text-center f-norm">{{ $item->shift }}</td>
                
                <td width="75%" style="padding: 0;">
                    @php
                        $chambers = json_decode($item->verifikasi, true);
                        $rentang_menit = [5, 10, 20, 30, 60];
                    @endphp

                    @if(!empty($chambers))
                        <table width="100%" cellpadding="2" cellspacing="0" border="0">
                            <thead>
                                <tr class="bg-sub-header">
                                    <th width="10%" rowspan="2" class="text-center f-small">Menit</th>
                                    @foreach($chambers as $i => $row)
                                        <th colspan="3" class="text-center f-small">Chamber {{ $i + 1 }}</th>
                                    @endforeach
                                </tr>
                                <tr class="bg-sub-header">
                                    @foreach($chambers as $i => $row)
                                        <th width="10%" class="text-center f-small">PLC</th>
                                        <th width="10%" class="text-center f-small">StopW</th>
                                        <th width="10%" class="text-center f-small">Selisih</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rentang_menit as $rentang)
                                <tr>
                                    <td class="text-center f-small"><b>{{ $rentang }}</b></td>
                                    @foreach($chambers as $i => $row)
                                        <td class="text-center f-small">
                                            <nobr>{{ isset($row['plc_menit_'.$rentang]) ? sprintf('%02d:%02d', $row['plc_menit_'.$rentang], $row['plc_detik_'.$rentang]) : '-' }}</nobr>
                                        </td>
                                        <td class="text-center f-small">
                                            <nobr>{{ isset($row['stopwatch_menit_'.$rentang]) ? sprintf('%02d:%02d', $row['stopwatch_menit_'.$rentang], $row['stopwatch_detik_'.$rentang]) : '-' }}</nobr>
                                        </td>
                                        <td class="text-center f-small">
                                            {{ $row['faktor_koreksi_'.$rentang] ?? '' }}
                                        </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center" style="padding: 10px;">- Data Verifikasi Tidak Tersedia -</div>
                    @endif
                </td>

                <td width="6%" class="text-center f-small">{{ substr($item->nama_operator, 0, 8) }}</td>
                <td width="5%" class="text-center f-small">
                    @if($item->status_spv == 1) <span class="status-ok">OK</span>
                    @elseif($item->status_spv == 2) <span class="status-rev">REV</span>
                    @else - @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="padding: 10px;">Data tidak ditemukan untuk filter ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <br><br>
    <table class="header-table" cellpadding="2" cellspacing="0" style="page-break-inside: avoid;">
        <tr>
            <td width="80%"></td> <td width="20%" class="text-center f-norm">
                Disetujui Oleh,<br>
                QC Supervisor
                <br><br><br><br><br>
                <div style="border-bottom: 1px solid #000; width: 80%; margin: 0 auto;"></div>
            </td>
        </tr>
    </table>

</body>
</html>