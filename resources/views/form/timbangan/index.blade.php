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
                <h3><i class="bi bi-list-check"></i> Data Peneraan Timbangan</h3>
                <a href="{{ route('timbangan.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Live Search --}}
            <form id="filterForm" method="GET" action="{{ route('timbangan.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

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
                            <th>Hasil Peneraan</th>
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
                            <td class="text-center align-middle">{{ $no++ }}</td>
                            <td class="text-center align-middle">{{ \Carbon\Carbon::parse($dep->date)->format('d-m-Y') }} | Shift: {{ $dep->shift }}</td>   
                            <td class="text-center align-middle">

                                @php
                                $peneraan = json_decode($dep->peneraan, true);
                                @endphp
                                @if(!empty($peneraan))
                                <a href="javascript:void(0)"
                                class="toggle-detail fw-bold text-primary"
                                data-target="#detail-{{ $dep->uuid }}">
                                Lihat Detail ▼
                            </a>
                            <div id="detail-{{ $dep->uuid }}" class="mt-2" style="display: none;">
                                <table class="table table-bordered table-sm text-center mb-0"
                                style="font-size: 12px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kode Timbangan</th>
                                        <th>Standar (gr)</th>
                                        <th>Pukul</th>
                                        <th>Hasil Tera</th>
                                        <th>Tindakan Perbaikan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peneraan as $item)
                                    <tr>
                                        <td>{{ $item['kode_timbangan'] ?? '-' }}</td>
                                        <td>{{ $item['standar'] ?? '-' }}</td>
                                        <td>{{ $item['pukul'] ?? '-' }}</td>
                                        <td>{{ $item['hasil_tera'] ?? '-' }}</td>
                                        <td>{{ $item['tindakan_perbaikan'] ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

                    <td class="text-center align-middle">
                        <a href="{{ route('timbangan.update.form', $dep->uuid) }}" class="btn btn-warning btn-sm">
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
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.toggle-detail', function () {

            let btn = $(this);
            let target = btn.data('target');
            let box = $(target);

            // Jalankan toggle + callback
            box.slideToggle(200, function () {
                if (box.is(':visible')) {
                    btn.text('Sembunyikan Detail ▲');
                } else {
                    btn.text('Lihat Detail ▼');
                }
            });

        });
    });
</script>
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
