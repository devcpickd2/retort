{{-- Menggunakan layout utama Anda --}}
@extends('layouts.app')

@section('title', 'Daftar Pemeriksaan Loading')

{{-- Menambahkan style kustom & Font Awesome --}}
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
</style>
{{-- Font Awesome diperlukan untuk ikon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush


@section('content')
<div class="container my-5">
    <div class="card card-custom">
        <div class="card-body p-4">

            {{-- BAGIAN HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-0 fw-bold">
                    <i class="fas fa-truck-ramp-box me-2"></i>Daftar Pemeriksaan Loading
                </h4>
                <a href="{{ route('loading-produks.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-1"></i>Tambah Baru
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- BAGIAN FILTER --}}
            <form method="GET" action="{{ route('loading-produks.index') }}" class="row g-3 align-items-end mb-4">
                <div class="col-md-3">
                    <label for="start_date" class="form-label small fw-bold">Tanggal Awal</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="form-label small fw-bold">Tanggal Akhir</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
                    <a href="{{ route('loading-produks.index') }}" class="btn btn-secondary w-100"><i class="fas fa-sync-alt me-1"></i> Reset</a>
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
                        <th>Tanggal</th>
                        <th>Shift</th>
                        <th>Aktivitas</th>
                        <th>No. Pol Mobil</th>
                        <th>Nama Supir</th>
                        <th>Ekspedisi</th>
                        <th>Dibuat Oleh</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $produk)
                    <tr>
                        <td class="text-center fw-bold">{{ $loop->iteration + ($produks->currentPage() - 1) * $produks->perPage() }}</td>
                        <td>{{ \Carbon\Carbon::parse($produk->tanggal)->format('d M Y') }}</td>
                        <td>{{ $produk->shift }}</td>
                        <td>{{ $produk->jenis_aktivitas }}</td>
                        <td>{{ $produk->no_pol_mobil }}</td>
                        <td>{{ $produk->nama_supir }}</td>
                        <td>{{ $produk->ekspedisi }}</td>
                        <td>{{ $produk->creator->name ?? 'N/A' }}</td>
                        
                        <td class="text-center">
                            <form action="{{ route('loading-produks.destroy', $produk->uuid) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                                <div class="btn-group" role="group">
                                    @csrf
                                    @method('DELETE')
                                    
                                    {{-- Tombol Detail/Show (Ganti ikon ke Font Awesome & style outline) --}}
                                    <a href="{{ route('loading-produks.show', $produk->uuid) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    {{-- Tombol Edit (Ganti ikon ke Font Awesome & style outline) --}}
                                    <a href="{{ route('loading-produks.edit', $produk->uuid) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    
                                    {{-- Tombol Hapus (Ganti ikon ke Font Awesome & style outline) --}}
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        {{-- Tampilan data kosong yang lebih baik (colspan disesuaikan jadi 9) --}}
                        <td colspan="9" class="text-center py-5">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Data tidak ditemukan</h5>
                            <p class="small text-muted">Coba ubah filter pencarian Anda atau tambahkan data baru.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- BAGIAN PAGINASI --}}
        @if ($produks->hasPages())
        <div class="card-footer bg-light">
            {{-- Menambahkan withQueryString agar filter tetap ada saat ganti halaman --}}
            {!! $produks->withQueryString()->links() !!}
        </div>
        @endif
    </div>
</div>
@endsection