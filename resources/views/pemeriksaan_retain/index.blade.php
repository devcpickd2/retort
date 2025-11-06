@extends('layouts.app') {{-- Sesuaikan dengan layout Anda --}}

{{-- Menambahkan style khusus dan Font Awesome (dari contoh UI/UX) --}}
@push('styles')
<style>
    .card-custom {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .table-header-custom {
        /* Menggunakan warna biru primary dari Bootstrap */
        background-color: #0D6EFD; 
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
<div class="container my-5">
    <div class="card card-custom">
        <div class="card-body p-4">

            {{-- BAGIAN HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-0 fw-bold">
                    {{-- Mengganti ikon dan judul sesuai konten Anda --}}
                    <i class="fas fa-clipboard-check me-2"></i>Daftar Pemeriksaan Retain
                </h4>
                {{-- Menggunakan route dan teks dari file Anda --}}
                <a href="{{ route('pemeriksaan_retain.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Tambah Data Baru
                </a>
            </div>

            {{-- Notifikasi (dari file Anda) --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- BAGIAN FILTER (dari contoh UI/UX) --}}
            {{-- CATATAN: Ini butuh update di Controller Anda untuk berfungsi --}}
            <form method="GET" action="{{ route('pemeriksaan_retain.index') }}" class="row g-3 align-items-end mb-4">
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
                    <a href="{{ route('pemeriksaan_retain.index') }}" class="btn btn-secondary w-100"><i class="fas fa-sync-alt me-1"></i> Reset</a>
                </div>
            </form>
        </div>
        
        <hr class="my-0">

        {{-- BAGIAN TABEL DATA --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-header-custom">
                    <tr>
                        {{-- Menggabungkan kolom dari kedua file --}}
                        <th class="text-center">No</th>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Keterangan</th>
                        <th class="text-center">Jumlah Item</th>
                        <th>Dibuat Oleh</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Menggunakan loop dan data dari file Anda --}}
                    @forelse ($pemeriksaanRetains as $p)
                    <tr>
                        {{-- Nomor urut yang sadar paginasi (dari contoh UI/UX) --}}
                        <td class="text-center fw-bold">{{ $loop->iteration + ($pemeriksaanRetains->currentPage() - 1) * $pemeriksaanRetains->perPage() }}</td>
                        
                        {{-- Data dari file Anda --}}
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</td>
                        <td>{{ $p->hari }}</td>
                        <td>{{ Str::limit($p->keterangan, 40) }}</td>
                        <td class="text-center">{{ $p->items_count }}</td> 
                        <td>{{ $p->creator->name ?? 'N/A' }}</td> 
                        
                        {{-- Tombol Aksi dengan Ikon (dari contoh UI/UX) --}}
                        <td class="text-center">
                            <form action="{{ route('pemeriksaan_retain.destroy', $p->uuid) }}" method="POST" onsubmit="return confirm('Pindahkan data ini ke keranjang sampah?');">
                                <div class="btn-group" role="group">
                                    {{-- Tombol Detail / Show --}}
                                    <a href="{{ route('pemeriksaan_retain.show', $p->uuid) }}" class="btn btn-sm btn-outline-primary" title="Detail"><i class="fas fa-eye"></i></a>
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('pemeriksaan_retain.edit', $p->uuid) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                    {{-- Tombol Hapus --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    {{-- Tampilan Data Kosong (dari contoh UI/UX) --}}
                    <tr>
                        <td colspan="7" class="text-center py-5">
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
        @if ($pemeriksaanRetains->hasPages())
        <div class="card-footer bg-light">
            {{-- Menambahkan withQueryString agar filter tetap ada saat ganti halaman --}}
            {!! $pemeriksaanRetains->withQueryString()->links() !!}
        </div>
        @endif
    </div>
</div>
@endsection