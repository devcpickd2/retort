@extends('layouts.app') {{-- Layout utama --}}

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-4">➕ Tambah Mesin</h3>

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
                    <form action="{{ route('mesin.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_mesin" class="form-label">Nama Mesin</label>
                            <input
                            type="text"
                            name="nama_mesin"
                            class="form-control @error('nama_mesin') is-invalid @enderror"
                            placeholder="Masukkan Mesin Baru   "
                            value="{{ old('nama_mesin') }}">
                            @error('nama_mesin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jenis_mesin" class="form-label">Jenis Mesin</label>
                            <select 
                            name="jenis_mesin" 
                            id="jenis_mesin" 
                            class="form-control @error('jenis_mesin') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Mesin --</option>
                            <option value="Stuffing" {{ old('jenis_mesin') == 'Stuffing' ? 'selected' : '' }}>Stuffing</option>
                            <option value="Chamber" {{ old('jenis_mesin') == 'Chamber' ? 'selected' : '' }}>Chamber</option>
                        </select>
                        @error('jenis_mesin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">💾 Simpan</button>
                        <a href="{{ route('mesin.index') }}" class="btn btn-secondary">⬅ Kembali</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
</div>
@endsection