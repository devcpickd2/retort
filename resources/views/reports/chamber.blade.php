<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Verifikasi Timer Chamber</title>
    <style>
        body { font-family: helvetica, sans-serif; font-size: 8px; line-height: 1.1; }
        
        /* Header */
        .company-header { width: 100%; border-bottom: 2px solid #000; margin-bottom: 5px; }
        .company-name { font-size: 10px; font-weight: bold; }
        .report-title { font-size: 12px; font-weight: bold; text-align: center; text-transform: uppercase; }

        /* Tabel Utama */
        table.tbl-data { width: 100%; border-collapse: collapse; }
        table.tbl-data th {
            background-color: #e6e6e6; border: 1px solid #000;
            font-weight: bold; text-align: center; vertical-align: middle; padding: 3px;
        }
        table.tbl-data td {
            border: 1px solid #000; vertical-align: top; padding: 3px;
        }

        /* Tabel Nested (Hasil Verifikasi) */
        .tbl-nested { width: 100%; font-size: 7px; border: none; }
        .tbl-nested td, .tbl-nested th { border: 1px solid #ccc; padding: 1px; text-align: center; }
        .tbl-nested th { background-color: #f2f2f2; }

        .text-center { text-align: center; }
        .bg-ok { color: #006400; font-weight: bold; }
        .bg-rev { color: #8B0000; font-weight: bold; }
    </style>
</head>
<body>

    <table class="company-header" cellpadding="2">
        <tr>
            <td width="30%" class="company-name">
                PT Charoen Pokphand Indonesia<br>
                <span style="font-weight: normal; font-size: 8px;">Food Division</span>
            </td>
            <td width="40%" class="report-title">LAPORAN VERIFIKASI TIMER CHAMBER</td>
            <td width="30%" style="text-align: right; font-size: 8px;">
                <strong>Dicetak:</strong> {{ date('d-m-Y H:i') }}<br>
                <strong>Oleh:</strong> {{ Auth::user()->username ?? 'System' }}
            </td>
        </tr>
    </table>

    <table width="100%" cellpadding="1" style="margin-bottom: 5px; font-size: 8px;">
        <tr>
            <td width="15%"><strong>Filter Tanggal</strong></td>
            <td width="35%">: {{ $request->date ? \Carbon\Carbon::parse($request->date)->format('d-m-Y') : 'SEMUA' }}</td>
            <td width="15%"><strong>Filter Shift</strong></td>
            <td width="35%">: {{ $request->shift ? $request->shift : 'SEMUA' }}</td>
        </tr>
    </table>

    <table class="tbl-data" nobr="true">
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="8%">Tanggal</th>
                <th width="5%">Shift</th>
                <th width="55%">Detail Verifikasi (Rentang Ukur)</th>
                <th width="10%">Operator</th>
                <th width="10%">Catatan</th>
                <th width="9%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $item)
            <tr nobr="true">
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                <td class="text-center">{{ $item->shift }}</td>
                
                {{-- Detail Verifikasi (Nested Table) --}}
                <td>
                    @php
                        $chambers = json_decode($item->verifikasi, true);
                        $rentang_menit = [5, 10, 20, 30, 60];
                    @endphp
                    
                    @if(!empty($chambers))
                        <table class="tbl-nested" cellspacing="0" cellpadding="1">
                            <thead>
                                <tr>
                                    <th rowspan="2">Menit</th>
                                    @foreach($chambers as $i => $row)
                                        <th colspan="3">Chamber {{ $i + 1 }}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach($chambers as $i => $row)
                                        <th>PLC</th>
                                        <th>StopW</th>
                                        <th>Koreksi</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rentang_menit as $rentang)
                                <tr>
                                    <td>{{ $rentang }}</td>
                                    @foreach($chambers as $i => $row)
                                        <td>{{ $row['plc_menit_'.$rentang] ?? '-' }}:{{ $row['plc_detik_'.$rentang] ?? '00' }}</td>
                                        <td>{{ $row['stopwatch_menit_'.$rentang] ?? '-' }}:{{ $row['stopwatch_detik_'.$rentang] ?? '00' }}</td>
                                        <td>{{ $row['faktor_koreksi_'.$rentang] ?? '-' }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        -
                    @endif
                </td>

                <td class="text-center">{{ $item->nama_operator }}</td>
                <td style="font-size: 7px;">{{ $item->catatan ?? '-' }}</td>
                <td class="text-center">
                    @if($item->status_spv == 1) <span class="bg-ok">VERIFIED</span>
                    @elseif($item->status_spv == 2) <span class="bg-rev">REVISI</span>
                    @else Created @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 10px;">Data tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tanda Tangan --}}
    <table width="100%" style="margin-top: 20px; page-break-inside: avoid;">
        <tr>
            <td width="70%"></td>
            <td width="30%" align="center">
                <div style="font-size: 9px;">Disetujui Oleh,<br>QC Supervisor</div>
                <br><br><br>
                <div style="border-bottom: 1px solid #000; width: 80%;"></div>
            </td>
        </tr>
    </table>

</body>
</html>