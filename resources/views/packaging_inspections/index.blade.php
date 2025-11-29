{{-- Menggunakan layout utama Anda --}}
@extends('layouts.app')

{{-- Menambahkan style khusus untuk halaman ini (diambil dari contoh UI/UX Anda) --}}
@push('styles')
<style>
    /* Variabel-variabel ini sebaiknya ada di file CSS utama Anda jika Anda menggunakan Bootstrap */
    :root {
        --bs-primary: #0D6EFD;
        --bs-success: #198754;
        --bs-warning: #FFC107;
        --bs-danger: #DC3545;
        --bs-secondary: #6C757D;
    }

    .card-custom {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .table-header-custom {
        background-color: var(--bs-primary); /* Warna Biru Primary */
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
    }
    .table > tbody > tr > td,
    .table > tbody > tr > th {
        vertical-align: middle;
    }
    .table-hover > tbody > tr:hover {
        background-color: #f8f9fa;
    }
    .btn-group .btn {
        margin: 0 !important;
    }
    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>
{{-- Font Awesome diperlukan untuk ikon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" xintegrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush


@section('content')
<div class="container-fluid py-0">
    <div class="card card-custom">
        <div class="card-body p-4">

            {{-- BAGIAN HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-0 fw-bold">
                    <i class="fas fa-boxes-packing me-2"></i>Daftar Pemeriksaan Packaging
                </h4>
                <a href="{{ route('packaging-inspections.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-1"></i>Tambah Inspeksi Baru
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- BAGIAN FILTER --}}
            <form method="GET" action="{{ route('packaging-inspections.index') }}" class="row g-3 align-items-end mb-4">
                <div class="col-md-3">
                    <label for="start_date" class="form-label small">Tanggal Awal</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="form-label small">Tanggal Akhir</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
                    <a href="{{ route('packaging-inspections.index') }}" class="btn btn-secondary w-100"><i class="fas fa-sync-alt me-1"></i> Reset</a>
                </div>
            </form>
        </div>
        
        <hr class="my-0">

        {{-- BAGIAN TABEL DATA --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-header-custom">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Tanggal Inspeksi</th>
                        <th>Shift</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inspections as $inspection)
                    <tr>
                        <td class="text-center fw-bold">{{ $loop->iteration + ($inspections->currentPage() - 1) * $inspections->perPage() }}</td>
                        <td>{{ $inspection->inspection_date ? \Carbon\Carbon::parse($inspection->inspection_date)->format('d M Y') : '-' }}</td>
                        <td>{{ $inspection->shift }}</td>
                        
                        <td class="text-center">
                            <form action="{{ route('packaging-inspections.destroy', $inspection) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <div class="btn-group" role="group">
                                    {{-- Tombol Detail / Show --}}
                                    <a href="{{ route('packaging-inspections.show', $inspection) }}" class="btn btn-sm btn-outline-primary" title="Detail"><i class="fas fa-eye"></i></a>
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('packaging-inspections.edit', $inspection) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                    {{-- Tombol Hapus --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Data tidak ditemukan</h5>
                            <p class="small text-muted">Coba ubah filter pencarian Anda atau tambahkan data baru.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($inspections->hasPages())
        <div class="card-footer bg-light">
            {{-- Menambahkan withQueryString agar filter tetap ada saat ganti halaman --}}
            {!! $inspections->withQueryString()->links() !!}
        </div>
        @endif
    </div>
</div>
@endsection
