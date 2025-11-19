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
                <h3><i class="bi bi-list-check"></i> Pemeriksaan Suhu dan RH</h3>
                <a href="{{ route('suhu.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Live Search --}}
            <form id="filterForm" method="GET" action="{{ route('suhu.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

                <div class="input-group" style="max-width: 220px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-calendar-date text-muted"></i>
                    </span>
                    <input type="date" name="date" id="filter_date" class="form-control border-start-0"
                    value="{{ request('date') }}" placeholder="Tanggal Produksi">
                </div>

               <!--  <div class="input-group flex-grow-1" style="max-width: 350px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search" id="search" class="form-control border-start-0"
                    value="{{ request('search') }}" placeholder="Cari Nama Produk / Kode Produksi...">
                </div> -->
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
                        <th>NO.</th>
                        <th>Date | Shift</th>
                        <th>Pukul</th>
                        <th>Pemeriksaan</th>
                        <th>Keterangan</th>
                        <th>QC</th>
                        <th>Produksi</th>
                        <th>SPV</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $no = ($data->currentPage() - 1) * $data->perPage() + 1; 
                    @endphp
                    @forelse ($data as $dep)
                    <tr>
                        <td class="text-center align-middle">{{ $no++ }}</td>
                        <td class="text-center align-middle">{{ \Carbon\Carbon::parse($dep->date)->format('d-m-Y') }} | Shift: {{ $dep->shift }}</td>
                        <td class="text-center align-middle">{{ \Carbon\Carbon::parse($dep->pukul)->format('H:i') }}</td>
                        <td class="text-center align-middle">
                            @php
                            // Decode JSON hasil suhu dari database
                            $hasilSuhu = is_string($dep->hasil_suhu)
                            ? json_decode($dep->hasil_suhu, true)
                            : ($dep->hasil_suhu ?? []);

                            if (!$hasilSuhu) $hasilSuhu = [];

                            // Ambil daftar area & standar dari tabel area_suhu
                            $areaList = $area_suhus ?? [];
                            @endphp

                            @if(!empty($hasilSuhu))
                            <a href="#" data-bs-toggle="modal" data-bs-target="#suhuModal{{ $dep->uuid }}"
                             style="font-weight: bold; text-decoration: underline;">
                             Lihat Suhu Area
                         </a>

                         <div class="modal fade" id="suhuModal{{ $dep->uuid }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title">Detail Suhu Area</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm mb-0 text-center align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 50%" class="text-left">Area</th>
                                                        @foreach($areaList as $area)
                                                        <th>{{ $area->area }}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- Baris Standar --}}
                                                    <tr>
                                                        <td class="fw-bold text-left"><b>Standar (°C)</b></td>
                                                        @foreach($areaList as $area)
                                                        <td class="text-center" style="font-weight: 700;">{{ $area->standar ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>


                                                    {{-- Baris Aktual --}}
                                                    <tr>
                                                        <td class="fw-bold text-left"><b>Aktual (°C)</b></td>
                                                        @foreach($areaList as $area)
                                                        @php
                                                        // Cocokkan nilai aktual berdasarkan area
                                                        $matched = collect($hasilSuhu)->firstWhere('area', $area->area);
                                                        $nilai = floatval($matched['nilai'] ?? 0);
                                                        $standarStr = trim($area->standar ?? '');
                                                        $outOfRange = false;

                                                        if ($standarStr !== '') {
                                                            if (preg_match('/^<\s*(\d+(\.\d+)?)/', $standarStr, $m)) {
                                                                $max = floatval($m[1]);
                                                                $outOfRange = $nilai >= $max;
                                                            } elseif (preg_match('/^>\s*(\d+(\.\d+)?)/', $standarStr, $m)) {
                                                                $min = floatval($m[1]);
                                                                $outOfRange = $nilai <= $min;
                                                            } elseif (preg_match('/^(\d+(\.\d+)?)\s*-\s*(\d+(\.\d+)?)/', $standarStr, $m)) {
                                                                $min = floatval($m[1]);
                                                                $max = floatval($m[3]);
                                                                $outOfRange = $nilai < $min || $nilai > $max;
                                                            }
                                                        }
                                                        @endphp

                                                        <td class="fw-bold text-center {{ $outOfRange ? 'text-danger' : 'text-success' }}">
                                                            {{ $matched['nilai'] ?? '-' }}
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <span>-</span>
                        @endif
                    </td>

                    <td class="text-center align-middle">{{ !empty($dep->keterangan) ? $dep->keterangan : '-' }}</td>
                    <td class="text-center align-middle">{{ $dep->username }}</td>
                    <td class="text-center align-middle">{{ $dep->nama_produksi }}</td>
                    <td class="text-center align-middle">
                        @if ($dep->status_spv == 0)
                        <span class="fw-bold text-secondary">Created</span>
                        @elseif ($dep->status_spv == 1)
                        <span class="fw-bold text-success">Verified</span>
                        @elseif ($dep->status_spv == 2)
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#revisionModal{{ $dep->uuid }}" 
                         class="text-danger fw-bold text-decoration-none" style="cursor: pointer;">Revision</a>
                         @endif
                     </td>

                     <td class="text-center">
                         <a href="{{ route('suhu.update.form', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                            <i class="bi bi-pencil"></i> Update
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">Belum ada data suhu.</td>
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
