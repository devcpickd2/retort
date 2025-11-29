@extends('layouts.app')

@section('title', 'Buat Pemeriksaan Kekuatan Magnet Trap')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    /* Style kustom dari CRUD sebelumnya */
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
            <h4 class="mb-1"><i class="bi bi-magnet-fill"></i> Buat Pemeriksaan Kekuatan Magnet Trap</h4>
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

            {{-- Route name diubah --}}
            <form action="{{ route('pemeriksaan-kekuatan-magnet-trap.store') }}" method="POST">
                @csrf

                {{-- CARD 1: INFORMASI UTAMA & PETUGAS --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong><i class="bi bi-info-circle-fill"></i> Informasi Utama & Petugas</strong>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                                           value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kondisi_magnet_trap" class="form-label">Kondisi Magnet Trap (Visual) <span class="text-danger">*</span></label>
                                    <input type="text" name="kondisi_magnet_trap" id="kondisi_magnet_trap" class="form-control"
                                           placeholder="Contoh: Bersih, tidak gempil"
                                           value="{{ old('kondisi_magnet_trap') }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="petugas_qc" class="form-label">Petugas QC</label>
                                    <input type="text" name="petugas_qc" id="petugas_qc" class="form-control"
                                           value="{{ old('petugas_qc') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="petugas_eng" class="form-label">Petugas ENG</label>
                                    <input type="text" name="petugas_eng" id="petugas_eng" class="form-control"
                                           value="{{ old('petugas_eng') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD 2: HASIL PENGECEKAN --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><i class="bi bi-check2-circle"></i> Hasil Pengecekan</strong>
                    </div>
                    <div class="card-body">
                        
                        <label class="form-label">Kekuatan Medan Magnet (Gauss)</label>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="kekuatan_median_1" class="form-label small">Magnet 1</label>
                                <input type="number" step="0.01" name="kekuatan_median_1" id="kekuatan_median_1" class="form-control" 
                                       placeholder="Contoh: 9000.50" value="{{ old('kekuatan_median_1') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="kekuatan_median_2" class="form-label small">Magnet 2</label>
                                <input type="number" step="0.01" name="kekuatan_median_2" id="kekuatan_median_2" class="form-control" 
                                       placeholder="Contoh: 8500.00" value="{{ old('kekuatan_median_2') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="kekuatan_median_3" class="form-label small">Magnet 3</label>
                                <input type="number" step="0.01" name="kekuatan_median_3" id="kekuatan_median_3" class="form-control" 
                                       placeholder="Contoh: 8800.75" value="{{ old('kekuatan_median_3') }}">
                            </div>
                        </div>
                        
                        <hr class="my-4">

                        <label class="form-label">Parameter Setingan <span class="text-danger">*</span></label>
                        <div class="card p-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="parameter_sesuai" id="param_sesuai" value="1" {{ old('parameter_sesuai', '1') == '1' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="param_sesuai">
                                    Sesuai (√)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="parameter_sesuai" id="param_tidak_sesuai" value="0" {{ old('parameter_sesuai') == '0' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="param_tidak_sesuai">
                                    Tidak Sesuai (X)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD 3: KETERANGAN (OPSIONAL) --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><i class="bi bi-paperclip"></i> Keterangan (Opsional)</strong>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Catatan Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-save"></i> Simpan Data</button>
                    {{-- Route name diubah --}}
                    <a href="{{ route('pemeriksaan-kekuatan-magnet-trap.index') }}" class="btn btn-secondary btn-lg"><i class="bi bi-arrow-left"></i> Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection