@extends('layouts.app') {{-- Layout utama --}}

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-4">➕ Tambah Koordinator</h3>

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
                    <form action="{{ route('koordinator.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_koordinator" class="form-label">Nama Koordinator</label>
                            <input
                            type="text"
                            name="nama_koordinator"
                            class="form-control @error('nama_koordinator') is-invalid @enderror"
                            placeholder="Masukkan koordinator Baru   "
                            value="{{ old('nama_koordinator') }}">
                            @error('nama_koordinator')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">💾 Simpan</button>
                            <a href="{{ route('koordinator.index') }}" class="btn btn-secondary">⬅ Kembali</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection