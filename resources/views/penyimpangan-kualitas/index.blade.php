@extends('layouts.app')

@section('title', 'Daftar Penyimpangan Kualitas')

@section('content')
<div class="container-fluid py-0">

    {{-- Alert Section --}}
    @if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Card Wrapper --}}
    <div class="card card-custom shadow-sm">
        <div class="card-body">

            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold m-0">
                    {{-- Ikon Peringatan/Segitiga --}}
                    <i class="bi bi-exclamation-triangle me-2"></i>Daftar Penyimpangan Kualitas
                </h3>
                <a href="{{ route('penyimpangan-kualitas.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Baru
                </a>
            </div>

            {{-- Filter Section (Seamless Style) --}}
            <form id="filterForm" method="GET" action="{{ route('penyimpangan-kualitas.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-4 p-2 rounded" style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
                
                {{-- 1. Input Tanggal (Single Date) --}}
                <div class="input-group" style="width: 200px;">
                    <span class="input-group-text bg-white text-muted border-end-0" style="border-color: #ced4da;">
                        <i class="bi bi-calendar4-week"></i>
                    </span>
                    {{-- Menggunakan name="date" --}}
                    <input type="date" 
                           name="date" 
                           id="filter_date" 
                           class="form-control border-start-0 ps-0 shadow-none filter-input text-muted" 
                           value="{{ request('date') }}"
                           style="border-color: #ced4da; font-size: 0.95rem;">
                </div>

                {{-- 2. Input Search (Memanjang) --}}
                <div class="input-group flex-grow-1" style="max-width: 500px;">
                    <span class="input-group-text bg-white text-muted border-end-0" style="border-color: #ced4da;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" 
                           name="search" 
                           id="filter_search" 
                           class="form-control border-start-0 ps-0 shadow-none filter-input" 
                           placeholder="Cari Nomor, Produk, Lot..." 
                           value="{{ request('search') }}"
                           style="border-color: #ced4da; font-size: 0.95rem;">
                </div>

                {{-- Tombol Reset --}}
                @if(request('date') || request('search'))
                <a href="{{ route('penyimpangan-kualitas.index') }}" class="btn btn-light border text-muted" title="Reset Filter" style="background-color: white;">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
                @endif

            </form>

            {{-- Tabel Data --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle hover-table">
                    <thead class="table-primary text-center text-uppercase small fw-bold">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 10%;">Tanggal</th>
                            <th style="width: 15%;">Nomor</th>
                            <th style="width: 20%;">Nama Produk</th>
                            <th style="width: 15%;">Lot/Kode</th>
                            <th style="width: 10%;">Status Diketahui</th>
                            <th style="width: 10%;">Status Disetujui</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penyimpanganKualitasItems as $item)
                            <tr>
                                {{-- Penomoran --}}
                                <td class="text-center fw-bold text-secondary">
                                    {{ $loop->iteration + ($penyimpanganKualitasItems->currentPage() - 1) * $penyimpanganKualitasItems->perPage() }}
                                </td>
                                
                                {{-- Tanggal --}}
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                </td>

                                {{-- Nomor --}}
                                <td class="fw-bold text-center text-primary">{{ $item->nomor }}</td>
                                
                                {{-- Nama Produk --}}
                                <td>{{ $item->nama_produk }}</td>
                                
                                {{-- Lot Kode --}}
                                <td class="text-center">{{ $item->lot_kode }}</td>

                                {{-- Status Diketahui --}}
                                <td class="text-center">
                                    @if($item->status_diketahui == 0) 
                                        <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i> Pending</span>
                                    @elseif($item->status_diketahui == 1) 
                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Verified</span>
                                    @else 
                                        <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i> Revisi</span>
                                    @endif
                                </td>

                                {{-- Status Disetujui --}}
                                <td class="text-center">
                                    @if($item->status_disetujui == 0) 
                                        <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i> Pending</span>
                                    @elseif($item->status_disetujui == 1) 
                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Verified</span>
                                    @else 
                                        <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i> Revisi</span>
                                    @endif
                                </td>
                                
                                {{-- Aksi --}}
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        {{-- Detail --}}
                                        <a href="{{ route('penyimpangan-kualitas.show', $item->id) }}" class="btn btn-sm btn-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        
                                        {{-- Edit --}}
                                        <a href="{{ route('penyimpangan-kualitas.edit', $item->id) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        
                                        <a href="{{ route('penyimpangan-kualitas.update_form', $item->id) }}" 
                                            class="btn btn-sm btn-success text-white" 
                                            title="Update / Lengkapi Data">
                                            <i class="bi bi-pencil-square"></i> Update
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('penyimpangan-kualitas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <div class="mb-2"><i class="bi bi-clipboard-x display-4 text-secondary opacity-50"></i></div>
                                    <h6 class="fw-bold">Data tidak ditemukan</h6>
                                    <p class="small mb-0">Silakan tambahkan data baru atau ubah kata kunci pencarian.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($penyimpanganKualitasItems->hasPages())
            <div class="d-flex justify-content-end mt-3">
                {!! $penyimpanganKualitasItems->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
            @endif

        </div>
    </div>
</div>

{{-- JAVASCRIPT SECTION --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Logic untuk Auto Submit Filter
        const form = document.getElementById('filterForm');
        const inputs = document.querySelectorAll('.filter-input');
        let debounceTimer;

        inputs.forEach(input => {
            if(input.type === 'date') {
                input.addEventListener('change', () => form.submit());
            } else {
                input.addEventListener('input', () => {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        form.submit();
                    }, 600);
                });
            }
        });

        // 2. Logic untuk Auto Hide Alert
        const alertBox = document.querySelector('.alert');
        if(alertBox){
            setTimeout(() => {
                alertBox.classList.remove('show');
                alertBox.classList.add('fade');
                setTimeout(() => alertBox.remove(), 500); 
            }, 3000); 
        }
    });
</script>

{{-- CUSTOM STYLES --}}
@push('styles')
<style>
    /* Styling Card */
    .card-custom {
        border: none;
        border-radius: 0.8rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }
    
    /* Styling Font Tabel */
    .table td, .table th {
        font-size: 0.9rem;
        padding: 0.75rem 0.5rem;
    }
    
    /* Styling Input Group agar menyatu (Seamless) */
    .input-group-text {
        background-color: #fff;
    }
    
    /* Efek Focus */
    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control {
        border-color: #86b7fe;
        box-shadow: none; 
    }
    
    /* Import Bootstrap Icons */
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css");
</style>
@endpush

@endsection