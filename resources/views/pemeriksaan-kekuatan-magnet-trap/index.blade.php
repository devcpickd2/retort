@extends('layouts.app')

@section('title', 'Daftar Pemeriksaan Kekuatan Magnet Trap')

@push('styles')
<style>
    /* Style kustom dari CRUD sebelumnya */
    .card-custom {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .table-header-custom {
        background-color: var(--bs-primary, #0D6EFD);
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
{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" xintegrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush


@section('content')
<div class="container-fluid py-0">
    <div class="card card-custom">
        <div class="card-body p-4">

            {{-- BAGIAN HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-0 fw-bold">
                    <i class="fas fa-magnet me-2"></i>Pemeriksaan Kekuatan Magnet Trap
                </h4>
                {{-- Route name diubah --}}
                <a href="{{ route('pemeriksaan-kekuatan-magnet-trap.create') }}" class="btn btn-success">
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
            {{-- Route name diubah --}}
            <form method="GET" action="{{ route('pemeriksaan-kekuatan-magnet-trap.index') }}" class="row g-3 align-items-end mb-4">
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
                    <input type="text" id="search" name="search" class="form-control" placeholder="Cari Magnet Ke, Petugas..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
                    {{-- Route name diubah --}}
                    <a href="{{ route('pemeriksaan-kekuatan-magnet-trap.index') }}" class="btn btn-secondary w-100"><i class="fas fa-sync-alt me-1"></i> Reset</a>
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
                        <th style="width: 20%;">Kondisi Visual</th>
                        <th style="width: 15%;">Petugas QC</th>
                        <th style="width: 10%;">Parameter</th>
                        <th style="width: 10%;">Status SPV</th>
                        <th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Variabel diubah --}}
                    @forelse ($pemeriksaanKekuatanMagnetTraps as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration + ($pemeriksaanKekuatanMagnetTraps->currentPage() - 1) * $pemeriksaanKekuatanMagnetTraps->perPage() }}</td>
                            <td>{{ $item->tanggal->format('d M Y') }}</td>
                            <td>{{ $item->kondisi_magnet_trap }}</td>
                            <td>{{ $item->petugas_qc }}</td>
                            <td>
                                @if($item->parameter_sesuai)
                                    <span class="badge bg-success">Sesuai</span>
                                @else
                                    <span class="badge bg-danger">Tdk Sesuai</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status_spv == 0) <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($item->status_spv == 1) <span class="badge bg-success">Verified</span>
                                @else <span class="badge bg-danger">Revision</span>
                                @endif
                            </td>
                            
                            <td class="text-center">
                                {{-- Route name diubah --}}
                                <form action="{{ route('pemeriksaan-kekuatan-magnet-trap.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                                    <div class="btn-group" role="group">
                                        @csrf
                                        @method('DELETE')
                                        
                                        {{-- Route name diubah --}}
                                        <a href="{{ route('pemeriksaan-kekuatan-magnet-trap.show', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        {{-- Route name diubah --}}
                                        <a href="{{ route('pemeriksaan-kekuatan-magnet-trap.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
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
        @if ($pemeriksaanKekuatanMagnetTraps->hasPages())
        <div class="card-footer bg-light">
            {!! $pemeriksaanKekuatanMagnetTraps->withQueryString()->links() !!}
        </div>
        @endif
    </div>
</div>
@endsection