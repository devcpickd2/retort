{{-- 
File ini adalah untuk 'packaging-inspections'.
(dibuat di resources/views/packaging/verification.blade.php)
--}}

@extends('layouts.app')

@push('styles')
    {{-- Menggunakan style yang sama dari contoh MagnetTrap/RawMaterial Anda --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-brand-dark: #7a1f12;
            --primary-brand-light: #9E3419;
            --accent-color-1: #E39581;
            --accent-color-2: #FFE5DE;
            --text-on-dark: #FFFFFF;
            --text-on-light: #2c3e50;
        }
        body { background-color: #f8f9fa; }
        .card.shadow-sm { border: none; border-radius: 0.75rem; }
        .table > tbody > tr > td { vertical-align: middle; font-size: 0.9rem; }
        .badge-status { padding: 0.5em 0.75em; font-size: 0.75rem; font-weight: 600; border-radius: 50rem; }
        .status-pending { background-color: rgba(108, 117, 125, 0.1); color: #6c757d; }
        .status-verified { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
        .status-revision { background-color: rgba(220, 53, 69, 0.1); color: #DC3545; }
        .modal-verification .modal-content { border: none; border-radius: 1rem; background: linear-gradient(145deg, var(--primary-brand-dark), var(--primary-brand-light)); box-shadow: 0 15px 40px rgba(0,0,0,0.5); color: var(--text-on-dark); overflow: hidden; }
        .modal-verification .modal-header { border-bottom: 2px solid rgba(255, 255, 255, 0.2); padding: 1.5rem; }
        .modal-verification .modal-body { padding: 2rem; }
        .modal-verification .modal-footer { background-color: var(--primary-brand-light); border-top: 1px solid rgba(255, 255, 255, 0.2); padding: 1rem 1.5rem; }
        .modal-verification .form-select-custom { background: linear-gradient(135deg, #fff1f0, var(--accent-color-2)); border: 2px solid #dc3545; border-radius: 12px; color: #7a1f12; font-size: 1.1rem; box-shadow: 0 6px 12px rgba(0,0,0,0.1); transition: all 0.3s ease; }
        .modal-verification .textarea-custom { background-color: var(--accent-color-2); color: var(--text-on-light); border: none; border-radius: 0.5rem; height: 120px; }
    </style>
@endpush


@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <strong>Terjadi Kesalahan Validasi:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- 2. Untuk menampilkan pesan 'success' dari controller --}}
            @if (session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- 3. Untuk menampilkan pesan 'error' dari try...catch --}}
            @if (session('error'))
                <div class="alert alert-danger mb-3">
                    {{ session('error') }}
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- JUDUL DIUBAH --}}
                <h3 class="card-title mb-0 fw-bold"><i class="bi bi-shield-check me-2"></i>Verifikasi Pemeriksaan Packaging</h3>
            </div>

            {{-- FORM FILTER DIARAHKAN KE ROUTE BARU --}}
            <form method="GET" action="{{ route('packaging-inspections.verification') }}" class="row g-3 mb-4">
                <div class="col-md-3">
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" title="Tanggal Awal">
                </div>
                <div class="col-md-3">
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" title="Tanggal Akhir">
                </div>
                <div class="col-md-3">
                    {{-- PLACEHOLDER DIUBAH --}}
                    <input type="text" name="search" class="form-control" placeholder="Cari Nopol/Supplier/Jenis..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    {{-- LINK RESET DIUBAH --}}
                    <a href="{{ route('packaging-inspections.verification') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                </div>
            </form>

        </div>
        <hr class="my-0">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        {{-- HEADER TABEL DISESUAIKAN --}}
                        <th>No</th>
                        <th>Tgl Inspeksi</th>
                        <th>Shift</th>
                        <th>Supplier / Jenis Pkg. (Item 1)</th>
                        <th>Nopol (Item 1)</th>
                        <th>Status SPV</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- LOOPING MENGGUNAKAN '$data' --}}
                    @forelse ($data as $inspection)
                    <tr>
                        <td class="text-center fw-bold">{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                        
                        {{-- DATA DISESUAIKAN DENGAN KOLOM PACKAGING --}}
                        <td class="text-center">{{ $inspection->inspection_date->format('d M Y') }}</td>
                        <td class="text-center">{{ $inspection->shift }}</td>
                        
                        {{-- Menampilkan data item pertama sebagai ringkasan --}}
                        <td>
                            @if($inspection->items->isNotEmpty())
                                {{ $inspection->items->first()->supplier }} / 
                                {{ $inspection->items->first()->packaging_type }}
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($inspection->items->isNotEmpty())
                                {{ $inspection->items->first()->no_pol }}
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        
                        {{-- LOGIKA STATUS (SAMA) --}}
                        <td class="text-center">
                            @if($inspection->status_spv == 1)
                                <span class="badge-status status-verified"><i class="fas fa-check-circle me-1"></i>Verified</span>
                            @elseif($inspection->status_spv == 2)
                                <span class="badge-status status-revision"><i class="fas fa-exclamation-circle me-1"></i>Revision</span>
                            @else
                                <span class="badge-status status-pending"><i class="fas fa-clock me-1"></i>Pending</span>
                            @endif
                        </td>
                        
                        {{-- TOMBOL AKSI (ROUTE DISESUAIKAN) --}}
                        <td class="text-center">
                            <a href="{{ route('packaging-inspections.show', $inspection->uuid) }}" class="btn btn-sm btn-outline-primary" title="Detail"><i class="fas fa-eye"></i></a>
                            <button type="button" class="btn btn-primary btn-sm fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#verifyModal{{ $inspection->uuid }}">
                                <i class="bi bi-shield-check me-1"></i> Verifikasi
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-5"><h5 class="text-muted">Tidak ada data ditemukan.</h5></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($data->hasPages())
        {{-- PAGINATION (SAMA) --}}
        <div class="card-footer bg-light">{!! $data->links() !!}</div>
        @endif
    </div>
</div>

{{-- MODAL (HANYA MENGUBAH ACTION ROUTE) --}}
@foreach ($data as $inspection)
<div class="modal fade modal-verification" id="verifyModal{{ $inspection->uuid }}" tabindex="-1" aria-labelledby="verifyModalLabel{{ $inspection->uuid }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            {{-- ACTION ROUTE DIUBAH --}}
            <form action="{{ route('packaging-inspections.verify', $inspection->uuid) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bolder fs-4 text-uppercase" id="verifyModalLabel{{ $inspection->uuid }}"><i class="bi bi-gear-fill me-2"></i>Verification</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-light mb-4">Pastikan data yang akan diverifikasi di-check dengan teliti terlebih dahulu.</p>

                    <div class="mb-4">
                        <label for="status_spv_{{ $inspection->uuid }}" class="form-label fw-bold d-block text-center mb-2">Pilih Status Verifikasi</label>
                        <select name="status_spv" id="status_spv_{{ $inspection->uuid }}" class="form-select form-select-lg fw-bold text-center mx-auto form-select-custom" style="width: 85%;" required>
                             {{-- Menggunakan $inspection->status_spv untuk nilai default --}}
                            <option value="1" {{ old('status_spv', $inspection->status_spv) != 2 ? 'selected' : '' }} style="color: #198754;">✅ Verified (Disetujui)</option>
                            <option value="2" {{ old('status_spv', $inspection->status_spv) == 2 ? 'selected' : '' }} style="color: #dc3545;">❌ Revision (Perlu Perbaikan)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="catatan_spv_{{ $inspection->uuid }}" class="form-label fw-bold">Catatan Verifikasi (Wajib jika 'Revision')</label>
                        <textarea name="catatan_spv" id="catatan_spv_{{ $inspection->uuid }}" rows="4"
                            class="form-control shadow-none textarea-custom"
                            placeholder="Tuliskan catatan perbaikan...">{{ old('catatan_spv', $inspection->catatan_spv) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-outline-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn rounded-pill px-5 fw-bolder" style="background-color: var(--accent-color-1); color: var(--text-on-light);"><i class="bi bi-save-fill me-1"></i> SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

