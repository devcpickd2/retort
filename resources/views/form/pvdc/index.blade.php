@extends('layouts.app')

@section('content')
<div class="container-fluid py-0">
    {{-- Alert sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ trim(session('success')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="bi bi-list-check"></i> Data No. Lot PVDC</h3>
                <a href="{{ route('pvdc.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div> 

            {{-- Filter dan Live Search --}}
            <form id="filterForm" method="GET" action="{{ route('pvdc.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

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
                    value="{{ request('search') }}" placeholder="Cari sesuatu...">
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
                            <th>Nama Supplier</th>
                            <th>Tanggal kedatangan PVDC</th>
                            <th>Tanggal Expired</th>
                            <th>Data PVDC</th>
                            <th>QC</th>
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
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ \Carbon\Carbon::parse($dep->date)->format('d-m-Y') }} | Shift: {{ $dep->shift }}</td>   
                            <td>{{ $dep->nama_produk }}</td>
                            <td>{{ $dep->nama_supplier }}</td>
                            <td>{{ \Carbon\Carbon::parse($dep->tgl_kedatangan)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($dep->tgl_exoired)->format('d-m-Y') }}</td>
                            <td class="text-center">
                                @php
                                $data_pvdc = json_decode($dep->data_pvdc, true);
                                @endphp

                                @if(!empty($data_pvdc))
                                <a href="#" data-bs-toggle="modal" data-bs-target="#pvdcModal{{ $dep->uuid }}" style="font-weight: bold; text-decoration: underline;">
                                    Result
                                </a>

                                <!-- Modal Detail PVDC -->
                                <div class="modal fade" id="pvdcModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="pvdcModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                    <div class="modal-dialog" style="max-width: 70%;">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning text-white">
                                                <h5 class="modal-title text-start" id="pvdcModalLabel{{ $dep->uuid }}">Detail Pemeriksaan PVDC</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                @foreach($data_pvdc as $mIndex => $mesin)
                                                <div class="mb-4">
                                                    <h6 class="fw-bold text-start mb-2">
                                                        🧭 Mesin: {{ $mesin['mesin'] ?? 'Tidak diketahui' }}
                                                    </h6>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped table-sm text-center align-middle">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Batch</th>
                                                                    <th>No. Lot</th>
                                                                    <th>Waktu</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(!empty($mesin['detail']))
                                                                @foreach($mesin['detail'] as $index => $detail)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ $detail['batch'] ?? '-' }}</td>
                                                                    <td>{{ $detail['no_lot'] ?? '-' }}</td>
                                                                    <td>{{ $detail['waktu'] ?? '-' }}</td>
                                                                </tr>
                                                                @endforeach
                                                                @else
                                                                <tr>
                                                                    <td colspan="4">Tidak ada data batch</td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @endforeach
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
                            <td class="text-center align-middle">{{ $dep->username }}</td>
                            <td class="text-center align-middle">
                                @if ($dep->status_spv == 0)
                                <span class="fw-bold text-secondary">Created</span>
                                @elseif ($dep->status_spv == 1)
                                <span class="fw-bold text-success">Verified</span>
                                @elseif ($dep->status_spv == 2)
                                <!-- Link buka modal -->
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#revisionModal{{ $dep->uuid }}" 
                                 class="text-danger fw-bold text-decoration-none" style="cursor: pointer;">Revision</a>

                                 <!-- Modal -->
                                 <div class="modal fade" id="revisionModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="revisionModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="revisionModalLabel{{ $dep->uuid }}">Detail Revisi</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled mb-0">
                                                    <li><strong>Status:</strong> Revision</li>
                                                    <li><strong>Catatan:</strong> {{ $dep->catatan_spv ?? '-' }}</li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('pvdc.update.form', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i> Update
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="19" class="text-center">Belum ada data pvdc.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

            <form method="GET" action="{{ route('pvdc.exportPdf') }}">
                <div class="card shadow-sm mb-3">
                    <div class="card-body d-flex align-items-end gap-2 flex-wrap">

                        <div class="col-auto">
                            <label class="fw-semibold">Tanggal</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" name="date" value="{{ request('date') }}"
                            class="form-control form-control-sm" required>
                        </div>

                        <div class="col-auto">
                            <label class="fw-semibold">Shift</label>
                        </div>
                        <div class="col-auto">
                            <select name="shift" class="form-control form-control-sm" required>
                                <option value="" disabled selected>Pilih shift</option>
                                <option value="1" @selected(request('shift')=='1')>Shift 1</option>
                                <option value="2" @selected(request('shift')=='2')>Shift 2</option>
                                <option value="3" @selected(request('shift')=='3')>Shift 3</option>
                            </select>
                        </div>

                        <div class="col-auto">
                            <label class="fw-semibold">Nama Produk</label>
                        </div>
                        <div class="col-auto">
                            <select name="nama_produk" class="form-control form-control-sm selectpicker" data-live-search="true" required>
                                <option value="">Pilih Produk</option>
                                @foreach($produks as $p)
                                <option value="{{ $p->nama_produk }}" 
                                    @selected(request('nama_produk') == $p->nama_produk)>
                                    {{ $p->nama_produk }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-file-earmark-pdf"></i> Export PDF
                            </button>
                        </div>

                    </div>
                </div>
            </form>

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
