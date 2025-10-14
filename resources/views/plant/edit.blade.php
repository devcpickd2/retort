@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-4">✏️ Edit Plant</h3>
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
                    <form action="{{ route('plant.update', $plant->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="plant" class="form-label">Nama Plant</label>
                            <input
                            type="text"
                            name="plant"
                            class="form-control @error('plant') is-invalid @enderror"
                            value="{{ old('plant', $plant->plant) }}">
                            @error('plant')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                         <button type="submit" class="btn btn-primary">💾 Update</button>
                         <a href="{{ route('plant.index') }}" class="btn btn-secondary">⬅ Kembali</a>
                     </div>

                 </form>
             </div>
         </div>

     </div>
 </div>
</div>
@endsection