{{-- resources/views/raw_material/IndexRawMaterial.blade.php --}}
{{-- (Atau ganti nama file sesuai kebutuhan Anda) --}}

@extends('layouts.app') {{-- Menggunakan layout utama Anda --}}

{{-- Menambahkan style khusus untuk halaman ini --}}
@push('styles')
<style>
    .card-custom {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .table-header-custom {
        background-color: #0D6EFD; /* Warna Biru Primary (konsisten dengan form) */
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
                <h4 class="card-title mb-0 fw-bold"><i class="fas fa-box-seam me-2"></i>Data Pemeriksaan Bahan Baku</h4>
                <a href="{{ route('inspections.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-1"></i>Tambah
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- BAGIAN FILTER --}}
            <form method="GET" action="{{ route('inspections.index') }}" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="start_date" class="form-label small fw-bold">Tanggal Awal</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="form-label small fw-bold">Tanggal Akhir</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="search" class="form-label small fw-bold">Cari (Bahan Baku / Supplier)</label>
                    <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Ketik bahan baku atau supplier...">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
                    <a href="{{ route('inspections.index') }}" class="btn btn-secondary w-100"><i class="fas fa-sync-alt me-1"></i> Reset</a>
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
                        <th>Tgl Datang</th>
                        <th>Bahan Baku</th>
                        <th>Supplier</th>
                        <th>No. DO / PO</th>
                        <th>Nopol Mobil</th>
                        <!-- <th class="text-center">Status</th> -->
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inspections as $item)
                    <tr>
                        <td class="text-center fw-bold">{{ $loop->iteration + ($inspections->currentPage() - 1) * $inspections->perPage() }}</td>
                        <td>{{ $item->setup_kedatangan ? \Carbon\Carbon::parse($item->setup_kedatangan)->format('d M Y H:i') : '-' }}</td>
                        <td>{{ $item->bahan_baku }}</td>
                        <td>{{ Str::limit($item->supplier, 20) }}</td>
                        <td>{{ $item->do_po }}</td>
                        <td>{{ $item->nopol_mobil }}</td>
                        
                        <!-- {{-- Logika Status Otomatis --}}
                        @php
                            $isOk = $item->mobil_check_warna && 
                                    $item->mobil_check_kotoran &&
                                    $item->mobil_check_aroma &&
                                    $item->mobil_check_kemasan &&
                                    $item->analisa_ka_ffa &&
                                    $item->analisa_logo_halal &&
                                    $item->dokumen_halal_berlaku;
                        @endphp
                        <td class="text-center">
                            @if($isOk)
                                <span class="badge-status status-ok"><i class="fas fa-check-circle me-1"></i>OK</span>
                            @else
                                <span class="badge-status status-not-ok"><i class="fas fa-times-circle me-1"></i>NOT OK</span>
                            @endif
                        </td> -->
                        
                        <td class="text-center">
                            {{-- Menggunakan UUID untuk konsistensi --}}
                            <form action="{{ route('inspections.destroy', $item->uuid) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <div class="btn-group" role="group">
                                    {{-- Tombol Detail / Show --}}
                                    <a href="{{ route('inspections.show', $item->uuid) }}" class="btn btn-sm btn-outline-primary" title="Detail"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('inspections.edit', $item->uuid) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
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

        @if ($inspections->hasPages())
        <div class="card-footer bg-light">
            {{-- Menambahkan withQueryString agar filter tetap ada saat ganti halaman --}}
            {!! $inspections->withQueryString()->links() !!}
        </div>
        @endif
    </div>
</div>
@endsection