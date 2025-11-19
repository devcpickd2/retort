@extends('layouts.app') {{-- Layout utama --}}

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-4">✏️ Edit Supplier</h3>

            {{-- Alert error jika validasi gagal --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ups!</strong> Ada kesalahan pada inputan Anda:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Form Edit --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('supplier.update', $supplier->uuid) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Gunakan method PUT untuk update --}}

                        <div class="mb-3">
                            <label for="nama_supplier" class="form-label">Nama Supplier</label>
                            <input
                            type="text"
                            name="nama_supplier"
                            id="nama_supplier"
                            class="form-control @error('nama_supplier') is-invalid @enderror"
                            value="{{ old('nama_supplier', $supplier->nama_supplier) }}"
                            placeholder="Masukkan nama supplier"
                            required>
                            @error('nama_supplier')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_barang" class="form-label">Jenis Barang</label>
                            <select 
                            name="jenis_barang" 
                            id="jenis_barang" 
                            class="form-control @error('jenis_barang') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Barang --</option>
                            <option value="Packaging" {{ old('jenis_barang', $supplier->jenis_barang) == 'Packaging' ? 'selected' : '' }}>Packaging</option>
                            <option value="Raw Material" {{ old('jenis_barang', $supplier->jenis_barang) == 'Raw Material' ? 'selected' : '' }}>Raw Material</option>
                        </select>
                        @error('jenis_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">💾 Update</button>
                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary">⬅ Kembali</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
</div>
@endsection
