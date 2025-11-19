@extends('layouts.app')

@section('content')
<div class="container-fluid py-0">
    {{-- Alert sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="bi bi-list-check"></i> Pengecekan Pre Packing</h3>
                <a href="{{ route('prepacking.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Live Search --}}
            <form id="filterForm" method="GET" action="{{ route('prepacking.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

                <div class="input-group" style="max-width: 220px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-calendar-date text-muted"></i>
                    </span>
                    <input type="date" name="date" id="filter_date" class="form-control border-start-0"
                    value="{{ request('date') }}" placeholder="Tanggal Produksi">
                </div>

                <div class="input-group flex-grow-1" style="max-width: 350px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search" id="search" class="form-control border-start-0"
                    value="{{ request('search') }}" placeholder="Cari Nama Produk / Kode Produksi...">
                </div>
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const search = document.getElementById('search');
                    const date = document.getElementById('filter_date');
                    const form = document.getElementById('filterForm');
                    let timer;

                    search.addEventListener('input', () => {
                        clearTimeout(timer);
                        timer = setTimeout(() => form.submit(), 500);
                    });

                    date.addEventListener('change', () => form.submit());
                });
            </script>

            {{-- Tambahkan table-responsive agar tabel tidak keluar border --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th rowspan="2">NO.</th>
                            <th rowspan="2">Date</th>
                            <th rowspan="2">Nama Produk</th>
                            <th rowspan="2">Kode Produksi</th>
                            <th rowspan="2">No. Conveyor</th>
                            <th rowspan="2">Suhu Produk (°C)</th>
                            <th colspan="2">Air (%)</th>
                            <th colspan="2">Minyak (%)</th>
                            <th colspan="2">Berat Produk per</th>
                            <th rowspan="2">Catatan</th>
                            <th rowspan="2">QC</th>
                            <th rowspan="2">SPV</th>
                            <th rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th>Basah</th>
                            <th>Kering</th>
                            <th>Basah</th>
                            <th>Kering</th>
                            <th>Pcs</th>
                            <th>Toples (berat kotor)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                        $no = ($data->currentPage() - 1) * $data->perPage() + 1; 
                        @endphp
                        @forelse ($data as $dep)
                        @php
                        // Suhu Produk
                        $suhuArray = json_decode($dep->suhu_produk, true) ?? [];
                        $suhuText = implode(' | ', $suhuArray);

                        // Kondisi Produk
                        $kondisi = json_decode($dep->kondisi_produk, true) ?? [];
                        $airBasah   = ($kondisi['basah_air_ujung'] ?? 0) + ($kondisi['basah_air_seal'] ?? 0);
                        $airKering  = ($kondisi['kering_air_ujung'] ?? 0) + ($kondisi['kering_air_seal'] ?? 0);
                        $minyakBasah = ($kondisi['basah_minyak_ujung'] ?? 0) + ($kondisi['basah_minyak_seal'] ?? 0);
                        $minyakKering = ($kondisi['kering_minyak_ujung'] ?? 0) + ($kondisi['kering_minyak_seal'] ?? 0);

                        // Berat Produk
                        $berat = json_decode($dep->berat_produk, true) ?? [];
                        $pcsText = implode(' | ', [
                        $berat['pcs_1'] ?? 0,
                        $berat['pcs_2'] ?? 0,
                        $berat['pcs_3'] ?? 0,
                        ]);
                        $toplesText = implode(' | ', [
                        $berat['toples_1'] ?? 0,
                        $berat['toples_2'] ?? 0,
                        $berat['toples_3'] ?? 0,
                        ]);
                        @endphp
                        <tr>
                            <td class="text-center align-middle">{{ $no++ }}</td>
                            <td class="text-center align-middle">{{ \Carbon\Carbon::parse($dep->date)->format('d-m-Y') }}</td>
                            <td class="text-center align-middle">{{ $dep->nama_produk }}</td>
                            <td class="text-center align-middle">{{ $dep->kode_produksi }}</td>
                            <td class="text-center align-middle">{{ $dep->conveyor }}</td>
                            <td class="text-center align-middle">{{ $suhuText }}</td>
                            <td class="text-center align-middle">{{ $airBasah }}</td>
                            <td class="text-center align-middle">{{ $airKering }}</td>
                            <td class="text-center align-middle">{{ $minyakBasah }}</td>
                            <td class="text-center align-middle">{{ $minyakKering }}</td>
                            <td class="text-center align-middle">{{ $pcsText }}</td>
                            <td class="text-center align-middle">{{ $toplesText }}</td>
                            <td class="text-center align-middle">{{ $dep->catatan }}</td>
                            <td class="text-center align-middle">{{ $dep->username }}</td>
                            <td class="text-center align-middle">
                                @if ($dep->status_spv == 0)
                                <span class="fw-bold text-secondary">Created</span>
                                @elseif ($dep->status_spv == 1)
                                <span class="fw-bold text-success">Verified</span>
                                @elseif ($dep->status_spv == 2)
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#revisionModal{{ $dep->uuid }}" 
                                    class="text-danger fw-bold text-decoration-none" style="cursor: pointer;">Revision</a>
                                    @include('prepacking.partials.revision_modal', ['dep' => $dep])
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('prepacking.update.form', $dep->uuid) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Update
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="17" class="text-center">Belum ada data prepacking.</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>
                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Auto-hide alert setelah 3 detik --}}
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if(alert){
                alert.classList.remove('show');
                alert.classList.add('fade');
            }
        }, 3000);
    </script>

    {{-- CSS tambahan agar tabel lebih rapi --}}
    <style>
        .table td, .table th {
            font-size: 0.85rem;
            white-space: nowrap; 
        }
        .text-danger {
            font-weight: bold;
        }
        .text-muted.fst-italic {
            color: #6c757d !important;
            font-style: italic !important;
        }
        .container {
            padding-left: 2px !important;
            padding-right: 2px !important;
        }
    </style>
    @endsection
