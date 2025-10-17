{{-- Ganti dengan layout utama aplikasi Anda --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pemeriksaan Bahan Baku</h1>
    
    {{-- Tampilkan error jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inspections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        {{-- Masukkan semua field form di sini --}}
        {{-- Contoh beberapa field --}}
        <div class="mb-3">
            <label for="setup_kedatangan" class="form-label">Waktu Kedatangan</label>
            <input type="datetime-local" class="form-control" id="setup_kedatangan" name="setup_kedatangan" required>
        </div>
        <div class="mb-3">
            <label for="bahan_baku" class="form-label">Bahan Baku</label>
            <input type="text" class="form-control" id="bahan_baku" name="bahan_baku" required>
        </div>
        
        {{-- ... tambahkan semua input field lain sesuai migrasi ... --}}
        
        <hr>
        
        <h4>Detail Produk</h4>
        <div id="product-details-container">
            {{-- Form detail produk akan ditambahkan di sini oleh JS --}}
        </div>
        <button type="button" id="add-detail-btn" class="btn btn-secondary mt-2">Tambah Detail Produk</button>
        
        <hr>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('product-details-container');
        const addBtn = document.getElementById('add-detail-btn');
        let detailIndex = 0;

        function addDetailForm() {
            const newDetail = document.createElement('div');
            newDetail.classList.add('product-detail-item', 'border', 'p-3', 'mb-3');
            newDetail.innerHTML = `
                <h5>Item #${detailIndex + 1}</h5>
                <div class="mb-2">
                    <label class="form-label">Kode Batch</label>
                    <input type="text" name="details[${detailIndex}][kode_batch]" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Tanggal Produksi</label>
                    <input type="date" name="details[${detailIndex}][tanggal_produksi]" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Exp</label>
                    <input type="date" name="details[${detailIndex}][exp]" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Jumlah</label>
                    <input type="number" step="0.01" name="details[${detailIndex}][jumlah]" class="form-control" required>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-detail-btn">Hapus</button>
            `;
            container.appendChild(newDetail);
            detailIndex++;
        }

        addBtn.addEventListener('click', addDetailForm);
        
        container.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-detail-btn')) {
                e.target.closest('.product-detail-item').remove();
            }
        });

        // Tambah form pertama kali saat halaman dimuat
        addDetailForm();
    });
</script>
@endsection