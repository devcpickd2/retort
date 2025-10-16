{{-- Menggunakan layout utama --}}
@extends('layouts.app')

{{-- Menambahkan style khusus untuk halaman ini --}}
@push('styles')
<style>
    .card-custom {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .table-header-custom {
        background-color: #DC3545; /* Warna merah header */
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
    .badge-status {
        padding: 0.5em 0.75em;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 50rem;
    }
    .status-ok {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
    .status-not-ok {
        background-color: rgba(220, 53, 69, 0.1);
        color: #DC3545;
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
                <h4 class="card-title mb-0 fw-bold"><i class="fas fa-list-check me-2"></i>Data Cleaning Magnet Trap</h4>
                <a href="{{ route('checklistmagnettrap.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-1"></i>Tambah
                </a>
            </div>

            {{-- BAGIAN FILTER --}}
            <form method="GET" action="{{ route('checklistmagnettrap.index') }}" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="start_date" class="form-label small fw-bold">Tanggal Awal</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="form-label small fw-bold">Tanggal Akhir</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="search" class="form-label small fw-bold">Cari Nama Produk</label>
                    <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Ketik nama produk...">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
                    <a href="{{ route('checklistmagnettrap.index') }}" class="btn btn-secondary w-100"><i class="fas fa-sync-alt me-1"></i> Reset</a>
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
                        <th>Nama Produk</th>
                        <th>Kode Batch</th>
                        <th>Tanggal</th>
                        <th>Pukul</th>
                        <th class="text-center">Jml Temuan</th>
                        <th class="text-center">Status</th>
                        <th>Keterangan</th>
                        <th>Produksi</th>
                        <th>Engineer</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                    <tr>
                        <td class="text-center fw-bold">{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->kode_batch }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->pukul)->format('H:i') }}</td>
                        <td class="text-center fw-bold">{{ $item->jumlah_temuan }}</td>
                        <td class="text-center">
                            @if($item->status == 'v')
                                <span class="badge-status status-ok"><i class="fas fa-check-circle me-1"></i>OK</span>
                            @else
                                <span class="badge-status status-not-ok"><i class="fas fa-times-circle me-1"></i>NOT OK</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($item->keterangan ?? '-', 35) }}</td>
                        {{-- Tampilkan nama dari relasi, jika tidak ada tampilkan ID --}}
                        <td>{{ $item->produksi->name ?? $item->produksi_id }}</td> 
                        <td>{{ $item->engineer->name ?? $item->engineer_id }}</td>
                        <td class="text-center">
                            <form action="{{ route('checklistmagnettrap.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('checklistmagnettrap.show', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Detail"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('checklistmagnettrap.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        {{-- Sesuaikan colspan dengan jumlah kolom baru (11) --}}
                        <td colspan="11" class="text-center py-5">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Data tidak ditemukan</h5>
                            <p class="small text-muted">Coba ubah filter pencarian Anda atau tambahkan data baru.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($data->hasPages())
        <div class="card-footer bg-light">
            {!! $data->withQueryString()->links() !!}
        </div>
        @endif
    </div>
</div>
@endsection