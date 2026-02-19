@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-4">➕ Tambah Bahan Baku Baru</h3>

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

            {{-- Form Input --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('raw-material.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_bahan_baku" class="form-label">Nama Bahan Baku</label>
                            <input
                            type="text"
                            name="nama_bahan_baku"
                            class="form-control @error('nama_bahan_baku') is-invalid @enderror"
                            placeholder="Contoh: Daging Sapi Triming"
                            value="{{ old('nama_bahan_baku') }}">
                            @error('nama_bahan_baku')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">💾 Simpan</button>
                            <a href="{{ route('raw-material.index') }}" class="btn btn-secondary">⬅ Kembali</a>
                        </div>

                    </form>
                </div>
            </div>

            {{-- Catatan: Informasi Plant dihapus agar sesuai dengan UI Produk, jika butuh silakan tambahkan kembali di sini --}}

        </div>
    </div>
</div>
@endsection