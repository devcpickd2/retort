@extends('layouts.app')

@section('title', 'Buat Berita Acara Baru')

@push('styles')
{{-- Menambahkan link untuk Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

{{-- Style kustom dari contoh Anda untuk tampilan modern --}}
<style>
    body {
        background-color: #f8f9fa;
    }
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    .form-control, .form-select {
        border-radius: 8px;
    }
    .card-header {
        border-radius: 8px 8px 0 0 !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-0">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4 p-md-5">

            {{-- Header --}}
            <h4 class="mb-1"><i class="bi bi-file-earmark-plus-fill"></i> Buat Berita Acara Baru</h4>
            <p class="text-muted mb-4">Isi semua detail yang diperlukan di bawah ini.</p>

            {{-- Tampilkan error jika ada --}}
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Terjadi Kesalahan!</h4>
                <p>Silakan periksa kembali input Anda:</p>
                <hr>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('berita-acara.store') }}" method="POST">
                @csrf

                {{-- CARD 1: INFORMASI UTAMA --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong><i class="bi bi-info-circle-fill"></i> Informasi Utama</strong>
                    </div>
                    <div class="card-body">
                        <div class="row g-3"> 
                            {{-- Kolom Kiri --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nomor" class="form-label">Nomor Berita Acara <span class="text-danger">*</span></label>
                                    <input type="text" 
                                    name="nomor" 
                                    id="nomor"
                                    class="form-control @error('nomor') is-invalid @enderror"
                                    value="{{ old('nomor') }}" 
                                    required>

                                    @error('nomor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_barang" id="nama_barang" class="form-control"
                                    value="{{ old('nama_barang') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_barang" class="form-label">Jumlah Barang (pcs) <span class="text-danger">*</span></label>
                                    <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control"
                                    value="{{ old('jumlah_barang') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="supplier" class="form-label">Supplier <span class="text-danger">*</span></label>
                                    <input type="text" name="supplier" id="supplier" class="form-control"
                                    value="{{ old('supplier') }}" required>
                                </div>
                            </div>
                            
                            {{-- Kolom Kanan --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_surat_jalan" class="form-label">No Surat Jalan</label>
                                    <input type="text" name="no_surat_jalan" id="no_surat_jalan" class="form-control"
                                    value="{{ old('no_surat_jalan') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="dd_po" class="form-label">DD / PO</label>
                                    <input type="text" name="dd_po" id="dd_po" class="form-control"
                                    value="{{ old('dd_po') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_kedatangan" class="form-label">Tanggal Kedatangan <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_kedatangan" id="tanggal_kedatangan" class="form-control"
                                    value="{{ old('tanggal_kedatangan', date('Y-m-d')) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_keputusan" class="form-label">Tanggal Keputusan</label>
                                    <input type="date" name="tanggal_keputusan" id="tanggal_keputusan" class="form-control"
                                    value="{{ old('tanggal_keputusan') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD 2: DETAIL MASALAH & KEPUTUSAN --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><i class="bi bi-card-text"></i> Detail Masalah & Keputusan</strong>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="uraian_masalah" class="form-label">Uraian Masalah <span class="text-danger">*</span></label>
                            <textarea name="uraian_masalah" id="uraian_masalah" class="form-control" rows="4" required>{{ old('uraian_masalah') }}</textarea>
                        </div>
                        
                        <hr class="my-4">

                        <label class="form-label">Keputusan</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="keputusan_pengembalian" id="cb1" {{ old('keputusan_pengembalian') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cb1">Pengembalian Barang</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="keputusan_potongan_harga" id="cb2" {{ old('keputusan_potongan_harga') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cb2">Potongan Harga</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="keputusan_sortir" id="cb3" {{ old('keputusan_sortir') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cb3">Sortir</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="keputusan_penukaran_barang" id="cb4" {{ old('keputusan_penukaran_barang') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cb4">Penukaran Barang</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="keputusan_penggantian_biaya" id="cb5" {{ old('keputusan_penggantian_biaya') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cb5">Penggantian Biaya</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                             <label for="keputusan_lain_lain" class="form-label">Lain-lain:</label>
                             <input type="text" class="form-control form-control-sm" name="keputusan_lain_lain" id="keputusan_lain_lain" 
                             value="{{ old('keputusan_lain_lain') }}">
                         </div>
                     </div>
                 </div>
             </div>

             {{-- CARD 3: RESPON SUPPLIER (OPSIONAL) --}}
             <div class="card mb-4">
                <div class="card-header">
                    <strong><i class="bi bi-person-check-fill"></i> Respon Supplier (Opsional)</strong>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="analisa_penyebab" class="form-label">A. Analisa Penyebab Penyimpangan</label>
                        <textarea name="analisa_penyebab" id="analisa_penyebab" class="form-control" rows="3">{{ old('analisa_penyebab') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tindak_lanjut_perbaikan" class="form-label">B. Tindak Lanjut Perbaikan dan Pencegahan</label>
                        <textarea name="tindak_lanjut_perbaikan" id="tindak_lanjut_perbaikan" class="form-control" rows="3">{{ old('tindak_lanjut_perbaikan') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- CARD 4: LAMPIRAN (OPSIONAL) --}}
            <div class="card mb-4">
                <div class="card-header">
                    <strong><i class="bi bi-paperclip"></i> Lampiran (Opsional)</strong>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="lampiran" class="form-label">Catatan atau Link Lampiran</label>
                        <textarea name="lampiran" id="lampiran" class="form-control" rows="3">{{ old('lampiran') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-save"></i> Simpan Data</button>
                <a href="{{ route('berita-acara.index') }}" class="btn btn-secondary btn-lg"><i class="bi bi-arrow-left"></i> Batal</a>
            </div>

        </form>
    </div>
</div>
</div>
@endsection