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

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Daftar Penyimpangan Kualitas</h2>
        <div class="btn-group" role="group">
            <a href="{{ route('penyimpangan-kualitas.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah
            </a>
            <a href="{{ route('penyimpangan-kualitas.exportPdf', ['date' => request('date')]) }}" target="_blank" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
        </div>
    </div>

    {{-- Filter dan Live Search --}}
    <form id="filterForm" method="GET" action="{{ route('penyimpangan-kualitas.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-3 border rounded bg-white shadow-sm">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-1">Pilih Tanggal</div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-calendar4-week"></i>
                        </span>
                    </div>
                    <input type="date" name="date" id="filter_date" class="form-control border-start-0 ps-0 shadow-none filter-input text-muted"
                        value="{{ request('date') }}" style="border-color: #ced4da; font-size: 0.95rem;">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-1">Cari Data</div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search"></i>
                        </span>
                    </div>
                    <input type="text" name="search" id="filter_search" class="form-control border-start-0 ps-0 shadow-none filter-input"
                        placeholder="Cari Nomor, Produk, Lot..." value="{{ request('search') }}"
                        style="border-color: #ced4da; font-size: 0.95rem;">
                </div>
            </div>
            <div class="col-md-4 align-self-end">
                <a href="{{ route('penyimpangan-kualitas.index') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </a>
            </div>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">
            {{-- Tabel Data --}}
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-secondary text-center">
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
        </div>
    </div>

    {{-- Pagination --}}
    @if ($penyimpanganKualitasItems->hasPages())
    <div class="mt-3">
        {!! $penyimpanganKualitasItems->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
    @endif
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
