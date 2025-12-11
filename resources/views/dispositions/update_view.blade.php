@extends('layouts.app')

@section('title', 'Update Disposisi')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    body { background-color: #f8f9fa; }
    .form-label { font-weight: 600; color: #495057; }
    .form-control, .form-select { border-radius: 8px; }
    
    /* Styling khusus untuk field yang Readonly/Sudah diisi */
    .form-control[readonly], .locked-input {
        background-color: #e9ecef; /* Abu-abu seperti disabled */
        cursor: not-allowed;
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-0">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4 p-md-5">

            <h4 class="mb-1"><i class="bi bi-pencil-square"></i> Update Kelengkapan Disposisi</h4>
            <p class="text-muted mb-4">Lengkapi data yang masih kosong. Data yang sudah diinput tidak dapat diubah.</p>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form tetap mengarah ke route UPDATE standar --}}
            <form action="{{ route('dispositions.update', $disposition->uuid) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- CARD INFORMASI UTAMA --}}
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <strong><i class="bi bi-info-circle-fill"></i> Informasi Utama</strong>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            {{-- Kolom Kiri --}}
                            <div class="col-md-6">
                                {{-- NOMOR --}}
                                <div class="mb-3">
                                    <label for="nomor" class="form-label">Nomor <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor" id="nomor" 
                                           class="form-control" 
                                           value="{{ old('nomor', $disposition->nomor) }}" 
                                           {{ !empty($disposition->nomor) ? 'readonly' : '' }} required>
                                </div>

                                {{-- TANGGAL --}}
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal" id="tanggal" 
                                           class="form-control" 
                                           value="{{ old('tanggal', $disposition->tanggal ? \Carbon\Carbon::parse($disposition->tanggal)->format('Y-m-d') : '') }}" 
                                           {{ !empty($disposition->tanggal) ? 'readonly' : '' }} required>
                                </div>

                                {{-- KEPADA --}}
                                <div class="mb-3">
                                    <label for="kepada" class="form-label">Kepada <span class="text-danger">*</span></label>
                                    <input type="text" name="kepada" id="kepada" 
                                           class="form-control" 
                                           value="{{ old('kepada', $disposition->kepada) }}" 
                                           {{ !empty($disposition->kepada) ? 'readonly' : '' }} required>
                                </div>
                            </div>
                            
                            {{-- Kolom Kanan (Checkboxes) --}}
                            <div class="col-md-6">
                                <label class="form-label mb-2">Tipe Disposisi</label>
                                <div class="card p-3">
                                    {{-- 
                                        LOGIKA CHECKBOX:
                                        Jika di database nilainya 1 (true), kita beri onclick="return false" 
                                        agar user melihatnya tercentang tapi tidak bisa mengubahnya.
                                    --}}

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="disposisi_produk" id="disposisi_produk" value="1" 
                                            {{ old('disposisi_produk', $disposition->disposisi_produk) ? 'checked' : '' }}
                                            {{ $disposition->disposisi_produk ? 'onclick=return(false);' : '' }}>
                                        <label class="form-check-label" for="disposisi_produk">Produk</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="disposisi_material" id="disposisi_material" value="1" 
                                            {{ old('disposisi_material', $disposition->disposisi_material) ? 'checked' : '' }}
                                            {{ $disposition->disposisi_material ? 'onclick=return(false);' : '' }}>
                                        <label class="form-check-label" for="disposisi_material">Material</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="disposisi_prosedur" id="disposisi_prosedur" value="1" 
                                            {{ old('disposisi_prosedur', $disposition->disposisi_prosedur) ? 'checked' : '' }}
                                            {{ $disposition->disposisi_prosedur ? 'onclick=return(false);' : '' }}>
                                        <label class="form-check-label" for="disposisi_prosedur">Prosedur</label>
                                    </div>
                                    
                                    @if($disposition->disposisi_produk || $disposition->disposisi_material || $disposition->disposisi_prosedur)
                                        <small class="text-muted mt-2 d-block">* Tipe yang sudah dicentang terkunci.</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD DETAIL DISPOSISI --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><i class="bi bi-card-text"></i> Detail Disposisi</strong>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                {{-- DASAR DISPOSISI --}}
                                <div class="mb-3">
                                    <label for="dasar_disposisi" class="form-label">Dasar Disposisi <span class="text-danger">*</span></label>
                                    <textarea name="dasar_disposisi" id="dasar_disposisi" rows="4" required
                                        class="form-control"
                                        {{ !empty($disposition->dasar_disposisi) ? 'readonly' : '' }}
                                    >{{ old('dasar_disposisi', $disposition->dasar_disposisi) }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                {{-- URAIAN DISPOSISI --}}
                                <div class="mb-3">
                                    <label for="uraian_disposisi" class="form-label">Uraian Disposisi <span class="text-danger">*</span></label>
                                    <textarea name="uraian_disposisi" id="uraian_disposisi" rows="6" required
                                        class="form-control"
                                        {{ !empty($disposition->uraian_disposisi) ? 'readonly' : '' }}
                                    >{{ old('uraian_disposisi', $disposition->uraian_disposisi) }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                {{-- CATATAN --}}
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea name="catatan" id="catatan" rows="3"
                                        class="form-control"
                                        {{ !empty($disposition->catatan) ? 'readonly' : '' }}
                                    >{{ old('catatan', $disposition->catatan) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-save"></i> Simpan Perubahan</button>
                    <a href="{{ route('dispositions.index') }}" class="btn btn-secondary btn-lg"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection