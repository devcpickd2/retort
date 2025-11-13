{{-- resources/views/berita-acara/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Berita Acara')

{{-- Menambahkan style kustom & Font Awesome --}}
@push('styles')
<style>
    /* Anda bisa memindahkan ini ke file CSS utama Anda */
    .card-custom {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .table-header-custom {
        background-color: var(--bs-primary, #0D6EFD); /* Header biru */
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
{{-- Font Awesome (sesuai contoh Anda) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush


@section('content')
<div class="container my-5">
    <div class="card card-custom">
        <div class="card-body p-4">

            {{-- BAGIAN HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-0 fw-bold">
                    <i class="fas fa-file-signature me-2"></i>Daftar Berita Acara
                </h4>
                <a href="{{ route('berita-acara.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-1"></i>Tambah Baru
                </a>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- BAGIAN FILTER --}}
            {{-- Catatan: Pastikan controller 'index' Anda menghandle filter ini --}}
            <form method="GET" action="{{ route('berita-acara.index') }}" class="row g-3 align-items-end mb-4">
                <div class="col-md-3">
                    <label for="start_date" class="form-label small fw-bold">Tanggal Awal</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="form-label small fw-bold">Tanggal Akhir</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="search" class="form-label small fw-bold">Pencarian</label>
                    <input type="text" id="search" name="search" class="form-control" placeholder="Cari nomor, supplier..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
                    <a href="{{ route('berita-acara.index') }}" class="btn btn-secondary w-100"><i class="fas fa-sync-alt me-1"></i> Reset</a>
                </div>
            </form>
        </div>
        
        <hr class="my-0">

        {{-- BAGIAN TABEL DATA --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-header-custom">
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th style="width: 15%;">Nomor BA</th>
                        <th style="width: 10%;">Tanggal</th>
                        <th style="width: 15%;">Supplier</th>
                        <th style="width: 20%;">Nama Barang</th>
                        <th style="width: 10%;">Status PPIC</th>
                        <th style="width: 10%;">Status SPV</th>
                        <th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($beritaAcaras as $item)
                        <tr>
                            {{-- Nomor urut dengan paginasi --}}
                            <td class="text-center fw-bold">{{ $loop->iteration + ($beritaAcaras->currentPage() - 1) * $beritaAcaras->perPage() }}</td>
                            <td>{{ $item->nomor }}</td>
                            <td>{{ $item->tanggal_kedatangan->format('d M Y') }}</td>
                            <td>{{ $item->supplier }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>
                                @if($item->status_ppic == 0) <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($item->status_ppic == 1) <span class="badge bg-success">Verified</span>
                                @else <span class="badge bg-danger">Revision</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status_spv == 0) <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($item->status_spv == 1) <span class="badge bg-success">Verified</span>
                                @else <span class="badge bg-danger">Revision</span>
                                @endif
                            </td>
                            
                            {{-- Tombol Aksi (Gaya Baru) --}}
                            <td class="text-center">
                                <form action="{{ route('berita-acara.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                                    <div class="btn-group" role="group">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <a href="{{ route('berita-acara.show', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <a href="{{ route('berita-acara.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        {{-- Tampilan data kosong --}}
                        <tr>
                            <td colspan="8" class="text-center py-5">
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
        @if ($beritaAcaras->hasPages())
        <div class="card-footer bg-light">
            {{-- withQueryString agar filter tetap ada saat ganti halaman --}}
            {!! $beritaAcaras->withQueryString()->links() !!}
        </div>
        @endif
    </div>
</div>
@endsection