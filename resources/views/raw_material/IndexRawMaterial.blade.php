@extends('layouts.app')

@section('content')
<div class="container-fluid py-0">

    {{-- Alert --}}
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
        <h2 class="h4">Data Pemeriksaan Bahan Baku</h2>
        <div class="btn-group" role="group">
            <a href="{{ route('inspections.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah
            </a>
            <a href="{{ route('inspections.exportPdf', ['date' => request('date')]) }}" target="_blank" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
        </div>
    </div>

    {{-- Filter dan Live Search --}}
    <form id="filterForm" method="GET" action="{{ route('inspections.index') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3 p-3 border rounded bg-white shadow-sm">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-1">Pilih Tanggal</div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-calendar-date text-muted"></i>
                        </span>
                    </div>
                    <input type="date" name="date" id="filter_date" class="form-control border-start-0"
                    value="{{ request('date') }}" placeholder="Tanggal">
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
                    <input type="text" name="search" id="search" class="form-control border-start-0"
                    value="{{ request('search') }}" placeholder="Cari Bahan Baku / Supplier / No. DO...">
                </div>
            </div>
            <div class="col-md-4 align-self-end">
                <a href="{{ route('inspections.index') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </a>
            </div>
        </div>
    </form>

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

    <div class="card shadow-sm">
        <div class="card-body">
            {{-- Tabel Data --}}
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th>NO.</th>
                            <th>Tgl Datang</th>
                            <th>Bahan Baku</th>
                            <th>Supplier</th>
                            <th>No. DO / PO</th>
                            <th>Nopol Mobil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inspections as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + ($inspections->currentPage() - 1) * $inspections->perPage() }}</td>
                            
                            {{-- Tanggal --}}
                            <td class="text-center align-middle">
                                {{ $item->setup_kedatangan ? \Carbon\Carbon::parse($item->setup_kedatangan)->format('d-m-Y') : '-' }} <br>
                                <span class="text-muted small">
                                    {{ $item->setup_kedatangan ? \Carbon\Carbon::parse($item->setup_kedatangan)->format('H:i') : '' }}
                                </span>
                            </td>

                            <td class="align-middle">{{ $item->bahan_baku }}</td>
                            <td class="align-middle">{{ Str::limit($item->supplier, 25) }}</td>
                            <td class="text-center align-middle">{{ $item->do_po }}</td>
                            <td class="text-center align-middle">{{ $item->nopol_mobil }}</td>
                            
                            {{-- Aksi --}}
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center">

                                    {{-- 1. Detail (Disesuaikan dengan style tombol 'Verifikasi' - Primary, Bold, Shadow) --}}
                                    <a href="{{ route('inspections.show', $item->uuid) }}" class="btn btn-primary btn-sm fw-bold shadow-sm mx-1">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>

                                    {{-- 2. Edit Data (Style tombol Warning dengan Text) --}}
                                    <a href="{{ route('inspections.edit', $item->uuid) }}" class="btn btn-warning btn-sm mx-1">
                                        <i class="bi bi-pencil-square"></i> Edit Data
                                    </a>

                                    {{-- 3. Update (Route Baru yang Anda minta - Style tombol Info dengan Text) --}}
                                    <a href="{{ route('inspections.form_update', $item->uuid) }}" class="btn btn-info btn-sm mx-1">
                                        <i class="bi bi-pencil"></i> Update
                                    </a>

                                    {{-- 4. Hapus (Style tombol Danger - Icon Only) --}}
                                    <form action="{{ route('inspections.destroy', $item->uuid) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                                Belum ada data pemeriksaan bahan baku.
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
        {{ $inspections->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>

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

{{-- Style Tambahan --}}
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
    
    /* Input Group Focus State untuk tampilan lebih bersih (Menghilangkan garis biru saat klik) */
    .input-group:focus-within {
        box-shadow: none;
    }
    .form-control:focus, .input-group-text:focus {
         box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
         border-color: #86b7fe;
    }

    body { background-color: #f8f9fa; }
    
    /* Memastikan link font bootstrap icons tersedia */
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css");
</style>
@endsection
