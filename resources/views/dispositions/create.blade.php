@extends('layouts.app')

@section('title', 'Tambah Disposisi Baru')

@push('styles')
{{-- Menambahkan link untuk Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
{{-- 
  Meskipun form ini tidak menggunakan Select2, kita tetapSertakan
  style kustom dari contoh Anda agar tampilan input dan radius tombol
  sesuai dengan desain.
--}}
<style>
    /* Mengubah font utama untuk tampilan yang lebih modern */
    body {
        background-color: #f8f9fa;
    }
    /* Kustomisasi label */
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    /* Kustomisasi input, select, dan textarea */
    .form-control, .form-select {
        border-radius: 8px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-0">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4 p-md-5">

            {{-- Header Baru --}}
            <h4 class="mb-1"><i class="bi bi-file-earmark-plus"></i> Tambah Disposisi Baru</h4>
            <p class="text-muted mb-4">Isi detail formulir disposisi di bawah ini.</p>

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

            <form action="{{ route('dispositions.store') }}" method="POST">
                @csrf

                {{-- CARD INFORMASI UTAMA & TIPE DISPOSISI --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong><i class="bi bi-info-circle-fill"></i> Informasi Utama & Tipe Disposisi</strong>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            {{-- Kolom Kiri --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nomor" class="form-label">Nomor <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor" id="nomor" class="form-control" 
                                           value="{{ old('nomor', $disposition->nomor) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" 
                                           value="{{ old('tanggal', $disposition->tanggal ? \Carbon\Carbon::parse($disposition->tanggal)->format('Y-m-d') : date('Y-m-d')) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kepada" class="form-label">Kepada <span class="text-danger">*</span></label>
                                    <input type="text" name="kepada" id="kepada" class="form-control" 
                                           value="{{ old('kepada', $disposition->kepada) }}" required>
                                </div>
                            </div>
                            
                            {{-- Kolom Kanan (Checkboxes) --}}
                            <div class="col-md-6">
                                <label class="form-label mb-2">Tipe Disposisi</label>
                                <div class="card p-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="disposisi_produk" id="disposisi_produk" 
                                               value="1" {{ old('disposisi_produk', $disposition->disposisi_produk) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="disposisi_produk">Produk</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="disposisi_material" id="disposisi_material" 
                                               value="1" {{ old('disposisi_material', $disposition->disposisi_material) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="disposisi_material">Material</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="disposisi_prosedur" id="disposisi_prosedur" 
                                               value="1" {{ old('disposisi_prosedur', $disposition->disposisi_prosedur) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="disposisi_prosedur">Prosedur</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD DETAIL DISPOSISI (TEXTAREA) --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><i class="bi bi-card-text"></i> Detail Disposisi</strong>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="dasar_disposisi" class="form-label">Dasar Disposisi <span class="text-danger">*</span></label>
                                    <textarea name="dasar_disposisi" id="dasar_disposisi" class="form-control" rows="4" required>{{ old('dasar_disposisi', $disposition->dasar_disposisi) }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="uraian_disposisi" class="form-label">Uraian Disposisi <span class="text-danger">*</span></label>
                                    <textarea name="uraian_disposisi" id="uraian_disposisi" class="form-control" rows="6" required>{{ old('uraian_disposisi', $disposition->uraian_disposisi) }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea name="catatan" id="catatan" class="form-control" rows="3">{{ old('catatan', $disposition->catatan) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi (Gaya Baru) --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-save"></i> Simpan Data</button>
                    <a href="{{ route('dispositions.index') }}" class="btn btn-secondary btn-lg"><i class="bi bi-arrow-left"></i> Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection