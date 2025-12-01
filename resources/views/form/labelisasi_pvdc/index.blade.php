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
                <h3><i class="bi bi-list-check"></i> Kontrol Labelisasi PVDC</h3>
                <a href="{{ route('labelisasi_pvdc.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Live Search --}}
            <form id="filterForm" method="GET" action="{{ route('labelisasi_pvdc.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

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
             <table class="table table-striped table-bordered align-middle table-hover">
                <thead class="table-primary text-center">
                    <tr>
                        <th>NO.</th>
                        <th>Date | Shift</th>
                        <th>Nama Produk</th>
                        <th>Labelisasi</th>
                        <th>QC</th>
                        <th>Operator</th>
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
                        <td class="text-center">
                            @php
                            $labelisasi_pvdc = json_decode($dep->labelisasi, true);
                            @endphp

                            @if(!empty($labelisasi_pvdc))
                            <a href="#" data-bs-toggle="modal" data-bs-target="#labelisasi_pvdcModal{{ $dep->uuid }}" 
                             style="font-weight: bold; text-decoration: underline;">
                             Result
                         </a>

                         <!-- Modal Detail Labelisasi PVDC -->
                         <div class="modal fade" id="labelisasi_pvdcModal{{ $dep->uuid }}" tabindex="-1"
                            aria-labelledby="labelisasi_pvdcModalLabel{{ $dep->uuid }}" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 60%;">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning text-white">
                                        <h5 class="modal-title" id="labelisasi_pvdcModalLabel{{ $dep->uuid }}">
                                            Detail Kontrol Labelisasi PVDC
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-sm text-center align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Mesin</th>
                                                        <th>Kode Produksi</th>
                                                        <th>Bukti Gambar</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($labelisasi_pvdc as $i => $row)
                                                    <tr>
                                                        <td>{{ $i + 1 }}</td>
                                                        <td>{{ $row['mesin'] ?? '-' }}</td>
                                                        <td>{{ $row['kode_batch'] ?? '-' }}</td>
                                                        <td>
                                                            @if(!empty($row['file']))
                                                            <a href="{{ asset(stripslashes($row['file'])) }}" target="_blank">
                                                                <img src="{{ asset(stripslashes($row['file'])) }}" width="80" class="img-thumbnail">
                                                            </a>
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        <td>{{ $row['keterangan'] ?? '-' }}</td>
                                                    </tr>
                                                    @endforeach
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
                    <td class="text-center align-middle">{{ $dep->username }}</td>
                    <td class="text-center align-middle">{{ $dep->nama_operator }}</td>
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
                        <a href="{{ route('labelisasi_pvdc.update.form', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                            <i class="bi bi-pencil"></i> Update
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="19" class="text-center">Belum ada data pemasakan nasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

    <form method="GET" action="{{ route('labelisasi_pvdc.exportPdf') }}">
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
