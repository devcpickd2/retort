@extends('layouts.app')

@section('title', 'Daftar Pemeriksaan Loading')

@section('content')
<div class="container-fluid py-0">

    {{-- Alert Section --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ trim(session('success')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Card Wrapper --}}
    <div class="card card-custom shadow-sm">
        <div class="card-body">

            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">
                    {{-- Menggunakan ikon Truck untuk Loading --}}
                    <i class="bi bi-truck me-2"></i> Daftar Pemeriksaan Loading
                </h3>
                <div>
                    <a href="{{ route('loading-produks.create') }}" class="btn btn-success me-2">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </a>
                    <a href="{{ route('loading-produks.exportPdf', ['date' => request('date'), 'shift' => request('shift')]) }}" target="_blank" class="btn btn-primary">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                    </a>
                </div>
            </div>

            {{-- Filter dan Live Search (Style Magnet Trap) --}}
            <form id="filterForm" method="GET" action="{{ route('loading-produks.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

                {{-- Input Tanggal --}}
                <div class="input-group" style="max-width: 220px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-calendar-date text-muted"></i>
                    </span>
                    <input type="date" name="date" id="filter_date" class="form-control border-start-0"
                    value="{{ request('date') ?? request('start_date') }}" placeholder="Tanggal">
                </div>

                {{-- Input Shift --}}
                <div class="input-group" style="max-width: 120px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-clock text-muted"></i>
                    </span>
                    <select name="shift" id="shift" class="form-control border-start-0">
                        <option value="">Semua Shift</option>
                        <option value="Pagi" {{ request('shift') == 'Pagi' ? 'selected' : '' }}>Pagi</option>
                        <option value="Malam" {{ request('shift') == 'Malam' ? 'selected' : '' }}>Malam</option>
                    </select>
                </div>

                {{-- Input Search --}}
                <div class="input-group flex-grow-1" style="max-width: 450px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search" id="search" class="form-control border-start-0"
                    value="{{ request('search') }}" placeholder="Cari No. Pol / Supir / Ekspedisi...">
                </div>

                {{-- Tombol Reset --}}
                @if(request('date') || request('shift') || request('search') || request('start_date'))
                <a href="{{ route('loading-produks.index') }}" class="btn btn-secondary btn-sm ms-auto">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </a>
                @endif

            </form>

            {{-- Script Auto Submit --}}
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const search = document.getElementById('search');
                    const date = document.getElementById('filter_date');
                    const shift = document.getElementById('shift');
                    const form = document.getElementById('filterForm');
                    let timer;

                    // Debounce search
                    search.addEventListener('input', () => {
                        clearTimeout(timer);
                        timer = setTimeout(() => form.submit(), 500);
                    });

                    // Auto submit date dan shift
                    date.addEventListener('change', () => form.submit());
                    shift.addEventListener('change', () => form.submit());
                });
            </script>

            {{-- Tabel Data --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>NO.</th>
                            <th>Tanggal</th>
                            <th>Shift</th>
                            <th>Aktivitas</th>
                            <th>No. Pol Mobil</th>
                            <th>Nama Supir</th>
                            <th>Ekspedisi</th>
                            <th>Dibuat Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produks as $produk)
                        <tr>
                            {{-- Penomoran --}}
                            <td class="text-center">{{ $loop->iteration + ($produks->currentPage() - 1) * $produks->perPage() }}</td>
                            
                            {{-- Tanggal --}}
                            <td class="text-center align-middle">
                                {{ \Carbon\Carbon::parse($produk->tanggal)->format('d-m-Y') }}
                            </td>

                            {{-- Data Columns --}}
                            <td class="text-center align-middle">{{ $produk->shift }}</td>
                            <td class="align-middle">{{ $produk->jenis_aktivitas }}</td>
                            <td class="text-center align-middle fw-bold">{{ $produk->no_pol_mobil }}</td>
                            <td class="align-middle">{{ $produk->nama_supir }}</td>
                            <td class="align-middle">{{ $produk->ekspedisi }}</td>
                            
                            {{-- Creator --}}
                            <td class="text-center align-middle">{{ $produk->creator->name ?? 'N/A' }}</td>
                            
                            {{-- Aksi --}}
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center">
                                    
                                    {{-- 1. Detail --}}
                                    <a href="{{ route('loading-produks.show', $produk->uuid) }}" class="btn btn-primary btn-sm fw-bold shadow-sm mx-1">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>
                                    
                                    {{-- 2. Edit --}}
                                    <a href="{{ route('loading-produks.edit', $produk->uuid) }}" class="btn btn-warning btn-sm mx-1">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="{{ route('loading-produks.update', $produk->uuid) }}" class="btn btn-info btn-sm mx-1 text-white" title="Lengkapi Data">
                                        <i class="bi bi-pencil"></i> Update
                                    </a>
                                    {{-- 3. Hapus --}}
                                    <form action="{{ route('loading-produks.destroy', $produk->uuid) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mx-1">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                                Data tidak ditemukan. Silakan tambahkan data baru atau ubah filter.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($produks->hasPages())
            <div class="mt-3">
                {{ $produks->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
            @endif

        </div>
    </div>
</div>

{{-- Auto-hide alert script --}}
<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if(alert){
            alert.classList.remove('show');
            alert.classList.add('fade');
        }
    }, 3000);
</script>

{{-- Style Tambahan --}}
@push('styles')
<style>
    /* Styling Font Tabel */
    .table td, .table th {
        font-size: 0.85rem;
        white-space: nowrap; 
    }
    
    /* Styling Card Custom */
    .card-custom {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    /* Input Group Focus State */
    .input-group:focus-within {
        box-shadow: none;
    }
    .form-control:focus, .input-group-text:focus {
         box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
         border-color: #86b7fe;
    }

    body { background-color: #f8f9fa; }
    
    /* Import Bootstrap Icons */
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css");
</style>
@endpush

@endsection
