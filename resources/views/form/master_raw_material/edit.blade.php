@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-4">✏️ Edit Bahan Baku</h3>

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

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('raw-material.update', $raw_material->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_bahan_baku" class="form-label">Nama Bahan Baku</label>
                            <input 
                            type="text" 
                            name="nama_bahan_baku" 
                            id="nama_bahan_baku"
                            class="form-control @error('nama_bahan_baku') is-invalid @enderror" 
                            value="{{ old('nama_bahan_baku', $raw_material->nama_bahan_baku) }}" 
                            required>
                            
                            @error('nama_bahan_baku')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                            <a href="{{ route('raw-material.index') }}" class="btn btn-secondary">⬅ Kembali</a>
                        </div>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection