@extends('layouts.app') {{-- Layout utama --}}

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-4">➕ Tambah Karyawan</h3>

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
                    <form action="{{ route('operator.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                            <input
                            type="text"
                            name="nama_karyawan"
                            class="form-control @error('nama_karyawan') is-invalid @enderror"
                            placeholder="Masukkan Karyawan Baru   "
                            value="{{ old('nama_karyawan') }}">
                            @error('nama_karyawan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bagian" class="form-label">Bagian</label>
                            <select 
                            name="bagian" 
                            id="bagian" 
                            class="form-control @error('bagian') is-invalid @enderror">
                            <option value="">-- Pilih Bagian --</option>
                            <option value="Operator" {{ old('bagian') == 'Operator' ? 'selected' : '' }}>Operator</option>
                            <option value="Engineer" {{ old('bagian') == 'Engineer' ? 'selected' : '' }}>Engineer</option>
                            <option value="Koordinator" {{ old('bagian') == 'Koordinator' ? 'selected' : '' }}>Koordinator</option>
                        </select>
                        @error('bagian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">💾 Simpan</button>
                        <a href="{{ route('operator.index') }}" class="btn btn-secondary">⬅ Kembali</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
</div>
@endsection