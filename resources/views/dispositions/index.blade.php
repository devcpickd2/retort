@extends('layouts.app')

@section('title', 'Daftar Disposisi')

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
                    <i class="bi bi-file-earmark-text me-2"></i>Daftar Disposisi
                </h3>
                <a href="{{ route('dispositions.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Baru
                </a>
            </div>

            {{-- Filter Section (Sesuai Gambar Screenshot) --}}

            <form id="filterForm" method="GET" action="{{ route('dispositions.index') }}" class="d-flex align-items-center gap-2 mb-4 p-2 rounded" style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
                
                {{-- 1. Input Tanggal (Kiri) --}}
                <div class="input-group" style="width: 200px;">
                    {{-- Icon Kalender dengan Background Putih --}}
                    <span class="input-group-text bg-white text-muted border-end-0" style="border-color: #ced4da;">
                        <i class="bi bi-calendar4-week"></i> {{-- Icon yang mirip dengan gambar (ada angkanya) --}}
                    </span>
                    <input type="date" 
                           name="date" 
                           id="filter_date" 
                           class="form-control border-start-0 ps-0 shadow-none filter-input text-muted" 
                           value="{{ request('date') }}"
                           style="border-color: #ced4da; font-size: 0.95rem;">
                </div>

                {{-- 2. Input Search (Kanan - Memanjang) --}}
                <div class="input-group flex-grow-1" style="max-width: 450px;">
                    {{-- Icon Search dengan Background Putih --}}
                    <span class="input-group-text bg-white text-muted border-end-0" style="border-color: #ced4da;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" 
                           name="search" 
                           id="filter_search" 
                           class="form-control border-start-0 ps-0 shadow-none filter-input" 
                           placeholder="Cari Keterangan / Dibuat Oleh..." 
                           value="{{ request('search') }}"
                           style="border-color: #ced4da; font-size: 0.95rem;">
                </div>

                {{-- Tombol Reset (Opsional - Icon Refresh Kecil) --}}
                @if(request('date') || request('search'))
                <a href="{{ route('dispositions.index') }}" class="btn btn-light border text-muted" title="Reset" style="background-color: white;">
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
                            <th style="width: 15%;">Nomor</th>
                            <th style="width: 15%;">Tanggal</th>
                            <th style="width: 20%;">Kepada</th>
                            <th>Tipe Disposisi</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dispositions as $disp)
                            <tr>
                                {{-- Penomoran --}}
                                <td class="text-center fw-bold text-secondary">
                                    {{ $loop->iteration + ($dispositions->currentPage() - 1) * $dispositions->perPage() }}
                                </td>
                                
                                {{-- Nomor --}}
                                <td class="fw-bold text-center text-primary">{{ $disp->nomor }}</td>
                                
                                {{-- Tanggal --}}
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($disp->tanggal)->format('d-m-Y') }}
                                </td>
                                
                                {{-- Kepada --}}
                                <td>{{ $disp->kepada }}</td>
                                
                                {{-- Tipe Disposisi --}}
                                <td class="text-center">
                                    @if($disp->disposisi_produk) <span class="badge bg-primary">Produk</span> @endif
                                    @if($disp->disposisi_material) <span class="badge bg-warning text-dark">Material</span> @endif
                                    @if($disp->disposisi_prosedur) <span class="badge bg-info text-dark">Prosedur</span> @endif
                                </td>
                                
                                {{-- Aksi --}}
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        {{-- Detail --}}
                                        <a href="{{ route('dispositions.show', $disp->uuid) }}" class="btn btn-sm btn-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        
                                        {{-- Edit --}}
                                        <a href="{{ route('dispositions.edit', $disp->uuid) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="{{ route('dispositions.update_form', $disp->uuid) }}" 
                                            class="btn btn-sm btn-success text-white" 
                                            title="Update / Lengkapi Data">
                                            <i class="bi bi-pencil-square"></i> Update
                                        </a>
                                        
                                        {{-- Hapus --}}
                                        <form action="{{ route('dispositions.destroy', $disp->uuid) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                                <td colspan="6" class="text-center py-5 text-muted">
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
            @if ($dispositions->hasPages())
            <div class="d-flex justify-content-end mt-3">
                {!! $dispositions->withQueryString()->links('pagination::bootstrap-5') !!}
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
            // Jika input date diubah, langsung submit
            if(input.type === 'date') {
                input.addEventListener('change', () => form.submit());
            } 
            // Jika input text diketik, tunggu sebentar (debounce) baru submit
            else {
                input.addEventListener('input', () => {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        form.submit();
                    }, 600); // Delay 600ms
                });
            }
        });

        // 2. Logic untuk Auto Hide Alert
        const alertBox = document.querySelector('.alert');
        if(alertBox){
            setTimeout(() => {
                alertBox.classList.remove('show');
                alertBox.classList.add('fade');
                // Hapus elemen dari DOM setelah fade out selesai
                setTimeout(() => alertBox.remove(), 500); 
            }, 3000); // Hilang setelah 3 detik
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
        background-color: #fff; /* Pastikan putih */
    }
    
    /* Efek Focus: Memberikan highlight biru pada input DAN ikonnya */
    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control {
        border-color: #86b7fe;
        box-shadow: none; /* Hilangkan shadow default bootstrap agar lebih clean atau sesuaikan jika perlu */
    }
    
    /* Import Bootstrap Icons */
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css");
</style>
@endpush

@endsection