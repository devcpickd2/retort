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
                <h3><i class="bi bi-list-check"></i> Pemeriksaan Mincing - Emulsifying - Aging</h3>
                <a href="{{ route('mincing.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Live Search --}}
            <form id="filterForm" method="GET" action="{{ route('mincing.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

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
                            <th>Hasil Pemeriksaan</th>
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
                            <td class="text-center align-middle">
                                @if($dep)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#mincingModal{{ $dep->uuid }}" style="font-weight: bold; text-decoration: underline;">
                                    Result
                                </a>

                                @php
                                $nonPremixItems = json_decode($dep->non_premix ?? '[]', true);
                                $premixItems    = json_decode($dep->premix ?? '[]', true);
                                @endphp

                                <div class="modal fade" id="mincingModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="mincingModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning text-white">
                                                <h5 class="modal-title" id="mincingModalLabel{{ $dep->uuid }}">Detail Pemeriksaan Mincing</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body table-responsive">
                                                <table class="table table-bordered table-striped table-sm text-center align-middle">
                                                    <tbody>
                                                        {{-- KODE PRODUKSI --}}
                                                        <tr>
                                                            <td class="text-left">Kode Produksi</td>
                                                            <td colspan="5">{{ $dep->kode_produksi ?? '-' }}</td>
                                                        </tr>

                                                        {{-- PREPARATION --}}
                                                        <tr>
                                                            <td class="text-left">Preparation</td>
                                                            <td colspan="2">{{ $dep->waktu_mulai ?? '-' }}</td>
                                                            <td class="text-center">-</td>
                                                            <td colspan="2">{{ $dep->waktu_selesai ?? '-' }}</td>
                                                        </tr>

                                                        {{-- NON-PREMIX --}}
                                                        <tr class="section-header bg-light fw-bold">
                                                            <td class="text-left">Bahan Baku dan Bahan Tambahan (Non-Premix)</td>
                                                            <td>Kode</td>
                                                            <td>(°C)</td>
                                                            <td>*pH</td>
                                                            <td>Kg</td>
                                                            <td>Sens</td>
                                                        </tr>
                                                        @if(count($nonPremixItems) > 0)
                                                        @foreach($nonPremixItems as $bahan)
                                                        <tr>
                                                            <td>{{ $bahan['nama_bahan'] ?? '-' }}</td>
                                                            <td>{{ $bahan['kode_bahan'] ?? '-' }}</td>
                                                            <td>{{ $bahan['suhu_bahan'] ?? '-' }}</td>
                                                            <td>{{ $bahan['ph_bahan'] ?? '-' }}</td>
                                                            <td>{{ $bahan['berat_bahan'] ?? '-' }}</td>
                                                            <td>{{ $bahan['sensori'] ?? '-' }}</td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr><td colspan="6">-</td></tr>
                                                        @endif

                                                        {{-- PREMIX --}}
                                                        <tr class="section-header bg-light fw-bold">
                                                            <td class="text-left">Premix</td>
                                                            <td colspan="2">Kode</td>
                                                            <td colspan="2">Kg</td>
                                                            <td>Sens</td>
                                                        </tr>
                                                        @if(count($premixItems) > 0)
                                                        @foreach($premixItems as $p)
                                                        <tr>
                                                            <td>{{ $p['nama_premix'] ?? '-' }}</td>
                                                            <td colspan="2">{{ $p['kode_premix'] ?? '-' }}</td>
                                                            <td colspan="2">{{ $p['berat_premix'] ?? '-' }}</td>
                                                            <td>{{ $p['sensori_premix'] ?? '-' }}</td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr><td colspan="6">-</td></tr>
                                                        @endif

                                                        {{-- SUHU & WAKTU --}}
                                                        <tr>
                                                            <td class="text-left">Suhu (Sebelum Grinding)</td>
                                                            <td colspan="5">{{ $dep->suhu_sebelum_grinding ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Waktu Mixing Premix</td>
                                                            <td colspan="2">{{ $dep->waktu_mixing_premix_awal ?? '-' }}</td>
                                                            <td class="text-center">-</td>
                                                            <td colspan="2">{{ $dep->waktu_mixing_premix_akhir ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Waktu Bowl Cutter</td>
                                                            <td colspan="2">{{ $dep->waktu_bowl_cutter_awal ?? '-' }}</td>
                                                            <td class="text-center">-</td>
                                                            <td colspan="2">{{ $dep->waktu_bowl_cutter_akhir ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Waktu Aging Emulsi</td>
                                                            <td colspan="2">{{ $dep->waktu_aging_emulsi_awal ?? '-' }}</td>
                                                            <td class="text-center">-</td>
                                                            <td colspan="2">{{ $dep->waktu_aging_emulsi_akhir ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Suhu Akhir Emulsi Gel</td>
                                                            <td colspan="5">{{ $dep->suhu_akhir_emulsi_gel ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Waktu Mixing</td>
                                                            <td colspan="5">{{ $dep->waktu_mixing ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Suhu Akhir Mixing</td>
                                                            <td colspan="5">{{ $dep->suhu_akhir_mixing ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Suhu Akhir Emulsifying</td>
                                                            <td colspan="5">{{ $dep->suhu_akhir_emulsi ?? '-' }}</td>
                                                        </tr>

                                                        {{-- CATATAN --}}
                                                        <tr>
                                                            <td class="text-left">Catatan</td>
                                                            <td colspan="5">{{ $dep->catatan ?? '-' }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
                                @if ($dep->status_produksi == 0)
                                <span class="fw-bold text-secondary">Created</span>
                                @elseif ($dep->status_produksi == 1)
                                <!-- Link buka modal -->
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#checkedModal{{ $dep->uuid }}" 
                                    class="fw-bold text-success text-decoration-none" style="cursor: pointer; font-weight: bold;">Checked</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="checkedModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="checkedModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success text-white">
                                                    <h5 class="modal-title" id="checkedModalLabel{{ $dep->uuid }}">Detail Checked</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-unstyled mb-0">
                                                        <li><strong>Status:</strong> Checked</li>
                                                        <li><strong>Nama Produksi:</strong> {{ $dep->nama_produksi ?? '-' }}</li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif ($dep->status_produksi == 2)
                                    <span class="fw-bold text-danger">Recheck</span>
                                    @endif
                                </td>
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
                                    <a href="{{ route('mincing.update.form', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil"></i> Update
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="19" class="text-center">Belum ada data mincing.</td>
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
