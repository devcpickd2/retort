@extends('layouts.app')

@section('content')
<div class="container-fluid py-0">

    {{-- Helper Show Array (Optional) --}}
    @once
        @php
            function showValue($val) {
                if (is_array($val)) return implode(', ', $val);
                return e($val ?? '-');
            }
        @endphp
    @endonce

    {{-- Alert sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="bi bi-list-check"></i> Pengecekan Pemasakan</h3>
                <div class="btn-group">
                    @can('can access add button')
                    <a href="{{ route('pemasakan.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </a>
                    @endcan
                    {{-- Tombol Export PDF --}}
                    <button type="button" class="btn btn-danger" id="exportPdfBtn">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                    </button>
                </div>
            </div>

            {{-- Filter dan Live Search --}}
            <form id="filterForm" method="GET" action="{{ route('pemasakan.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

                <div class="input-group" style="max-width: 180px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-calendar-date text-muted"></i>
                    </span>
                    <input type="date" name="date" id="filter_date" class="form-control border-start-0"
                        value="{{ request('date') }}" placeholder="Tanggal Produksi">
                </div>

                {{-- PERBAIKAN: Filter Shift Ditambahkan --}}
                <div class="input-group" style="max-width: 150px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-hourglass-split text-muted"></i>
                    </span>
                    <select name="shift" id="filter_shift" class="form-select border-start-0 form-control">
                        <option value="">Semua Shift</option>
                        <option value="1" {{ request("shift") == "1" ? "selected" : "" }}>Shift 1</option>
                        <option value="2" {{ request("shift") == "2" ? "selected" : "" }}>Shift 2</option>
                        <option value="3" {{ request("shift") == "3" ? "selected" : "" }}>Shift 3</option>
                    </select>
                </div>

                <div class="input-group flex-grow-1" style="max-width: 350px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search" id="search" class="form-control border-start-0"
                        value="{{ request('search') }}" placeholder="Cari Nama Produk / Kode Produksi...">
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i> Filter</button>
                <a href="{{ route('pemasakan.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Reset</a>
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const search = document.getElementById('search');
                    const date = document.getElementById('filter_date');
                    const shift = document.getElementById('filter_shift'); // Get Element Shift
                    const form = document.getElementById('filterForm');
                    const exportPdfBtn = document.getElementById('exportPdfBtn');

                    let timer;

                    search.addEventListener('input', () => {
                        clearTimeout(timer);
                        timer = setTimeout(() => form.submit(), 500);
                    });

                    // Auto Submit saat filter berubah
                    date.addEventListener('change', () => form.submit());
                    if(shift) shift.addEventListener('change', () => form.submit());

                    // Export PDF Handler
                    if(exportPdfBtn){
                        exportPdfBtn.addEventListener('click', function() {
                            const formData = new FormData(form);
                            // Pastikan route exportPdf ada
                            const exportUrl = "{{ route('pemasakan.exportPdf') }}?" + new URLSearchParams(formData).toString();
                            window.open(exportUrl, '_blank');
                        });
                    }
                });
            </script>

            {{-- Tabel Data --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>NO.</th>
                            <th>Date | Shift</th>
                            <th>Nama Produk</th>
                            <th>Kode Produksi</th>
                            <th>No. Chamber</th>
                            <th>Berat Produk (Gram)</th>
                            <th>Suhu Produk (°C)</th>
                            <th>Jumlah Tray</th>
                            <th>Total Reject (Kg)</th>
                            <th>Pengecekan</th>
                            <th>QC</th>
                            <th>SPV</th>
                            <th>Verification</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $no = ($data->currentPage() - 1) * $data->perPage() + 1; 
                        @endphp

                        @forelse ($data as $dep)
                            @php
                                $cooking = json_decode($dep->cooking, true);
                            @endphp

                            <tr>
                                <td class="text-center align-middle">{{ $no++ }}</td>
                                <td class="text-center align-middle">{{ \Carbon\Carbon::parse($dep->date)->format('d-m-Y') }} | {{ $dep->shift }}</td>   
                                <td class="text-center align-middle">{{ $dep->nama_produk }}</td>
                                <td class="text-center align-middle">{{ $dep->kode_produksi }}</td>
                                <td class="text-center align-middle">{{ $dep->no_chamber }}</td>
                                <td class="text-center align-middle">{{ $dep->berat_produk }}</td>
                                <td class="text-center align-middle">{{ $dep->suhu_produk }}</td>
                                <td class="text-center align-middle">{{ $dep->jumlah_tray }}</td>
                                <td class="text-center align-middle">{{ $dep->total_reject }}</td>

                                <td class="text-center align-middle">
                                    @if(!empty($cooking))
                                        <a href="#" class="fw-bold text-decoration-underline text-primary"
                                           data-bs-toggle="modal" data-bs-target="#cookingModal{{ $dep->uuid }}">
                                            Result
                                        </a>

                                        {{-- Modal Detail Cooking --}}
                                        <div class="modal fade" id="cookingModal{{ $dep->uuid }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Detail Pemasakan</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-sm table-bordered">
                                                            @foreach($cooking as $key => $val)
                                                                <tr>
                                                                    <td class="fw-bold">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                                                                    {{-- Gunakan helper showValue jika ada --}}
                                                                    <td>{{ is_array($val) ? implode(', ', $val) : $val }}</td>
                                                                </tr>
                                                            @endforeach
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
                                    @if ($dep->status_spv == 0) <span class="fw-bold text-secondary">Created</span>
                                    @elseif ($dep->status_spv == 1) <span class="fw-bold text-success">Verified</span>
                                    @elseif ($dep->status_spv == 2) 
                                        <span class="fw-bold text-danger">Revisi</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @can('can access verification button')
                                    <button class="btn btn-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#verifyModal{{ $dep->uuid }}"><i class="bi bi-shield-check"></i> Verif</button>
                                    @endcan
                                    @can('can access edit button')
                                    <a href="{{ route('pemasakan.edit.form', $dep->uuid) }}" class="btn btn-warning btn-sm mb-1"><i class="bi bi-pencil-square"></i> Edit</a>
                                    @endcan
                                                                        @can('can access update button')
                                    <a href="{{ route('pemasakan.update.form', $dep->uuid) }}" class="btn btn-info btn-sm me-1">
                                        <i class="bi bi-pencil"></i> Update
                                    </a>
                                    @endcan
                                    @can('can access delete button')
                                    <form action="{{ route('pemasakan.destroy', $dep->uuid) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm mb-1" onclick="return confirm('Hapus?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                    @endcan
                                    
                                    {{-- Modal Verif --}}
                                    <div class="modal fade" id="verifyModal{{ $dep->uuid }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form action="{{ route('pemasakan.verification.update', $dep->uuid) }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h6 class="modal-title">Verifikasi</h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <select name="status_spv" class="form-select mb-2">
                                                            <option value="1">Verified</option>
                                                            <option value="2">Revision</option>
                                                        </select>
                                                        <textarea name="catatan_spv" class="form-control" placeholder="Catatan...">{{ $dep->catatan_spv }}</textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="14" class="text-center">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection