@extends('layouts.app') {{-- Layout utama --}}

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-4">✏️ Edit Area</h3>
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
                    <form action="{{ route('area_hygiene.update', $area_hygiene->uuid) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Gunakan method PUT untuk update --}}

                        <div class="mb-3">
                            <label for="area" class="form-label">Nama Area</label>
                            <input
                            type="text"
                            name="area"
                            id="area"
                            class="form-control @error('area') is-invalid @enderror"
                            value="{{ old('area', $area_hygiene->area) }}"
                            placeholder="Masukkan nama Area"
                            required>
                            @error('area')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">💾 Update</button>
                            <a href="{{ route('area_hygiene.index') }}" class="btn btn-secondary">⬅ Kembali</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
