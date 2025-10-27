{{-- resources/views/raw_material/EditRawMaterial.blade.php --}}

@extends('layouts.app') {{-- Menggunakan layout utama Anda --}}

{{-- Mendefinisikan bagian style kustom --}}
@push('styles')
{{-- Menambahkan link untuk Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
{{-- 1. Include Select2 CSS --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{-- Optional: Theme for Select2 to match Bootstrap 5 --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<style>
    /* Mengubah font utama untuk tampilan yang lebih modern */
    body {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
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
    
    /* Ensure Select2 takes full width and height */
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px); /* Match Bootstrap's input height */
        padding: .375rem .75rem; /* Match padding */
        border: 1px solid #ced4da; /* Match border */
    }
    .select2-container--bootstrap-5 .select2-selection {
        border-radius: 8px !important;
    }
    .select2-container--bootstrap-5.select2-container--focus .select2-selection,
    .select2-container--bootstrap-5.select2-container--open .select2-selection {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    /* Style untuk tombol OK/Not OK dari file asli (disesuaikan sedikit) */
    .btn-check-group .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
    }
    .btn-check-group .btn-outline-success,
    .btn-check-group .btn-outline-danger {
        font-weight: 600;
    }

    /* Style untuk item produk dinamis */
    .product-detail-item {
        background-color: #fdfdfd;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
</style>
@endpush

{{-- Mendefinisikan bagian konten --}}
@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4 p-md-5">

            {{-- PERUBAHAN: Judul --}}
            <h4 class="mb-1"><i class="bi bi-pencil-square"></i> Edit Pemeriksaan Bahan Baku</h4>
            <p class="text-muted mb-4">Perbarui detail formulir pemeriksaan bahan baku di bawah ini.</p>

            {{-- Tampilkan error jika ada --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops! Ada beberapa masalah dengan input Anda:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- PERUBAHAN: Form action ke 'update', method 'PUT' --}}
            <form action="{{ route('inspections.update', $inspection->uuid) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- CARD INFORMASI UMUM --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong><i class="bi bi-info-circle-fill"></i> Informasi Umum</strong>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="setup_kedatangan" class="form-label">Waktu Kedatangan</label>
                                {{-- PERUBAHAN: Isi value dengan data lama (format datetime-local) --}}
                                <input type="datetime-local" class="form-control @error('setup_kedatangan') is-invalid @enderror" id="setup_kedatangan" name="setup_kedatangan" value="{{ old('setup_kedatangan', $inspection->setup_kedatangan ? $inspection->setup_kedatangan->format('Y-m-d\TH:i') : '') }}" required>
                                @error('setup_kedatangan') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="bahan_baku" class="form-label">Bahan Baku</label>
                                <select class="form-select select2 @error('bahan_baku') is-invalid @enderror" id="bahan_baku" name="bahan_baku" required>
                                    <option></option> {{-- Placeholder untuk Select2 --}}
                                    {{-- PERUBAHAN: Cek 'old' atau data $inspection --}}
                                    <option value="Daging Ayam" {{ old('bahan_baku', $inspection->bahan_baku) == 'Daging Ayam' ? 'selected' : '' }}>Daging Ayam</option>
                                    <option value="Tepung Tapioka" {{ old('bahan_baku', $inspection->bahan_baku) == 'Tepung Tapioka' ? 'selected' : '' }}>Tepung Tapioka</option>
                                    <option value="Minyak Goreng" {{ old('bahan_baku', $inspection->bahan_baku) == 'Minyak Goreng' ? 'selected' : '' }}>Minyak Goreng</option>
                                    <option value="Bumbu ABC" {{ old('bahan_baku', $inspection->bahan_baku) == 'Bumbu ABC' ? 'selected' : '' }}>Bumbu ABC</option>
                                </select>
                                @error('bahan_baku') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="supplier" class="form-label">Supplier</label>
                                {{-- PERUBAHAN: Isi value dengan data lama --}}
                                <input type="text" class="form-control @error('supplier') is-invalid @enderror" id="supplier" name="supplier" value="{{ old('supplier', $inspection->supplier) }}" required>
                                @error('supplier') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD DETAIL PRODUK --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong><i class="bi bi-list-nested"></i> Detail Produk</strong>
                            <button type="button" id="add-detail-btn" class="btn btn-secondary btn-sm"><i class="bi bi-plus-lg"></i> Tambah Item</button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- PERUBAHAN: Kirim data detail ke JS melalui data-attribute --}}
                        <div id="product-details-container" data-details="{{ json_encode(old('details', $inspection->productDetails ?? [])) }}">
                            {{-- Form detail produk akan ditambahkan di sini oleh JS --}}
                        </div>
                    </div>
                </div>
                
                {{-- CARD KONDISI FISIK --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><i class="bi bi-truck"></i> Kondisi Fisik (Mobil & Kemasan)</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php
                                $kondisiFisikFields = [
                                    'mobil_check_warna' => 'Warna', 
                                    'mobil_check_kotoran' => 'Kotoran', 
                                    'mobil_check_aroma' => 'Aroma', 
                                    'mobil_check_kemasan' => 'Kemasan'
                                ];
                            @endphp
                            @foreach ($kondisiFisikFields as $name => $label)
                            <div class="col-md-3 col-6 mb-3">
                                <label class="form-label d-block">{{ $label }}</label>
                                {{-- PERUBAHAN: Cek 'old' atau data boolean $inspection --}}
                                <input type="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $inspection->$name ? '1' : '0') }}">
                                <div class="btn-group btn-check-group" role="group">
                                    <button type="button" class="btn {{ old($name, $inspection->$name ? '1' : '0') === '1' ? 'btn-success' : 'btn-outline-success' }}" data-value="1" data-target-input="#{{ $name }}"><i class="bi bi-check-lg"></i> OK</button>
                                    <button type="button" class="btn {{ old($name, $inspection->$name ? '1' : '0') === '0' ? 'btn-danger' : 'btn-outline-danger' }}" data-value="0" data-target-input="#{{ $name }}"><i class="bi bi-x-lg"></i> Not OK</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- CARD ANALISA PRODUK --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><i class="bi bi-search"></i> Analisa Produk</strong>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3 col-6">
                                <label class="form-label d-block">K.A / FFA</label>
                                {{-- PERUBAHAN: Cek 'old' atau data boolean $inspection --}}
                                <input type="hidden" name="analisa_ka_ffa" id="analisa_ka_ffa" value="{{ old('analisa_ka_ffa', $inspection->analisa_ka_ffa ? '1' : '0') }}">
                                <div class="btn-group btn-check-group" role="group">
                                    <button type="button" class="btn {{ old('analisa_ka_ffa', $inspection->analisa_ka_ffa ? '1' : '0') === '1' ? 'btn-success' : 'btn-outline-success' }}" data-value="1" data-target-input="#analisa_ka_ffa"><i class="bi bi-check-lg"></i> OK</button>
                                    <button type="button" class="btn {{ old('analisa_ka_ffa', $inspection->analisa_ka_ffa ? '1' : '0') === '0' ? 'btn-danger' : 'btn-outline-danger' }}" data-value="0" data-target-input="#analisa_ka_ffa"><i class="bi bi-x-lg"></i> Not OK</button>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="form-label d-block">Logo Halal</label>
                                {{-- PERUBAHAN: Cek 'old' atau data boolean $inspection --}}
                                <input type="hidden" name="analisa_logo_halal" id="analisa_logo_halal" value="{{ old('analisa_logo_halal', $inspection->analisa_logo_halal ? '1' : '0') }}">
                                <div class="btn-group btn-check-group" role="group">
                                    <button type="button" class="btn {{ old('analisa_logo_halal', $inspection->analisa_logo_halal ? '1' : '0') === '1' ? 'btn-success' : 'btn-outline-success' }}" data-value="1" data-target-input="#analisa_logo_halal"><i class="bi bi-check-lg"></i> OK</button>
                                    <button type="button" class="btn {{ old('analisa_logo_halal', $inspection->analisa_logo_halal ? '1' : '0') === '0' ? 'btn-danger' : 'btn-outline-danger' }}" data-value="0" data-target-input="#analisa_logo_halal"><i class="bi bi-x-lg"></i> Not OK</button>
                                </div>
                            </div>
                            <div class="col-md-6"></div> {{-- Spacer --}}
                            <div class="col-md-6">
                                <label for="analisa_negara_asal" class="form-label">Negara Asal Produsen</label>
                                {{-- PERUBAHAN: Isi value dengan data lama --}}
                                <input type="text" class="form-control @error('analisa_negara_asal') is-invalid @enderror" id="analisa_negara_asal" name="analisa_negara_asal" value="{{ old('analisa_negara_asal', $inspection->analisa_negara_asal) }}" required>
                                @error('analisa_negara_asal') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="analisa_produsen" class="form-label">Nama Produsen</label>
                                {{-- PERUBAHAN: Isi value dengan data lama --}}
                                <input type="text" class="form-control @error('analisa_produsen') is-invalid @enderror" id="analisa_produsen" name="analisa_produsen" value="{{ old('analisa_produsen', $inspection->analisa_produsen) }}" required>
                                @error('analisa_produsen') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD DOKUMEN PENDUKUNG --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><i class="bi bi-file-earmark-text"></i> Dokumen Pendukung</strong>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Dokumen Halal</label>
                                <div class="mb-2">
                                    <label class="form-label d-block" for="dokumen_halal_berlaku">Status Berlaku?</label>
                                    {{-- PERUBAHAN: Cek 'old' atau data boolean $inspection --}}
                                    <input type="hidden" name="dokumen_halal_berlaku" id="dokumen_halal_berlaku" value="{{ old('dokumen_halal_berlaku', $inspection->dokumen_halal_berlaku ? '1' : '0') }}">
                                    <div class="btn-group btn-check-group" role="group">
                                        <button type="button" class="btn {{ old('dokumen_halal_berlaku', $inspection->dokumen_halal_berlaku ? '1' : '0') === '1' ? 'btn-success' : 'btn-outline-success' }}" data-value="1" data-target-input="#dokumen_halal_berlaku"><i class="bi bi-check-lg"></i> Berlaku (OK)</button>
                                        <button type="button" class="btn {{ old('dokumen_halal_berlaku', $inspection->dokumen_halal_berlaku ? '1' : '0') === '0' ? 'btn-danger' : 'btn-outline-danger' }}" data-value="0" data-target-input="#dokumen_halal_berlaku"><i class="bi bi-x-lg"></i> Tidak (X)</button>
                                    </div>
                                </div>
                                {{-- PERUBAHAN: Label untuk file upload --}}
                                <label class="form-label" for="dokumen_halal_file">Upload File Halal Baru (Optional)</label>
                                <input type="file" class="form-control @error('dokumen_halal_file') is-invalid @enderror" name="dokumen_halal_file" id="dokumen_halal_file">
                                @error('dokumen_halal_file') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                {{-- PERUBAHAN: Tampilkan file yang ada --}}
                                @if($inspection->dokumen_halal_file)
                                    <div class="mt-2 text-muted small">
                                        File saat ini: <a href="{{ asset('storage/' . $inspection->dokumen_halal_file) }}" target="_blank">Lihat File</a>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                {{-- PERUBAHAN: Label untuk file upload --}}
                                <label for="dokumen_coa_file" class="form-label">Dokumen COA Baru (Optional)</label>
                                <input class="form-control @error('dokumen_coa_file') is-invalid @enderror" type="file" id="dokumen_coa_file" name="dokumen_coa_file">
                                @error('dokumen_coa_file') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                {{-- PERUBAHAN: Tampilkan file yang ada --}}
                                @if($inspection->dokumen_coa_file)
                                    <div class="mt-2 text-muted small">
                                        File saat ini: <a href="{{ asset('storage/' . $inspection->dokumen_coa_file) }}" target="_blank">Lihat File</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- CARD TRANSPORTER --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><i class="bi bi-person-badge"></i> Informasi Transporter</strong>
                    </div>
                    <div class="card-body">
                         <div class="row g-3">
                            <div class="col-md-4">
                                <label for="nopol_mobil" class="form-label">Nopol Mobil</label>
                                {{-- PERUBAHAN: Isi value dengan data lama --}}
                                <input type="text" class="form-control @error('nopol_mobil') is-invalid @enderror" id="nopol_mobil" name="nopol_mobil" value="{{ old('nopol_mobil', $inspection->nopol_mobil) }}" required>
                                @error('nopol_mobil') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                             <div class="col-md-4">
                                <label for="suhu_mobil" class="form-label">Suhu Mobil (°C)</label>
                                {{-- PERUBAHAN: Isi value dengan data lama --}}
                                <input type="text" class="form-control @error('suhu_mobil') is-invalid @enderror" id="suhu_mobil" name="suhu_mobil" value="{{ old('suhu_mobil', $inspection->suhu_mobil) }}" required>
                                @error('suhu_mobil') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="kondisi_mobil" class="form-label">Kondisi Mobil</label>
                                <select class="form-select select2 @error('kondisi_mobil') is-invalid @enderror" id="kondisi_mobil" name="kondisi_mobil" required>
                                    <option></option> {{-- Placeholder untuk Select2 --}}
                                    {{-- PERUBAHAN: Cek 'old' atau data $inspection --}}
                                    <option value="Bersih" {{ old('kondisi_mobil', $inspection->kondisi_mobil) == 'Bersih' ? 'selected' : '' }}>Bersih</option>
                                    <option value="Kotor" {{ old('kondisi_mobil', $inspection->kondisi_mobil) == 'Kotor' ? 'selected' : '' }}>Kotor</option>
                                    <option value="Bau" {{ old('kondisi_mobil', $inspection->kondisi_mobil) == 'Bau' ? 'selected' : '' }}>Bau</option>
                                    <option value="Bocor" {{ old('kondisi_mobil', $inspection->kondisi_mobil) == 'Bocor' ? 'selected' : '' }}>Bocor</option>
                                    <option value="Basah" {{ old('kondisi_mobil', $inspection->kondisi_mobil) == 'Basah' ? 'selected' : '' }}>Basah</option>
                                    <option value="Kering" {{ old('kondisi_mobil', $inspection->kondisi_mobil) == 'Kering' ? 'selected' : '' }}>Kering</option>
                                    <option value="Bebas Hama" {{ old('kondisi_mobil', $inspection->kondisi_mobil) == 'Bebas Hama' ? 'selected' : '' }}>Bebas Hama</option>
                                </select>
                                @error('kondisi_mobil') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                             <div class="col-md-6">
                                <label for="do_po" class="form-label">No. DO / PO</label>
                                {{-- PERUBAHAN: Isi value dengan data lama --}}
                                <input type="text" class="form-control @error('do_po') is-invalid @enderror" id="do_po" name="do_po" value="{{ old('do_po', $inspection->do_po) }}" required>
                                @error('do_po') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="no_segel" class="form-label">No. Segel</label>
                                {{-- PERUBAHAN: Isi value dengan data lama --}}
                                <input type="text" class="form-control @error('no_segel') is-invalid @enderror" id="no_segel" name="no_segel" value="{{ old('no_segel', $inspection->no_segel) }}" required>
                                @error('no_segel') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="suhu_daging" class="form-label">Suhu Daging/Bahan (°C)</label>
                                {{-- PERUBAHAN: Isi value dengan data lama --}}
                                <input type="number" step="0.01" class="form-control @error('suhu_daging') is-invalid @enderror" id="suhu_daging" name="suhu_daging" value="{{ old('suhu_daging', $inspection->suhu_daging) }}" required>
                                @error('suhu_daging') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            <div class="col-12">
                                <label for="keterangan" class="form-label">Keterangan (Optional)</label>
                                {{-- PERUBAHAN: Isi value dengan data lama --}}
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $inspection->keterangan) }}</textarea>
                                @error('keterangan') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                         </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between mt-4">
                    {{-- PERUBAHAN: Teks tombol dan ikon --}}
                    <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-check-circle"></i> Update Pemeriksaan</button>
                    <a href="{{ route('inspections.index') }}" class="btn btn-secondary btn-lg"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- 1. Include jQuery (Select2 depends on it) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- 2. Include Select2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // 3. Initialize Select2 (Tidak berubah)
    $(document).ready(function() {
        $('.select2').select2({
            theme: "bootstrap-5", // Use the Bootstrap 5 theme
            placeholder: "Ketik untuk mencari...",
            allowClear: true,
            dropdownAutoWidth: true
        });
    });
</script>

{{-- 4. PERUBAHAN: Menggunakan Script JS dari file Edit yang lama --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // --- Script for Dynamic Product Details (MODIFIED FOR EDIT) ---
        const container = document.getElementById('product-details-container');
        const addBtn = document.getElementById('add-detail-btn');
        let detailIndex = 0; // Ini akan melacak item BARU, data lama akan di-render terlebih dahulu

        /**
         * Fungsi untuk merender form detail, bisa dengan data (untuk edit) atau kosong (untuk baru)
         */
        function renderDetailForm(data = null) {
            const i = detailIndex; // Ambil index saat ini
            
            const newDetail = document.createElement('div');
            newDetail.classList.add('product-detail-item', 'border', 'p-3', 'mb-3', 'rounded', 'shadow-sm');
            
            // Isi value jika ada data, jika tidak, string kosong
            const kodeBatch = data ? (data.kode_batch || '') : '';
            const tglProduksi = data ? (data.tanggal_produksi || '') : '';
            const exp = data ? (data.exp || '') : '';
            const jumlah = data ? (data.jumlah || '') : '';
            const jumlahSampel = data ? (data.jumlah_sampel || '') : '';
            const jumlahReject = data ? (data.jumlah_reject || '') : '';

            newDetail.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5>Item #${i + 1}</h5>
                    <button type="button" class="btn btn-danger btn-sm remove-detail-btn"><i class="bi bi-trash"></i> Hapus</button>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Kode Batch</label>
                        <input type="text" name="details[${i}][kode_batch]" class="form-control" value="${kodeBatch}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Produksi</label>
                        <input type="date" name="details[${i}][tanggal_produksi]" class="form-control" value="${tglProduksi}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">EXP Date</label>
                        <input type="date" name="details[${i}][exp]" class="form-control" value="${exp}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jumlah Barang</label>
                        <input type="number" step="0.01" name="details[${i}][jumlah]" class="form-control" value="${jumlah}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jumlah Sampel</label>
                        <input type="number" step="0.01" name="details[${i}][jumlah_sampel]" class="form-control" value="${jumlahSampel}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jumlah Reject</label>
                        <input type="number" step="0.01" name="details[${i}][jumlah_reject]" class="form-control" value="${jumlahReject}" required>
                    </div>
                </div>
            `;
            container.appendChild(newDetail);
            detailIndex++; // Increment index untuk item berikutnya
        }

        if (addBtn) {
            // Tombol "Tambah Item" sekarang memanggil renderDetailForm tanpa data
            addBtn.addEventListener('click', () => renderDetailForm(null));
        }
        
        if (container) {
            // Logika untuk tombol "Hapus" (tidak berubah)
            container.addEventListener('click', function(e) {
                const removeBtn = e.target.closest('.remove-detail-btn');
                if (removeBtn) {
                    removeBtn.closest('.product-detail-item').remove();
                }
            });

            // --- PERUBAHAN UTAMA: Render data yang ada saat halaman dimuat ---
            try {
                const existingDetails = JSON.parse(container.dataset.details || '[]');
                
                if (existingDetails.length > 0) {
                    // Jika ada data (dari 'old' atau $inspection), loop dan render form
                    existingDetails.forEach(detail => {
                        renderDetailForm(detail);
                    });
                } else {
                    // Jika tidak ada data (form edit tapi tidak ada detail), tambahkan satu form kosong
                    renderDetailForm(null);
                }
            } catch (e) {
                console.error("Gagal parse data detail: ", e);
                // Fallback: tambahkan satu form kosong jika JSON error
                renderDetailForm(null);
            }
        }

        // --- Script for OK/Not OK Buttons (TIDAK BERUBAH) ---
        const buttonGroups = document.querySelectorAll('.btn-check-group');

        buttonGroups.forEach(group => {
            group.addEventListener('click', function(e) {
                if (e.target.matches('.btn')) {
                    const button = e.target;
                    const value = button.dataset.value; 
                    const targetInputId = button.dataset.targetInput; 
                    
                    if (!targetInputId) return; 
                    
                    const targetInput = document.querySelector(targetInputId);

                    if (targetInput) {
                        targetInput.value = value;
                    }

                    const buttonsInGroup = group.querySelectorAll('button');
                    buttonsInGroup.forEach(btn => {
                        if (btn.dataset.value === '1') { 
                            btn.classList.remove('btn-success');
                            btn.classList.add('btn-outline-success');
                        } else { 
                            btn.classList.remove('btn-danger');
                            btn.classList.add('btn-outline-danger');
                        }
                    });

                    if (value === '1') {
                        button.classList.remove('btn-outline-success');
                        button.classList.add('btn-success');
                    } else {
                        button.classList.remove('btn-outline-danger');
                        button.classList.add('btn-danger');
                    }
                }
            });
        });
    });
</script>
@endpush