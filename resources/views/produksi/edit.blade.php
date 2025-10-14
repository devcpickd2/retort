@extends('layouts.app') {{-- Layout utama --}}

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-4">✏️ Edit Nama Karyawan</h3>

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
                    <form action="{{ route('produksi.update', $produksi->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                            <input
                            type="text"
                            name="nama_karyawan"
                            class="form-control @error('nama_karyawan') is-invalid @enderror"
                            placeholder="Masukkan Nama Karyawan.."
                            value="{{ old('nama_karyawan', $produksi->nama_karyawan) }}">
                            @error('nama_karyawan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="area" class="form-label">Area</label>
                            <select
                            name="area"
                            id="area"
                            class="form-control @error('area') is-invalid @enderror">
                            <option value="">-- Pilih Area --</option>
                            <option value="MP - CHAMBER - SANITASI" {{ old('area', $produksi->area) == 'MP - CHAMBER - SANITASI' ? 'selected' : '' }}>MP - CHAMBER - SANITASI</option>
                            <option value="KARANTINA - PACKING" {{ old('area', $produksi->area) == 'KARANTINA - PACKING' ? 'selected' : '' }}>KARANTINA - PACKING</option>
                            <option value="FILLING - SUSUN" {{ old('area', $produksi->area) == 'FILLING - SUSUN' ? 'selected' : '' }}>FILLING - SUSUN</option>
                            <option value="SAMPLING FG" {{ old('area', $produksi->area) == 'SAMPLING FG' ? 'selected' : '' }}>SAMPLING FG</option>
                        </select>
                        @error('area')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">💾 Update</button>
                        <a href="{{ route('produksi.index') }}" class="btn btn-secondary">⬅ Kembali</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
</div>
@endsection
