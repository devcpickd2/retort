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
                <h3><i class="bi bi-list-check"></i> Pemeriksaan Washing - Drying</h3>
                <a href="{{ route('washing.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Live Search --}}
            <form id="filterForm" method="GET" action="{{ route('washing.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

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
                        <th>NO.</th>
                        <th>Date | Shift</th>
                        <th>Nama Produk</th>
                        <th>Kode Produksi</th>
                        <th>Waktu</th>
                        <th>Pemeriksaan</th>
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
                        <td class="text-center align-middle">{{ $dep->nama_produk }}</td>
                        <td class="text-center align-middle">{{ $dep->kode_produksi }}</td>
                        <td class="text-center align-middle">{{ \Carbon\Carbon::parse($dep->pukul)->format('H:i') }}</td>
                        <td class="text-center align-middle">

                         <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#detailModal{{ $dep->uuid }}" 
                            class="text-primary fw-bold text-decoration-none" style="cursor: pointer;">Pemeriksaan</a>

                            <div class="modal fade" id="detailModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="detailModalLabel{{ $dep->uuid }}">Detail Pemeriksaan Washing - Drying</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            {{-- IDENTIFIKASI --}}
                                            <h6 class="text-start text-secondary fw-bold mt-2">Identifikasi</h6>
                                            <table class="table table-bordered table-sm mb-3">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-start">Nama Produk</th>
                                                        <td class="text-start">{{ $dep->nama_produk }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Kode Produksi</th>
                                                        <td class="text-start">{{ $dep->kode_produksi }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            {{-- PENGECEKAN --}}
                                            <h6 class="text-start text-primary fw-bold mt-2"><i class="bi bi-check2-square me-1"></i> Pengecekan</h6>
                                            <table class="table table-bordered table-sm mb-3">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-start" style="width: 50%;">Panjang Produk Akhir (Cm)</th>
                                                        <td class="text-start">{{ $dep->panjang_produk ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Diameter Produk Akhir (Mm)</th>
                                                        <td class="text-start">{{ $dep->diameter_produk ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Airtrap</th>
                                                        <td class="text-start">{{ $dep->airtrap ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Lengket</th>
                                                        <td class="text-start">{{ $dep->lengket ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Sisa Adonan</th>
                                                        <td class="text-start">{{ $dep->sisa_adonan ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Cek Kebocoran / Vacuum</th>
                                                        <td class="text-start">{{ $dep->kebocoran ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Kekuatan Seal</th>
                                                        <td class="text-start">{{ $dep->kekuatan_seal ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Print Kode Produksi</th>
                                                        <td class="text-start">{{ $dep->print_kode ?? '-' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            {{-- PC KLEER --}}
                                            <h6 class="text-start text-primary fw-bold mt-2"><i class="bi bi-droplet-half me-1"></i> PC Kleer</h6>
                                            <table class="table table-bordered table-sm mb-3">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-start" style="width: 50%;">Konsentrasi PC Kleer 1 (%)</th>
                                                        <td class="text-start">{{ $dep->konsentrasi_pckleer ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Suhu PC Kleer 1 (°C)</th>
                                                        <td class="text-start">{{ $dep->suhu_pckleer_1 ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Suhu PC Kleer 2 (°C)</th>
                                                        <td class="text-start">{{ $dep->suhu_pckleer_2 ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">pH PC Kleer</th>
                                                        <td class="text-start">{{ $dep->ph_pckleer ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Kondisi Air PC Kleer</th>
                                                        <td class="text-start">{{ $dep->kondisi_air_pckleer ?? '-' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            {{-- POTTASIUM SORBATE --}}
                                            <h6 class="text-start text-primary fw-bold mt-2"><i class="bi bi-flask me-1"></i> Pottasium Sorbate</h6>
                                            <table class="table table-bordered table-sm mb-3">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-start" style="width: 50%;">Konsentrasi Pottasium Sorbate (%)</th>
                                                        <td class="text-start">{{ $dep->konsentrasi_pottasium ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Suhu Pottasium Sorbate (°C)</th>
                                                        <td class="text-start">{{ $dep->suhu_pottasium ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">pH Pottasium Sorbate</th>
                                                        <td class="text-start">{{ $dep->ph_pottasium ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Kondisi Air Pottasium Sorbate</th>
                                                        <td class="text-start">{{ $dep->kondisi_pottasium ?? '-' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            {{-- SUHU & SPEED CONVEYOR --}}
                                            <h6 class="text-start text-primary fw-bold mt-2"><i class="bi bi-speedometer2 me-1"></i> Suhu & Speed Conveyor</h6>
                                            <table class="table table-bordered table-sm mb-3">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-start" style="width: 50%;">Suhu Heater (°C)</th>
                                                        <td class="text-start">{{ $dep->suhu_heater ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Speed Conv. Drying 1</th>
                                                        <td class="text-start">{{ $dep->speed_1 ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Speed Conv. Drying 2</th>
                                                        <td class="text-start">{{ $dep->speed_2 ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Speed Conv. Drying 3</th>
                                                        <td class="text-start">{{ $dep->speed_3 ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-start">Speed Conv. Drying 4</th>
                                                        <td class="text-start">{{ $dep->speed_4 ?? '-' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            {{-- CATATAN --}}
                                            @if($dep->catatan)
                                            <h6 class="text-start text-primary fw-bold mt-2"><i class="bi bi-journal-text me-1"></i> Catatan</h6>
                                            <p class="text-start">{{ $dep->catatan }}</p>
                                            @endif

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

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
                             <a href="{{ route('washing.update.form', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil"></i> Update
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">Belum ada data washing - drying.</td>
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
