<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: helvetica; font-size: 9px; }
        .title { font-size: 14px; font-weight: bold; text-align: center; margin-bottom: 10px; }
        table { border-collapse: collapse; width: 100%; }
        
        .tbl-header td { padding: 3px; font-size: 10px; }
        
        /* Table Utama dengan Border */
        .tbl-main, .tbl-main th, .tbl-main td {
            border: 0.5px solid #000;
        }
        .tbl-main th {
            font-weight: bold;
            text-align: center;
            background-color: #f0f0f0;
            padding: 4px;
        }
        .tbl-main td {
            padding: 3px;
            vertical-align: top;
        }

        .center { text-align: center; }
        .bold { font-weight: bold; }
        .mb-2 { margin-bottom: 10px; }
        
        /* Grid Layout untuk Mesin */
        .grid-container {
            width: 100%;
        }
        .grid-item {
            width: 33%; /* 3 Kolom per baris */
            float: left;
            padding: 2px;
        }
        .clearfix { clear: both; }
    </style>
</head>
<body>

@foreach ($datalist as $data)
    {{-- Header Perusahaan --}}
    <table width="100%">
        <tr>
            <td>
                <b>PT Charoen Pokphand Indonesia</b><br>
                Food Division
            </td>
        </tr>
    </table>

    <div class="title">DATA NO. LOT PVDC</div>

    {{-- Info Utama --}}
    <table width="100%" class="tbl-header mb-2">
        <tr>
            <td width="20%">Hari / Tgl</td>
            <td width="30%">: {{ \Carbon\Carbon::parse($data->date)->translatedFormat('l, d-m-Y') }}</td>
            <td width="20%">Shift</td>
            <td width="30%">: {{ $data->shift }}</td>
        </tr>
        <tr>
            <td>Nama Produk</td>
            <td>: {{ $data->nama_produk }}</td>
            <td>Nama Supplier</td>
            <td>: {{ $data->nama_supplier }}</td>
        </tr>
        <tr>
            <td>Tgl Kedatangan</td>
            <td>: {{ \Carbon\Carbon::parse($data->tgl_kedatangan)->format('d-m-Y') }}</td>
            <td>Tgl Expired</td>
            <td>: {{ \Carbon\Carbon::parse($data->tgl_expired)->format('d-m-Y') }}</td>
        </tr>
    </table>

    {{-- Data PVDC (Looping Mesin) --}}
    @php
        $pvdcItems = json_decode($data->data_pvdc ?? '[]', true);
        // Bagi menjadi chunks agar rapi per baris (misal 3 mesin per baris tabel)
        $chunks = array_chunk($pvdcItems, 3);
    @endphp

    <table class="tbl-main mb-2">
        @foreach($chunks as $row)
            {{-- Header Nama Mesin --}}
            <tr>
                @foreach($row as $item)
                    <th width="{{ 100 / count($row) }}%">Mesin: {{ $item['mesin'] ?? '-' }}</th>
                @endforeach
                {{-- Isi kolom kosong jika baris terakhir kurang dari 3 --}}
                @for($i = count($row); $i < 3; $i++)
                    <th width="33%"></th>
                @endfor
            </tr>

            {{-- Body Detail Batch --}}
            <tr>
                @foreach($row as $item)
                    <td style="padding: 0;">
                        {{-- Tabel Nested untuk Detail --}}
                        <table width="100%" style="border: none;">
                            <tr style="background-color: #fafafa;">
                                <td class="center bold" style="border-bottom: 0.5px solid #ccc; width:15%">No</td>
                                <td class="center bold" style="border-bottom: 0.5px solid #ccc; width:25%">Batch</td>
                                <td class="center bold" style="border-bottom: 0.5px solid #ccc; width:35%">No. Lot</td>
                                <td class="center bold" style="border-bottom: 0.5px solid #ccc; width:25%">Waktu</td>
                            </tr>
                            @if(!empty($item['detail']))
                                @foreach($item['detail'] as $idx => $det)
                                <tr>
                                    <td class="center" style="border-bottom: 0.1px solid #eee;">{{ $idx + 1 }}</td>
                                    <td class="center" style="border-bottom: 0.1px solid #eee;">{{ $det['batch'] ?? '' }}</td>
                                    <td class="center" style="border-bottom: 0.1px solid #eee;">{{ $det['no_lot'] ?? '' }}</td>
                                    <td class="center" style="border-bottom: 0.1px solid #eee;">{{ $det['waktu'] ?? '' }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr><td colspan="4" class="center">-</td></tr>
                            @endif
                        </table>
                    </td>
                @endforeach
                @for($i = count($row); $i < 3; $i++)
                    <td></td>
                @endfor
            </tr>
        @endforeach
    </table>

    {{-- Catatan --}}
    <div style="font-size: 10px; margin-bottom: 20px;">
        <b>Catatan:</b> {{ $data->catatan ?? '-' }}
    </div>

    {{-- Tanda Tangan --}}
    <table width="100%" class="tbl-main center">
        <tr>
            <td width="50%"><b>Dibuat Oleh (QC)</b></td>
            <td width="50%"><b>Disetujui Oleh (SPV)</b></td>
        </tr>
        <tr>
            <td height="50px">
                <br>
                {{ $data->username }}
                <br>
                <small>{{ $data->created_at->format('d-m-Y H:i') }}</small>
            </td>
            <td>
                @if($data->status_spv == 1)
                    <br>
                    {{ \App\Models\User::where('username', $data->nama_spv)->first()->name ?? $data->nama_spv }}
                    <br>
                    <small>{{ $data->tgl_update_spv ? \Carbon\Carbon::parse($data->tgl_update_spv)->format('d-m-Y H:i') : '' }}</small>
                @else
                    <br><span style="color:red;">Belum Diverifikasi</span><br>
                @endif
            </td>
        </tr>
        <tr>
            <td>QC Inspector</td>
            <td>Supervisor QC</td>
        </tr>
    </table>

    @if (!$loop->last)
        <div style="page-break-after: always;"></div>
    @endif
@endforeach

</body>
</html>