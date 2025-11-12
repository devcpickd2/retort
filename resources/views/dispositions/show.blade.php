@extends('layouts.app')

@section('title', 'Detail Disposisi')

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
    .btn-custom.btn-primary { background-color: var(--color-warning); color: #212529; }
    .btn-custom.btn-primary:hover { background-color: #ffca2c; }
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
        white-space: pre-wrap; /* Ini penting agar newline dari textarea terlihat */
    }
</style>
@endpush

@section('content')
<div class="page-container">
    {{-- HEADER HALAMAN BARU --}}
    <div class="page-header">
        <h1><i class="bi bi-file-earmark-text" style="color: var(--color-primary);"></i> Detail Disposisi</h1>
        <div class="page-header-actions">
            <a href="{{ route('dispositions.index') }}" class="btn-custom btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            <a href="{{ route('dispositions.edit', $disposition->uuid) }}" class="btn-custom btn-primary"><i class="bi bi-pencil"></i> Edit Data</a>
        </div>
    </div>

    {{-- Data Header (Induk) --}}
    <div class="detail-card">
        <h2><i class="bi bi-info-circle-fill"></i> Data Utama</h2>
        <div class="detail-grid">
            <div class="detail-grid-item">
                <strong>Nomor:</strong> <span>{{ $disposition->nomor }}</span>
            </div>
            <div class="detail-grid-item">
                <strong>Tanggal:</strong> <span>{{ \Carbon\Carbon::parse($disposition->tanggal)->format('d F Y') }}</span>
            </div>
            <div class="detail-grid-item">
                <strong>Kepada:</strong> <span>{{ $disposition->kepada }}</span>
            </div>
        </div>
        
        {{-- Tipe Disposisi (Badge) --}}
        <h4 style="margin-top: 1.5rem; margin-bottom: 0.5rem; font-weight: 600; font-size: 1.1rem;">Tipe Disposisi:</h4>
        <div>
            @if($disposition->disposisi_produk) 
                <span class="badge bg-primary fs-6">Produk</span> 
            @endif
            @if($disposition->disposisi_material) 
                <span class="badge bg-warning text-dark fs-6">Material</span> 
            @endif
            @if($disposition->disposisi_prosedur) 
                <span class="badge bg-info text-dark fs-6">Prosedur</span> 
            @endif
            
            @if(!$disposition->disposisi_produk && !$disposition->disposisi_material && !$disposition->disposisi_prosedur)
                <span class="text-muted"><em>(Tidak ada tipe yang dipilih)</em></span>
            @endif
        </div>
    </div>
    
    {{-- Data Detail (Textarea) --}}
    <div class="detail-card">
        <h2><i class="bi bi-card-text"></i> Detail Disposisi</h2>
        
        <div class="text-block-item">
            <h4>Dasar Disposisi</h4>
            <div class="text-block-item-content">{{ $disposition->dasar_disposisi }}</div>
        </div>

        <div class="text-block-item">
            <h4>Uraian Disposisi</h4>
            <div class="text-block-item-content">{{ $disposition->uraian_disposisi }}</div>
        </div>

        @if($disposition->catatan)
            <div class="text-block-item mb-0">
                <h4>Catatan</h4>
                <div class="text-block-item-content">{{ $disposition->catatan }}</div>
            </div>
        @endif

        {{-- Footer Timestamp (Sesuai style lama Anda, tapi diintegrasikan) --}}
        <div class="card-footer bg-light text-muted" style="margin: 1.5rem -1.5rem -1.5rem; border-top: 1px solid var(--color-gray);">
            <div class="d-flex justify-content-between small p-3">
                <span>Dibuat: {{ $disposition->created_at->format('d M Y, H:i') }}</span>
                <span>Diperbarui: {{ $disposition->updated_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection