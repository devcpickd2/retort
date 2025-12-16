@extends('layouts.app')

@section('content')
<div class="container-fluid py-0">

    {{-- Alert Section (Copy from Reference) --}}
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
                {{-- Judul disesuaikan --}}
                <h3 class="fw-bold"><i class="bi bi-clipboard-check me-2"></i> Data Pemeriksaan Retain</h3>
                <div>
                    <a href="{{ route('pemeriksaan_retain.create') }}" class="btn btn-success me-2">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </a>
                    <a href="{{ route('pemeriksaan_retain.exportPdf', ['date' => request('date')]) }}" target="_blank" class="btn btn-primary">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                    </a>
                </div>
            </div>

            {{-- Filter dan Live Search (Style Magnet Trap - Persis Referensi) --}}
            <form id="filterForm" method="GET" action="{{ route('pemeriksaan_retain.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">

                {{-- Input Tanggal (Menggunakan satu tanggal untuk menyamakan UI, sesuaikan controller jika butuh range) --}}
                <div class="input-group" style="max-width: 220px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-calendar-date text-muted"></i>
                    </span>
                    <input type="date" name="date" id="filter_date" class="form-control border-start-0"
                    value="{{ request('date') }}" placeholder="Tanggal">
                </div>

                {{-- Input Search --}}
                <div class="input-group flex-grow-1" style="max-width: 450px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search" id="search" class="form-control border-start-0"
                    value="{{ request('search') }}" placeholder="Cari Keterangan / Dibuat Oleh...">
                </div>

                {{-- Tombol Reset (Optional: Agar UX lebih baik jika user ingin clear filter) --}}
                @if(request('date') || request('search'))
                <a href="{{ route('pemeriksaan_retain.index') }}" class="btn btn-secondary btn-sm ms-auto">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </a>
                @endif

            </form>

            {{-- Script Auto Submit (Sama persis dengan referensi) --}}
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const search = document.getElementById('search');
                    const date = document.getElementById('filter_date');
                    const form = document.getElementById('filterForm');
                    let timer;

                    // Debounce search
                    search.addEventListener('input', () => {
                        clearTimeout(timer);
                        timer = setTimeout(() => form.submit(), 500);
                    });

                    // Auto submit date
                    date.addEventListener('change', () => form.submit());
                });
            </script>

            {{-- Tabel Data --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>NO.</th>
                            <th>Tanggal</th>
                            <th>Hari</th>
                            <th>Keterangan</th>
                            <th>Jumlah Item</th>
                            <th>Dibuat Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pemeriksaanRetains as $p)
                        <tr>
                            {{-- Penomoran Halaman --}}
                            <td class="text-center">{{ $loop->iteration + ($pemeriksaanRetains->currentPage() - 1) * $pemeriksaanRetains->perPage() }}</td>
                            
                            {{-- Tanggal --}}
                            <td class="text-center align-middle">
                                {{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}
                            </td>

                            {{-- Hari --}}
                            <td class="text-center align-middle">{{ $p->hari }}</td>

                            {{-- Keterangan --}}
                            <td class="align-middle">{{ Str::limit($p->keterangan, 50) }}</td>

                            {{-- Jumlah Item --}}
                            <td class="text-center align-middle">
                                <span class="align-middle">{{ $p->items_count ?? 0 }}</span>
                            </td>

                            {{-- Creator --}}
                            <td class="text-center align-middle">{{ $p->creator->name ?? '-' }}</td>
                            
                            {{-- Aksi --}}
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center">

                                    {{-- 1. Detail --}}
                                    <a href="{{ route('pemeriksaan_retain.show', $p->uuid) }}" class="btn btn-primary btn-sm fw-bold shadow-sm mx-1">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>

                                    {{-- 2. Update (TOMBOL BARU - Hijau) --}}
                                    <a href="{{ route('pemeriksaan_retain.edit-for-update', $p->uuid) }}" class="btn btn-success btn-sm fw-bold shadow-sm mx-1">
                                        <i class="bi bi-clipboard-check me-1"></i> Update
                                    </a>

                                    {{-- 3. Edit --}}
                                    <a href="{{ route('pemeriksaan_retain.edit', $p->uuid) }}" class="btn btn-warning btn-sm mx-1">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    {{-- 4. Hapus --}}
                                    <form action="{{ route('pemeriksaan_retain.destroy', $p->uuid) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data pemeriksaan retain ini?')">
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
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data pemeriksaan retain.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $pemeriksaanRetains->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

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

{{-- Style Tambahan (Wajib dicopy agar tampilan sama persis) --}}
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
    
    /* Memastikan link font bootstrap icons tersedia (jika belum ada di layout utama) */
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css");
</style>
@endsection
