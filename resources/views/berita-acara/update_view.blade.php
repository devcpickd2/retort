@extends('layouts.app')

@section('title', 'Update Berita Acara')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    body { background-color: #f8f9fa; }
    .form-label { font-weight: 600; color: #495057; }
    .form-control, .form-select { border-radius: 8px; }
    .card-header { border-radius: 8px 8px 0 0 !important; }

    /* Styling field Readonly/Locked */
    .form-control[readonly], .locked-input {
        background-color: #e9ecef;
        cursor: not-allowed;
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-0">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4 p-md-5">

            <h4 class="mb-1"><i class="bi bi-pencil-square"></i> Update Berita Acara</h4>
            <p class="text-muted mb-4">Lengkapi data yang masih kosong. Data yang sudah diinput sebelumnya terkunci.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form tetap submit ke route UPDATE standar --}}
            <form action="{{ route('berita-acara.update', $beritaAcara->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- CARD 1: INFORMASI UTAMA --}}
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <strong><i class="bi bi-info-circle-fill"></i> Informasi Utama</strong>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            {{-- Kolom Kiri --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nomor" class="form-label">Nomor Berita Acara <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor" id="nomor" class="form-control" 
                                           value="{{ old('nomor', $beritaAcara->nomor) }}" 
                                           {{ !empty($beritaAcara->nomor) ? 'readonly' : '' }} required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_barang" id="nama_barang" class="form-control"
                                           value="{{ old('nama_barang', $beritaAcara->nama_barang) }}" 
                                           {{ !empty($beritaAcara->nama_barang) ? 'readonly' : '' }} required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_barang" class="form-label">Jumlah Barang <span class="text-danger">*</span></label>
                                    <input type="text" name="jumlah_barang" id="jumlah_barang" class="form-control"
                                           value="{{ old('jumlah_barang', $beritaAcara->jumlah_barang) }}" 
                                           {{ !empty($beritaAcara->jumlah_barang) ? 'readonly' : '' }} required>
                                </div>
                                <div class="mb-3">
                                    <label for="supplier" class="form-label">Supplier <span class="text-danger">*</span></label>
                                    <input type="text" name="supplier" id="supplier" class="form-control"
                                           value="{{ old('supplier', $beritaAcara->supplier) }}" 
                                           {{ !empty($beritaAcara->supplier) ? 'readonly' : '' }} required>
                                </div>
                            </div>
                            
                            {{-- Kolom Kanan --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_surat_jalan" class="form-label">No Surat Jalan</label>
                                    <input type="text" name="no_surat_jalan" id="no_surat_jalan" class="form-control"
                                           value="{{ old('no_surat_jalan', $beritaAcara->no_surat_jalan) }}"
                                           {{ !empty($beritaAcara->no_surat_jalan) ? 'readonly' : '' }}>
                                </div>
                                <div class="mb-3">
                                    <label for="dd_po" class="form-label">DD / PO</label>
                                    <input type="text" name="dd_po" id="dd_po" class="form-control"
                                           value="{{ old('dd_po', $beritaAcara->dd_po) }}"
                                           {{ !empty($beritaAcara->dd_po) ? 'readonly' : '' }}>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_kedatangan" class="form-label">Tanggal Kedatangan <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_kedatangan" id="tanggal_kedatangan" class="form-control"
                                           value="{{ old('tanggal_kedatangan', $beritaAcara->tanggal_kedatangan ? $beritaAcara->tanggal_kedatangan->format('Y-m-d') : '') }}" 
                                           {{ !empty($beritaAcara->tanggal_kedatangan) ? 'readonly' : '' }} required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_keputusan" class="form-label">Tanggal Keputusan</label>
                                    <input type="date" name="tanggal_keputusan" id="tanggal_keputusan" class="form-control"
                                           value="{{ old('tanggal_keputusan', $beritaAcara->tanggal_keputusan ? $beritaAcara->tanggal_keputusan->format('Y-m-d') : '') }}"
                                           {{ !empty($beritaAcara->tanggal_keputusan) ? 'readonly' : '' }}>
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
                            <textarea name="uraian_masalah" id="uraian_masalah" class="form-control" rows="4" required
                                {{ !empty($beritaAcara->uraian_masalah) ? 'readonly' : '' }}
                            >{{ old('uraian_masalah', $beritaAcara->uraian_masalah) }}</textarea>
                        </div>
                        
                        <hr class="my-4">

                        <label class="form-label">Keputusan</label>
                        {{-- Logic Checkbox: Jika ada di DB, checked & locked. Jika tidak, boleh dicentang user --}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="keputusan_pengembalian" id="cb1" 
                                        {{ $beritaAcara->keputusan_pengembalian ? 'checked onclick=return(false);' : (old('keputusan_pengembalian') ? 'checked' : '') }}>
                                    <label class="form-check-label" for="cb1">Pengembalian Barang</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="keputusan_potongan_harga" id="cb2" 
                                        {{ $beritaAcara->keputusan_potongan_harga ? 'checked onclick=return(false);' : (old('keputusan_potongan_harga') ? 'checked' : '') }}>
                                    <label class="form-check-label" for="cb2">Potongan Harga</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="keputusan_sortir" id="cb3" 
                                        {{ $beritaAcara->keputusan_sortir ? 'checked onclick=return(false);' : (old('keputusan_sortir') ? 'checked' : '') }}>
                                    <label class="form-check-label" for="cb3">Sortir</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="keputusan_penukaran_barang" id="cb4" 
                                        {{ $beritaAcara->keputusan_penukaran_barang ? 'checked onclick=return(false);' : (old('keputusan_penukaran_barang') ? 'checked' : '') }}>
                                    <label class="form-check-label" for="cb4">Penukaran Barang</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="keputusan_penggantian_biaya" id="cb5" 
                                        {{ $beritaAcara->keputusan_penggantian_biaya ? 'checked onclick=return(false);' : (old('keputusan_penggantian_biaya') ? 'checked' : '') }}>
                                    <label class="form-check-label" for="cb5">Penggantian Biaya</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                 <label for="keputusan_lain_lain" class="form-label">Lain-lain:</label>
                                 <input type="text" class="form-control form-control-sm" name="keputusan_lain_lain" id="keputusan_lain_lain" 
                                        value="{{ old('keputusan_lain_lain', $beritaAcara->keputusan_lain_lain) }}"
                                        {{ !empty($beritaAcara->keputusan_lain_lain) ? 'readonly' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD 3: RESPON SUPPLIER (OPSIONAL) --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><i class="bi bi-person-check-fill"></i> Respon Supplier</strong>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="analisa_penyebab" class="form-label">A. Analisa Penyebab Penyimpangan</label>
                            <textarea name="analisa_penyebab" id="analisa_penyebab" class="form-control" rows="3"
                                {{ !empty($beritaAcara->analisa_penyebab) ? 'readonly' : '' }}
                            >{{ old('analisa_penyebab', $beritaAcara->analisa_penyebab) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tindak_lanjut_perbaikan" class="form-label">B. Tindak Lanjut Perbaikan dan Pencegahan</label>
                            <textarea name="tindak_lanjut_perbaikan" id="tindak_lanjut_perbaikan" class="form-control" rows="3"
                                {{ !empty($beritaAcara->tindak_lanjut_perbaikan) ? 'readonly' : '' }}
                            >{{ old('tindak_lanjut_perbaikan', $beritaAcara->tindak_lanjut_perbaikan) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- CARD 4: LAMPIRAN (OPSIONAL) --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><i class="bi bi-paperclip"></i> Lampiran</strong>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="lampiran" class="form-label">Catatan atau Link Lampiran</label>
                            <textarea name="lampiran" id="lampiran" class="form-control" rows="3"
                                {{ !empty($beritaAcara->lampiran) ? 'readonly' : '' }}
                            >{{ old('lampiran', $beritaAcara->lampiran) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-save"></i> Simpan Perubahan</button>
                    <a href="{{ route('berita-acara.index') }}" class="btn btn-secondary btn-lg"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection