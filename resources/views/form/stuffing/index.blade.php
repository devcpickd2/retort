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
                <h3><i class="bi bi-list-check"></i> Pemeriksaan Stuffing Sosis Retort</h3>
                <a href="{{ route('stuffing.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Live Search --}}
            <form id="filterForm" method="GET" action="{{ route('stuffing.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

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

            {{-- Tambahkan table-responsive agar tabel tidak keluar border --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                 <thead class="table-primary text-center">
                    <tr>
                        <th>NO.</th>
                        <th>Date | Shift</th>
                        <th>Nama Produk</th>
                        <th>Kode Produksi</th>
                        <th>Exp. Date</th>
                        <th>Kode Mesin</th>
                        <th>Jam Mulai</th>
                        <th>Pemeriksaan</th>
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
                        <td class="text-center align-middle">{{ $dep->nama_produk }}</td>
                        <td class="text-center align-middle">{{ $dep->kode_produksi }}</td>
                        <td class="text-center align-middle">{{ \Carbon\Carbon::parse($dep->exp_date)->format('d-m-Y') }}</td>   
                        <td class="text-center align-middle">{{ $dep->kode_mesin }}</td>
                        <td class="text-center align-middle">{{ $dep->jam_mulai ?? '-' }}</td>
                        <td class="text-center align-middle">
                            @if($dep->id)
                            <button class="btn btn-info btn-sm mb-2 toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#stuffingCollapse{{ $dep->uuid }}" aria-expanded="false" aria-controls="stuffingCollapse{{ $dep->uuid }}">
                                Details
                            </button>
                            <div class="collapse" id="stuffingCollapse{{ $dep->uuid }}">
                                <div class="table-responsive">
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const toggleButtons = document.querySelectorAll('.toggle-btn');

                                    toggleButtons.forEach(function(btn) {
                                        const targetId = btn.getAttribute('data-bs-target');
                                        const collapseEl = document.querySelector(targetId);

                                        collapseEl.addEventListener('shown.bs.collapse', function () {
                                            btn.textContent = 'Hide';
                                        });
                                        collapseEl.addEventListener('hidden.bs.collapse', function () {
                                            btn.textContent = 'Details';
                                        });
                                    });
                                });
                            </script>


                            <div class="collapse" id="stuffingCollapse{{ $dep->uuid }}">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm text-center align-middle">
                                        <tbody>
                                            @php
                                            $fields = [
                                            ['type'=>'title', 'label'=>'Parameter Adonan'],
                                            ['type'=>'field', 'label'=>'Suhu (°C)', 'key'=>'suhu'],
                                            ['type'=>'field', 'label'=>'Sensori', 'key'=>'sensori'],
                                            ['type'=>'title', 'label'=>'Parameter Stuffing'],
                                            ['type'=>'field', 'label'=>'Kecepatan Stuffing', 'key'=>'kecepatan_stuffing'],
                                            ['type'=>'field', 'label'=>'Panjang/pcs (cm)', 'key'=>'panjang_pcs'],
                                            ['type'=>'field', 'label'=>'Berat/pcs (gr)', 'key'=>'berat_pcs'],
                                            ['type'=>'field', 'label'=>'Cek Vakum', 'key'=>'cek_vakum'],
                                            ['type'=>'field', 'label'=>'Kebersihan Seal', 'key'=>'kebersihan_seal'],
                                            ['type'=>'field', 'label'=>'Kekuatan Seal', 'key'=>'kekuatan_seal'],
                                            ['type'=>'field', 'label'=>'Diameter Klip (mm)', 'key'=>'diameter_klip'],
                                            ['type'=>'field', 'label'=>'Print Kode', 'key'=>'print_kode'],
                                            ['type'=>'field', 'label'=>'Lebar Cassing (mm)', 'key'=>'lebar_cassing'],
                                            ];
                                            @endphp

                                            @foreach($fields as $item)
                                            @if($item['type'] === 'title')
                                            <tr class="table-secondary">
                                                <td class="text-start fw-bold" colspan="2">{{ $item['label'] }}</td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td class="text-start">{{ $item['label'] }}</td>
                                                @php
                                                $value = $dep->{$item['key']} ?? null;
                                                $display = in_array($item['key'], ['sensori','cek_vakum','kebersihan_seal','kekuatan_seal','print_kode'])
                                                ? (!empty($value) ? '✔' : '-') 
                                                : ($value ?? '-');
                                                @endphp
                                                <td>{{ $display }}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
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
                            <a href="{{ route('stuffing.update.form', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil"></i> Update
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center align-middle">Belum ada data stuffing.</td>
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
