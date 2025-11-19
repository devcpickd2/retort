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

    {{-- Alert error --}}
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="bi bi-list-check"></i> Kontrol Sanitasi</h3>
                <a href="{{ route('sanitasi.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Live Search --}}
            <form id="filterForm" method="GET" action="{{ route('sanitasi.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

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
                    value="{{ request('search') }}" placeholder="Cari Area...">
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

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>NO.</th>
                            <th>Date | Shift</th>
                            <th>Area</th>
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
                            <td class="text-center align-middle">{{ $dep->area }}</td>
                            <td class="text-center align-middle">
                                @if(!empty($dep->pemeriksaan))
                                <a href="javascript:void(0);" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#pemeriksaanModal{{ $dep->uuid }}">
                                    Lihat Pemeriksaan
                                </a>

                                {{-- Modal --}}
                                <div class="modal fade" id="pemeriksaanModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="pemeriksaanModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="pemeriksaanModalLabel{{ $dep->uuid }}">
                                                    Pemeriksaan Area: {{ $dep->area }} | {{ \Carbon\Carbon::parse($dep->date)->format('d-m-Y') }} Shift: {{ $dep->shift }}
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                @php
                                                $pemeriksaan = json_decode($dep->pemeriksaan, true);
                                                @endphp
                                                @if(!empty($pemeriksaan))
                                                <table class="table table-sm table-bordered">
                                                    <thead class="table-secondary text-center">
                                                        <tr>
                                                            <th>Bagian</th>
                                                            <th>Waktu</th>
                                                            <th>Kondisi</th>
                                                            <th>Keterangan</th>
                                                            <th>Tindakan</th>
                                                            <th>Waktu Koreksi</th>
                                                        </tr>
                                                    </thead>
                                                    @php
                                                    // Mapping kondisi tanpa angka
                                                    $kondisiMapping = [
                                                    '✔' => 'OK (Bersih)',
                                                    '1' => 'Basah',
                                                    '2' => 'Berdebu',
                                                    '3' => 'Kerak',
                                                    '4' => 'Noda',
                                                    '5' => 'Karat',
                                                    '6' => 'Sampah',
                                                    '7' => 'Retak/Pecah',
                                                    '8' => 'Sisa Produk',
                                                    '9' => 'Sisa Adonan',
                                                    '10'=> 'Berjamur',
                                                    '11'=> 'Lain-lain'
                                                    ];
                                                    @endphp

                                                    <tbody>
                                                        @foreach($pemeriksaan as $bagian => $item)
                                                        <tr>
                                                            <td>{{ $bagian }}</td>
                                                            <td>{{ $item['waktu'] ?? '-' }}</td>
                                                            <td>{{ $kondisiMapping[$item['kondisi']] ?? '-' }}</td>
                                                            <td>{{ $item['keterangan'] ?? '-' }}</td>
                                                            <td>{{ $item['tindakan'] ?? '-' }}</td>
                                                            <td>{{ $item['waktu_koreksi'] ?? '-' }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>

                                                </table>
                                                @else
                                                <p class="text-muted">Belum ada pemeriksaan.</p>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <span class="text-muted">Belum ada pemeriksaan</span>
                                @endif
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
                                    class="text-danger fw-bold text-decoration-none">Revision</a>
                                    <div class="modal fade" id="revisionModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="revisionModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="revisionModalLabel{{ $dep->uuid }}">Detail Revisi</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
                                    <a href="{{ route('sanitasi.update.form', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil"></i> Update
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="14" class="text-center text-muted">Belum ada data sanitasi.</td>
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

    {{-- Auto-hide alert --}}
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
            }
        }, 3000);
    </script>

    {{-- CSS tambahan --}}
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
