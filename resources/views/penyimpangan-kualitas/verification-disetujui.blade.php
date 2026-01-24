@extends('layouts.app')

@section('title', 'Verifikasi Penyimpangan (Disetujui)')

@push('styles')
{{-- Style & Font Awesome dari UI/UX sebelumnya --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    :root { --primary-brand-dark: #7a1f12; --primary-brand-light: #9E3419; --accent-color-1: #E39581; --accent-color-2: #FFE5DE; --text-on-dark: #FFFFFF; --text-on-light: #2c3e50; }
    .card-custom { border: none; border-radius: 0.75rem; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); }
    .table-header-custom { background-color: var(--bs-primary, #0D6EFD); color: white; text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.85rem; }
    .table > tbody > tr > td, .table > tbody > tr > th { vertical-align: middle; }
    .table-hover > tbody > tr:hover { background-color: #f8f9fa; }
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
    <div class="card card-custom">
        <div class="card-body p-4">

            {{-- BAGIAN HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-0 fw-bold">
                    <i class="fas fa-check-double me-2"></i>Verifikasi Penyimpangan (Disetujui Oleh)
                </h4>
            </div>

            {{-- Menampilkan Notifikasi --}}
            @if ($errors->any())
                <div class="alert alert-danger mb-3"><strong>Terjadi Kesalahan Validasi:</strong><ul class="mb-0">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
            @endif
            @if (session('success'))
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mb-3">{{ session('error') }}</div>
            @endif

            {{-- BAGIAN FILTER --}}
            <form method="GET" action="{{ route('penyimpangan-kualitas.verification.disetujui') }}" class="row g-3 align-items-end mb-4">
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
                    <a href="{{ route('penyimpangan-kualitas.verification.disetujui') }}" class="btn btn-secondary w-100"><i class="fas fa-sync-alt me-1"></i> Reset</a>
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
                        <th style="width: 15%;">Nomor</th>
                        <th style="width: 20%;">Nama Produk</th>
                        <th style="width: 15%;">Lot/Kode</th>
                        <th class="text-center" style="width: 15%;">Status Diketahui</th>
                        <th class="text-center" style="width: 15%;">Status Disetujui</th>
                        <th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penyimpanganKualitasItems as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration + ($penyimpanganKualitasItems->currentPage() - 1) * $penyimpanganKualitasItems->perPage() }}</td>
                            <td>{{ $item->nomor }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>{{ $item->lot_kode }}</td>
                            <td class="text-center">
                                @if($item->status_diketahui == 1)
                                    <span class="badge-status status-verified"><i class="fas fa-check-circle me-1"></i>Verified</span>
                                @elseif($item->status_diketahui == 2)
                                    <span class="badge-status status-revision"><i class="fas fa-exclamation-circle me-1"></i>Revision</span>
                                @else
                                    <span class="badge-status status-pending"><i class="fas fa-clock me-1"></i>Pending</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->status_disetujui == 1)
                                    <span class="badge-status status-verified"><i class="fas fa-check-circle me-1"></i>Verified</span>
                                @elseif($item->status_disetujui == 2)
                                    <span class="badge-status status-revision"><i class="fas fa-exclamation-circle me-1"></i>Revision</span>
                                @else
                                    <span class="badge-status status-pending"><i class="fas fa-clock me-1"></i>Pending</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('penyimpangan-kualitas.show', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Detail" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                {{-- Hanya tampilkan tombol verifikasi jika TAHAP 1 (Diketahui) sudah 'Verified' --}}
                                @if($item->status_diketahui == 1)
                                <button type="button" class="btn btn-primary btn-sm fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#verifyModal{{ $item->id }}">
                                    <i class="bi bi-shield-check me-1"></i> 
                                    {{ $item->status_disetujui != 0 ? 'Re-Verifikasi' : 'Verifikasi' }}
                                </button>
                                @else
                                <span class="badge bg-secondary" title="Menunggu verifikasi 'Diketahui'">Blocked</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Data tidak ditemukan</h5>
                                <p class="small text-muted">Tidak ada data yang menunggu persetujuan Anda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($penyimpanganKualitasItems->hasPages())
        <div class="card-footer bg-light">
            {!! $penyimpanganKualitasItems->withQueryString()->links() !!}
        </div>
        @endif
    </div>
</div>

{{-- MODAL VERIFIKASI (TAHAP 2) --}}
@foreach ($penyimpanganKualitasItems as $item)
<div class="modal fade modal-verification" id="verifyModal{{ $item->id }}" tabindex="-1" aria-labelledby="verifyModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('penyimpangan-kualitas.verify.disetujui', $item->id) }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title fw-bolder fs-4 text-uppercase" id="verifyModalLabel{{ $item->id }}"><i class="bi bi-gear-fill me-2"></i>Verification (Disetujui)</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-light mb-4">Verifikasi data untuk: <strong>{{ $item->nomor }}</strong> (Produk: {{ $item->nama_produk }})</p>
                    <div class="mb-4">
                        <label for="status_disetujui_{{ $item->id }}" class="form-label fw-bold d-block text-center mb-2">Pilih Status Verifikasi</label>
                        <select name="status_disetujui" id="status_disetujui_{{ $item->id }}" class="form-select form-select-lg fw-bold text-center mx-auto form-select-custom" style="width: 85%;" required>
                            <option value="1" {{ old('status_disetujui', $item->status_disetujui) != 2 ? 'selected' : '' }} style="color: #198754;">✅ Verified (Disetujui)</option>
                            <option value="2" {{ old('status_disetujui', $item->status_disetujui) == 2 ? 'selected' : '' }} style="color: #dc3545;">❌ Revision (Perlu Perbaikan)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="catatan_disetujui_{{ $item->id }}" class="form-label fw-bold">Catatan Verifikasi (Wajib jika 'Revision')</label>
                        <textarea name="catatan_disetujui" id="catatan_disetujui_{{ $item->id }}" rows="4"
                            class="form-control shadow-none textarea-custom"
                            placeholder="Tuliskan catatan perbaikan...">{{ old('catatan_disetujui', $item->catatan_disetujui) }}</textarea>
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