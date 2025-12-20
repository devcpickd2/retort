@extends('layouts.app')

@section('content')
<div class="container-fluid py-0">

    {{-- 1. BAGIAN ALERT --}}
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

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Daftar Pemeriksaan Packaging</h2>
        <div class="btn-group" role="group">
            <a href="{{ route('packaging-inspections.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah
            </a>
            <a href="{{ route('packaging-inspections.exportPdf', ['start_date' => request('start_date'), 'shift' => request('shift')]) }}" target="_blank" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
        </div>
    </div>

    {{-- FILTER SEPERTI GAMBAR --}}
    <form id="filterForm" method="GET" action="{{ route('packaging-inspections.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-3 border rounded bg-white shadow-sm">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-1">Pilih Tanggal</div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-calendar-date text-muted"></i>
                        </span>
                    </div>
                    <input type="date" name="start_date" id="start_date" class="form-control border-start-0 ps-1"
                           value="{{ request('start_date') }}" placeholder="dd/mm/yyyy">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-1">Pilih Shift</div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-clock text-muted"></i>
                        </span>
                    </div>
                    <select name="shift" id="shift" class="form-select form-control border-start-0 ps-1">
                        <option value="">Semua Shift</option>
                        <option value="1" {{ request('shift') == '1' ? 'selected' : '' }}>Shift 1</option>
                        <option value="2" {{ request('shift') == '2' ? 'selected' : '' }}>Shift 2</option>
                        <option value="3" {{ request('shift') == '3' ? 'selected' : '' }}>Shift 3</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-1">Cari Data</div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                    </div>
                    <input type="text" name="search" id="search" class="form-control border-start-0 ps-1"
                           value="{{ request('search') }}" placeholder="Cari Data..">
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const startInfo = document.getElementById('start_date');
            const shiftInfo = document.getElementById('shift');
            const searchInfo = document.getElementById('search');
            const form = document.getElementById('filterForm');
            let timer;

            // Fungsi Auto Submit
            const autoSubmit = () => form.submit();

            // Submit saat tanggal atau shift berubah
            startInfo.addEventListener('change', autoSubmit);
            shiftInfo.addEventListener('change', autoSubmit);

            // Debounce search untuk input teks
            searchInfo.addEventListener('input', () => {
                clearTimeout(timer);
                timer = setTimeout(autoSubmit, 500);
            });
        });
    </script>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            {{-- 3. TABEL DATA --}}
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th width="5%">NO.</th>
                            <th>Tanggal Inspeksi</th>
                            <th>Shift</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inspections as $inspection)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + ($inspections->currentPage() - 1) * $inspections->perPage() }}</td>
                            
                            {{-- Tanggal --}}
                            <td class="text-center align-middle">
                                {{ $inspection->inspection_date ? \Carbon\Carbon::parse($inspection->inspection_date)->format('d-m-Y') : '-' }}
                            </td>

                            {{-- Shift --}}
                            <td class="text-center align-middle">
                                <span class="badge bg-light text-dark border">
                                    {{ $inspection->shift }}
                                </span>
                            </td>
                            
                            {{-- Aksi --}}
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center">
                                    
                                    {{-- 1. Detail (Primary) --}}
                                    <a href="{{ route('packaging-inspections.show', $inspection) }}" class="btn btn-primary btn-sm fw-bold shadow-sm mx-1" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- 3. Edit Full (Warning) --}}
                                    <a href="{{ route('packaging-inspections.edit', $inspection) }}" class="btn btn-warning btn-sm mx-1" title="Edit Semua Data">
                                        <i class="bi bi-pencil-square"></i> Edit Data
                                    </a>
                                    {{-- 2. Update / Lengkapi (Success - HIJAU - MENU BARU) --}}
                                    {{-- Tombol ini mengarah ke route 'edit-for-update' yang baru dibuat --}}
                                    <a href="{{ route('packaging-inspections.edit-for-update', $inspection) }}" class="btn btn-info btn-sm mx-1" title="Lengkapi Data">
                                        <i class="bi bi-pencil"></i> Update
                                    </a>


                                    {{-- 4. Hapus (Danger) --}}
                                    <form action="{{ route('packaging-inspections.destroy', $inspection) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mx-1" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data pemeriksaan packaging.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {!! $inspections->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

{{-- 4. SCRIPT & STYLE TAMBAHAN --}}

{{-- Auto-hide alert --}}
<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if(alert){
            alert.classList.remove('show');
            alert.classList.add('fade');
        }
    }, 3000);
</script>

<style>
    /* Styling Font Tabel agar compact */
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
    
    /* Input Group Focus State - Menghilangkan border biru saat fokus */
    .input-group:focus-within {
        box-shadow: none;
    }
    .form-control:focus, .input-group-text:focus {
         box-shadow: none; /* Menghilangkan shadow biru bootstrap */
         border-color: #ced4da; /* Tetap gunakan warna border default */
    }

    /* Agar icon dan input terlihat menyatu */
    .input-group-text {
        background-color: #fff;
    }

    body { background-color: #f8f9fa; }
    
    /* Import Bootstrap Icons */
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css");
</style>
@endsection
