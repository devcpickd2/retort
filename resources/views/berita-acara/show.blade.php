@extends('layouts.app')

@section('title', 'Detail Berita Acara')

@push('styles')
{{-- Menambahkan link untuk Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    /* Variabel warna dan style dasar dari contoh Anda */
    :root {
        --color-primary: #007bff;
        --color-success: #28a745;
        --color-danger: #dc3545;
        --color-info: #17a2b8;
        --color-warning: #ffc107;
        --color-light-gray: #f8f9fa;
        --color-gray: #dee2e6;
        --border-radius: 0.375rem;
    }
    .page-container { padding: 20px; max-width: 1200px; margin: 0 auto; }
    
    /* Header Halaman */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--color-gray);
    }
    .page-header h1 { margin: 0; color: #333; font-size: 1.75rem; }
    .page-header-actions { display: flex; gap: 10px; }

    /* Tombol Kustom (Sesuai contoh Anda) */
    .btn-custom {
        padding: 0.6rem 1rem;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        color: white;
    }
    /* Mengubah tombol 'Edit' menjadi kuning (Warning) */
    .btn-custom.btn-warning { background-color: var(--color-warning); color: #212529; }
    .btn-custom.btn-warning:hover { background-color: #ffca2c; }
    .btn-custom.btn-secondary {
        background-color: transparent;
        color: #6c757d;
        border: 1px solid #6c757d;
    }
    .btn-custom.btn-secondary:hover { background-color: rgba(0,0,0, 0.05); }

    /* Detail Card (Wrapper utama) */
    .detail-card { 
        border: 1px solid var(--color-gray); 
        padding: 1.5rem; 
        margin-bottom: 1.5rem; 
        border-radius: var(--border-radius); 
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }
    .detail-card h2 { 
        margin-top: 0; 
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--color-gray);
        color: var(--color-primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    /* Grid untuk info Key-Value */
    .detail-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem 2rem; 
    }
    .detail-grid-item {
        display: grid;
        grid-template-columns: 140px 1fr;
        gap: 5px;
        padding: 5px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .detail-grid-item strong { 
        font-weight: 600; 
        color: #333;
    }
    .detail-grid-item span { color: #555; }

    /* Style untuk blok teks (Dasar, Uraian, Catatan) */
    .text-block-item { margin-bottom: 1.5rem; }
    .text-block-item h4 { 
        font-size: 1.1rem; 
        font-weight: 600; 
        color: #333; 
        margin-bottom: 0.5rem; 
    }
    .text-block-item-content {
        background-color: var(--color-light-gray, #f8f9fa);
        padding: 1rem;
        border-radius: var(--border-radius, 0.375rem);
        border: 1px solid var(--color-gray, #dee2e6);
        white-space: pre-wrap; /* Penting agar newline terlihat */
    }
</style>
@endpush

@section('content')
<div class="page-container">
    {{-- HEADER HALAMAN BARU --}}
    <div class="page-header">
        <h1><i class="bi bi-file-earmark-text" style="color: var(--color-primary);"></i> Detail Berita Acara</h1>
        <div class="page-header-actions">
            <a href="{{ route('berita-acara.index') }}" class="btn-custom btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            <a href="{{ route('berita-acara.edit', $beritaAcara->id) }}" class="btn-custom btn-warning"><i class="bi bi-pencil"></i> Edit Data</a>
        </div>
    </div>

    {{-- CARD 1: Data Utama --}}
    <div class="detail-card">
        <h2><i class="bi bi-info-circle-fill"></i> Data Utama</h2>
        <div class="detail-grid">
            <div class="detail-grid-item">
                <strong>Nomor BA:</strong> <span>{{ $beritaAcara->nomor }}</span>
            </div>
            <div class="detail-grid-item">
                <strong>Tgl. Kedatangan:</strong> <span>{{ $beritaAcara->tanggal_kedatangan->format('d F Y') }}</span>
            </div>
            <div class="detail-grid-item">
                <strong>Nama Barang:</strong> <span>{{ $beritaAcara->nama_barang }}</span>
            </div>
            <div class="detail-grid-item">
                <strong>Jumlah Barang:</strong> <span>{{ $beritaAcara->jumlah_barang }}</span>
            </div>
            <div class="detail-grid-item">
                <strong>Supplier:</strong> <span>{{ $beritaAcara->supplier }}</span>
            </div>
            <div class="detail-grid-item">
                <strong>No. Surat Jalan:</strong> <span>{{ $beritaAcara->no_surat_jalan ?? '-' }}</span>
            </div>
            <div class="detail-grid-item">
                <strong>DD / PO:</strong> <span>{{ $beritaAcara->dd_po ?? '-' }}</span>
            </div>
            <div class="detail-grid-item">
                <strong>Tgl. Keputusan:</strong> <span>{{ $beritaAcara->tanggal_keputusan ? $beritaAcara->tanggal_keputusan->format('d F Y') : '-' }}</span>
            </div>
        </div>
    </div>
    
    {{-- CARD 2: Detail Masalah & Keputusan --}}
    <div class="detail-card">
        <h2><i class="bi bi-card-text"></i> Detail Masalah & Keputusan</h2>
        
        <div class="text-block-item">
            <h4>Uraian Masalah</h4>
            <div class="text-block-item-content">{{ $beritaAcara->uraian_masalah }}</div>
        </div>

        <h4 style="margin-top: 1.5rem; margin-bottom: 0.5rem; font-weight: 600; font-size: 1.1rem;">Keputusan:</h4>
        <ul class="list-group">
            @if(!$beritaAcara->keputusan_pengembalian && !$beritaAcara->keputusan_potongan_harga && !$beritaAcara->keputusan_sortir && !$beritaAcara->keputusan_penukaran_barang && !$beritaAcara->keputusan_penggantian_biaya && !$beritaAcara->keputusan_lain_lain)
                <li class="list-group-item text-muted"><em>(Belum ada keputusan)</em></li>
            @endif
            @if($beritaAcara->keputusan_pengembalian) <li class="list-group-item"><i class="bi bi-box-arrow-left me-2"></i> Pengembalian Barang</li> @endif
            @if($beritaAcara->keputusan_potongan_harga) <li class="list-group-item"><i class="bi bi-cash-coin me-2"></i> Potongan Harga</li> @endif
            @if($beritaAcara->keputusan_sortir) <li class="list-group-item"><i class="bi bi-filter-circle me-2"></i> Sortir</li> @endif
            @if($beritaAcara->keputusan_penukaran_barang) <li class="list-group-item"><i class="bi bi-arrow-repeat me-2"></i> Penukaran Barang</li> @endif
            @if($beritaAcara->keputusan_penggantian_biaya) <li class="list-group-item"><i class="bi bi-receipt me-2"></i> Penggantian Biaya</li> @endif
            @if($beritaAcara->keputusan_lain_lain) <li class="list-group-item"><i class="bi bi-three-dots me-2"></i> Lain-lain: {{ $beritaAcara->keputusan_lain_lain }}</li> @endif
        </ul>
    </div>
    
    {{-- CARD 3: Respon Supplier --}}
    <div class="detail-card">
        <h2><i class="bi bi-person-check-fill"></i> Respon Supplier</h2>
        <div class="text-block-item">
            <h4>A. Analisa Penyebab Penyimpangan</h4>
            <div class="text-block-item-content">{{ $beritaAcara->analisa_penyebab ?? '-' }}</div>
        </div>
        <div class="text-block-item mb-0">
            <h4>B. Tindak Lanjut Perbaikan dan Pencegahan</h4>
            <div class="text-block-item-content">{{ $beritaAcara->tindak_lanjut_perbaikan ?? '-' }}</div>
        </div>
    </div>
    
    {{-- CARD 4: Status Verifikasi --}}
    <div class="detail-card">
        <h2><i class="bi bi-check-all"></i> Status Verifikasi</h2>
        <div class="row">
            <div class="col-md-6">
                <h4><i class="bi bi-person-workspace"></i> PPIC (Mengetahui)</h4>
                <div class="detail-grid-item">
                    <strong>Status:</strong> 
                    <span>
                        @if($beritaAcara->status_ppic == 0) <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($beritaAcara->status_ppic == 1) <span class="badge bg-success">Verified</span>
                        @else <span class="badge bg-danger">Revision</span>
                        @endif
                    </span>
                </div>
                <div class="detail-grid-item">
                    <strong>Oleh:</strong> <span>{{ $beritaAcara->verifierPpic->name ?? '-' }}</span>
                </div>
                <div class="detail-grid-item">
                    <strong>Tanggal:</strong> <span>{{ $beritaAcara->ppic_verified_at ? $beritaAcara->ppic_verified_at->format('d M Y, H:i') : '-' }}</span>
                </div>
                <div class="detail-grid-item">
                    <strong>Catatan:</strong> <span>{{ $beritaAcara->catatan_ppic ?? '-' }}</span>
                </div>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <h4><i class="bi bi-person-video3"></i> QC Supervisor (Disetujui)</h4>
                <div class="detail-grid-item">
                    <strong>Status:</strong> 
                    <span>
                        @if($beritaAcara->status_spv == 0) <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($beritaAcara->status_spv == 1) <span class="badge bg-success">Verified</span>
                        @else <span class="badge bg-danger">Revision</span>
                        @endif
                    </span>
                </div>
                <div class="detail-grid-item">
                    <strong>Oleh:</strong> <span>{{ $beritaAcara->verifierSpv->name ?? '-' }}</span>
                </div>
                <div class="detail-grid-item">
                    <strong>Tanggal:</strong> <span>{{ $beritaAcara->spv_verified_at ? $beritaAcara->spv_verified_at->format('d M Y, H:i') : '-' }}</span>
                </div>
                <div class="detail-grid-item">
                    <strong>Catatan:</strong> <span>{{ $beritaAcara->catatan_spv ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>
    
    {{-- CARD 5: Lampiran & Audit Trail --}}
    <div class="detail-card">
        <h2><i class="bi bi-paperclip"></i> Lampiran & Catatan Audit</h2>
        
        @if($beritaAcara->lampiran)
            <div class="text-block-item mb-0">
                <h4>Lampiran</h4>
                <div class="text-block-item-content">{{ $beritaAcara->lampiran }}</div>
            </div>
        @else
             <p class="text-muted"><em>Tidak ada lampiran.</em></p>
        @endif

        {{-- Footer Timestamp --}}
        <div class="card-footer bg-light text-muted" style="margin: 1.5rem -1.5rem -1.5rem; border-top: 1px solid var(--color-gray);">
            <div class="d-flex justify-content-between flex-wrap small p-3">
                <span><strong>Dibuat Oleh:</strong> {{ $beritaAcara->creator->name ?? 'N/A' }}</span>
                <span><strong>Dibuat Pada:</strong> {{ $beritaAcara->created_at->format('d M Y, H:i') }}</span>
                <span><strong>Diperbarui:</strong> {{ $beritaAcara->updated_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection