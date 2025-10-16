{{-- Menggunakan layout utama --}}
@extends('layouts.app')

{{-- Mendefinisikan bagian style kustom --}}
@push('styles')
<style>
    /* Mengubah font utama untuk tampilan yang lebih modern */
    body {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
    }

    /* Kustomisasi container form utama */
    .form-container {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        margin-top: 2rem;
        margin-bottom: 2rem;
    }

    /* Judul form */
    .form-title {
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-subtitle {
        color: #6c757d;
        margin-bottom: 2rem;
    }

    /* Kustomisasi grup form */
    .form-group {
        margin-bottom: 1.5rem;
    }

    /* Kustomisasi label */
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block; /* PERBAIKAN: Memastikan label selalu berada di atas input */
    }

    /* Kustomisasi input, select, dan textarea */
    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid #ced4da;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Bagian paling penting: Kustomisasi Radio Button menjadi Rounded Rectangle */
    .status-selector {
        display: flex;
        gap: 1rem;
    }
    .status-selector input[type="radio"] {
        /* Sembunyikan radio button asli */
        opacity: 0;
        position: fixed;
        width: 0;
    }
    .status-selector label {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 0.75rem;
        background-color: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    /* Style ketika radio button terpilih */
    .status-selector input[type="radio"]:checked + label {
        color: #fff;
        border-color: transparent;
    }
    /* Warna spesifik untuk status OK (v) */
    .status-selector input#status_v:checked + label {
        background-color: #28a745; /* Hijau */
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }
    /* Warna spesifik untuk status NOT OK (x) */
    .status-selector input#status_x:checked + label {
        background-color: #dc3545; /* Merah */
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    /* Hover effect */
    .status-selector label:hover {
        background-color: #e9ecef;
        border-color: #ced4da;
    }

    /* Kustomisasi tombol */
    .btn-submit {
        background-color: #007bff;
        border: none;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        border-radius: 8px;
        transition: background-color 0.2s ease, transform 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-submit:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
    .btn-cancel {
        font-weight: 600;
        color: #6c757d;
        border: none;
        background: transparent;
    }
    .btn-cancel:hover {
        color: #343a40;
    }
    .form-actions {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 1rem;
        margin-top: 2rem;
    }
</style>
@endpush

{{-- Mendefinisikan bagian konten --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-container">
                <h1 class="form-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15.5 2H8.6c-.4 0-.8.2-1.1.5-.3.3-.5.7-.5 1.1v12.8c0 .4.2.8.5 1.1.3.3.7.5 1.1.5h9.8c.4 0 .8-.2 1.1-.5.3-.3.5-.7.5-1.1V6.5L15.5 2z"></path><path d="M3 7.6v12.8c0 .4.2.8.5 1.1.3.3.7.5 1.1.5h9.8"></path><path d="M15 2v5h5"></path></svg>
                    Form Input Temuan
                </h1>
                <p class="form-subtitle">Isi detail temuan pada formulir di bawah ini.</p>

                <form method="POST" action="{{ route('checklistmagnettrap.store') }}">
                    @csrf

                    {{-- PERBAIKAN: Input Nama Produk dan Kode Batch dibuat full-width untuk mencegah overflow --}}
                    <div class="form-group">
                        <label for="nama_produk" class="form-label">{{ __('Nama Produk') }}</label>
                        <select class="form-select @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" required>
                            <option selected disabled value="">Pilih Produk...</option>
                            @foreach($produks as $produk)
                                <option value="{{ $produk->nama_produk }}" {{ old('nama_produk') == $produk->nama_produk ? 'selected' : '' }}>{{ $produk->nama_produk }}</option>
                            @endforeach
                        </select>
                        @error('nama_produk')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kode_batch" class="form-label">{{ __('Kode Batch') }}</label>
                        <input id="kode_batch" type="text" class="form-control @error('kode_batch') is-invalid @enderror" name="kode_batch" value="{{ old('kode_batch') }}" required autocomplete="kode_batch" placeholder="Sesuai data mincing">
                        @error('kode_batch')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Baris untuk Pukul dan Jumlah Temuan --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pukul" class="form-label">{{ __('Pukul') }}</label>
                                <input id="pukul" type="time" class="form-control @error('pukul') is-invalid @enderror" name="pukul" value="{{ old('pukul') }}" required>
                                @error('pukul')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah_temuan" class="form-label">{{ __('Jumlah Temuan') }}</label>
                                <input id="jumlah_temuan" type="number" class="form-control @error('jumlah_temuan') is-invalid @enderror" name="jumlah_temuan" value="{{ old('jumlah_temuan') }}" required placeholder="Contoh: 0">
                                @error('jumlah_temuan')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    {{-- Input Status (Radio Button yang sudah di-style) --}}
                    <div class="form-group">
                        <label class="form-label">{{ __('Status') }}</label>
                        <div class="status-selector">
                            <input class="form-check-input" type="radio" name="status" id="status_v" value="v" {{ old('status', 'v') == 'v' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_v">✓ OK</label>
                            
                            <input class="form-check-input" type="radio" name="status" id="status_x" value="x" {{ old('status') == 'x' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_x">✗ NOT OK</label>
                        </div>
                    </div>

                    {{-- Input Keterangan --}}
                    <div class="form-group">
                        <label for="keterangan" class="form-label">{{ __('Keterangan') }}</label>
                        <textarea id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3" placeholder="Tambahkan catatan jika diperlukan...">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Baris untuk Dropdown Produksi dan Engineer --}}
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="produksi" class="form-label">{{ __('Operator Produksi') }}</label>
                                <select class="form-select @error('produksi_id') is-invalid @enderror" id="produksi" name="produksi_id" required>
                                    <option selected disabled value="">Pilih Operator...</option>
                                    {{-- Asumsi $operators adalah collection --}}
                                    {{-- @foreach($operators as $operator)
                                        <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                                    @endforeach --}}
                                    <option value="1" {{ old('produksi_id') == 1 ? 'selected' : '' }}>Operator 1</option>
                                    <option value="2" {{ old('produksi_id') == 2 ? 'selected' : '' }}>Operator 2</option>
                                </select>
                                @error('produksi_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="engineer" class="form-label">{{ __('Engineer') }}</label>
                                <select class="form-select @error('engineer_id') is-invalid @enderror" id="engineer" name="engineer_id" required>
                                    <option selected disabled value="">Pilih Engineer...</option>
                                    {{-- Asumsi $engineers adalah collection --}}
                                    {{-- @foreach($engineers as $engineer)
                                        <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                                    @endforeach --}}
                                    <option value="1" {{ old('engineer_id') == 1 ? 'selected' : '' }}>Engineer A</option>
                                    <option value="2" {{ old('engineer_id') == 2 ? 'selected' : '' }}>Engineer B</option>
                                </select>
                                @error('engineer_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                            {{ __('Simpan Data') }}
                        </button>
                        <a href="{{ route('checklistmagnettrap.index') }}" class="btn btn-cancel">{{ __('Batal') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

