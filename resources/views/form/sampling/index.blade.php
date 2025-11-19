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
                <h3><i class="bi bi-list-check"></i> Data Sampling Produk</h3>
                <a href="{{ route('sampling.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Live Search --}}
            <form id="filterForm" method="GET" action="{{ route('sampling.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

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
                            <th>Tanggal | Shift</th>
                            <th>Jenis Sampling</th>
                            <th>Nama Produk</th>
                            <th>Kode Produksi</th>
                            <th>Jumlah</th>
                            <th>Jamur</th>
                            <th>Lendir</th>
                            <th>Klip Tajam</th>
                            <th>Pin Hole</th>
                            <th>Air Trap PVDC</th>
                            <th>Air Trap Produk</th>
                            <th>Keriput</th>
                            <th>Bengkok</th>
                            <th>Non Kode</th>
                            <th>Over Lap</th>
                            <th>Kecil</th>
                            <th>Terjepit</th>
                            <th>Double Klip</th>
                            <th>Seal Halus</th>
                            <th>Basah</th>
                            <th>Dll</th>
                            <th>Catatan</th>
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
                            <td class="text-center align-middle">{{ $dep->jenis_sampel }}</td>
                            <td class="text-center align-middle">{{ $dep->nama_produk }}</td>
                            <td class="text-center align-middle">{{ $dep->kode_produksi }}</td>
                            <td class="text-center align-middle">{{ $dep->jumlah }} {{ $dep->jenis_kemasan }}</td>
                            <td class="text-center align-middle">{{ $dep->jamur }}</td>
                            <td class="text-center align-middle">{{ $dep->lendir }}</td>
                            <td class="text-center align-middle">{{ $dep->klip_tajam }}</td>
                            <td class="text-center align-middle">{{ $dep->pin_hole }}</td>
                            <td class="text-center align-middle">{{ $dep->air_trap_pvdc }}</td>
                            <td class="text-center align-middle">{{ $dep->air_trap_produk }}</td>
                            <td class="text-center align-middle">{{ $dep->keriput }}</td>
                            <td class="text-center align-middle">{{ $dep->bengkok }}</td>
                            <td class="text-center align-middle">{{ $dep->non_kode }}</td>
                            <td class="text-center align-middle">{{ $dep->over_lap }}</td>
                            <td class="text-center align-middle">{{ $dep->kecil }}</td>
                            <td class="text-center align-middle">{{ $dep->terjepit }}</td>
                            <td class="text-center align-middle">{{ $dep->double_klip }}</td>
                            <td class="text-center align-middle">{{ $dep->seal_halus }}</td>
                            <td class="text-center align-middle">{{ $dep->basah }}</td>
                            <td class="text-center align-middle">{{ $dep->dll }}</td>
                            <td class="text-center align-middle">{{ $dep->catatan }}</td>
                            <!-- <td class="text-center align-middle">
                                @if($dep->catatan)
                                <a href="#" 
                                class="text-primary text-decoration-underline" 
                                data-bs-toggle="modal" 
                                data-bs-target="#catatanModal{{ $dep->id }}">
                                Lihat Catatan
                            </a>
                            <div class="modal fade" id="catatanModal{{ $dep->id }}" tabindex="-1" aria-labelledby="catatanLabel{{ $dep->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="catatanLabel{{ $dep->id }}">Catatan</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            {{ $dep->catatan }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td> -->
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
                            <a href="{{ route('sampling.update.form', $dep->uuid) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Update
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="26" class="text-center">Belum ada data sampling.</td>
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
