@extends('layouts.app')

@section('title', 'Daftar Penyimpangan Kualitas')

@push('styles')
{{-- Style & Font Awesome dari UI/UX sebelumnya --}}
<style>
    .card-custom { border: none; border-radius: 0.75rem; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); }
    .table-header-custom { background-color: var(--bs-primary, #0D6EFD); color: white; text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.85rem; }
    .table > tbody > tr > td, .table > tbody > tr > th { vertical-align: middle; }
    .table-hover > tbody > tr:hover { background-color: #f8f9fa; }
    .btn-group .btn { margin: 0 !important; }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" xintegrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush


@section('content')
<div class="container-fluid py-0">
    <div class="card card-custom">
        <div class="card-body p-4">

            {{-- BAGIAN HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-0 fw-bold">
                    <i class="fas fa-exclamation-triangle me-2"></i>Daftar Penyimpangan Kualitas
                </h4>
                <a href="{{ route('penyimpangan-kualitas.create') }}" class="btn btn-success">
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
            <form method="GET" action="{{ route('penyimpangan-kualitas.index') }}" class="row g-3 align-items-end mb-4">
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
                    <input type="text" id="search" name="search" class="form-control" placeholder="Cari Nomor, Produk, Lot..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
                    <a href="{{ route('penyimpangan-kualitas.index') }}" class="btn btn-secondary w-100"><i class="fas fa-sync-alt me-1"></i> Reset</a>
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
                        <th style="width: 10%;">Tanggal</th>
                        <th style="width: 15%;">Nomor</th>
                        <th style="width: 20%;">Nama Produk</th>
                        <th style="width: 15%;">Lot/Kode</th>
                        <th style="width: 10%;">Status Diketahui</th>
                        <th style="width: 10%;">Status Disetujui</th>
                        <th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penyimpanganKualitasItems as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration + ($penyimpanganKualitasItems->currentPage() - 1) * $penyimpanganKualitasItems->perPage() }}</td>
                            <td>{{ $item->tanggal->format('d M Y') }}</td>
                            <td>{{ $item->nomor }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>{{ $item->lot_kode }}</td>
                            <td>
                                @if($item->status_diketahui == 0) <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($item->status_diketahui == 1) <span class="badge bg-success">Verified</span>
                                @else <span class="badge bg-danger">Revision</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status_disetujui == 0) <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($item->status_disetujui == 1) <span class="badge bg-success">Verified</span>
                                @else <span class="badge bg-danger">Revision</span>
                                @endif
                            </td>
                            
                            <td class="text-center">
                                <form action="{{ route('penyimpangan-kualitas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                                    <div class="btn-group" role="group">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('penyimpangan-kualitas.show', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('penyimpangan-kualitas.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
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
        @if ($penyimpanganKualitasItems->hasPages())
        <div class="card-footer bg-light">
            {!! $penyimpanganKualitasItems->withQueryString()->links() !!}
        </div>
        @endif
    </div>
</div>
@endsection