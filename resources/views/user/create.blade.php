@extends('layouts.app') {{-- Layout utama --}}

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-4">➕ Tambah User</h3>

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
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Masukkan nama"
                            value="{{ old('name') }}">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username"
                            class="form-control @error('username') is-invalid @enderror"
                            placeholder="Masukkan username"
                            value="{{ old('username') }}">
                            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Masukkan email (opsional)"
                            value="{{ old('email') }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        {{-- PLANT --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Plant</label>
                            <select name="plant" 
                            class="form-control @error('plant') is-invalid @enderror">
                            <option disabled selected>Pilih Plant</option>
                            @foreach($plants as $pl)
                            <option value="{{ $pl->id }}" 
                                {{ old('plant') == $pl->id ? 'selected' : '' }}>
                                {{ $pl->plant }}
                            </option>
                            @endforeach
                        </select>
                        @error('plant') 
                        <div class="invalid-feedback d-block">{{ $message }}</div> 
                        @enderror
                    </div>

                    {{-- DEPARTEMEN --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Department</label>
                        <select name="department" 
                        class="form-control @error('department') is-invalid @enderror">
                        <option disabled selected>Pilih Department</option>
                        @foreach($departments as $dep)
                        <option value="{{ $dep->id }}" 
                            {{ old('department') == $dep->id ? 'selected' : '' }}>
                            {{ $dep->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('department') 
                    <div class="invalid-feedback d-block">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tipe User</label>
                    <select name="type_user" 
                    class="form-control @error('type_user') is-invalid @enderror">
                    <option disabled selected>Pilih User</option>
                    <option value="0" {{ old('type_user') == 0 ? 'selected' : '' }}>Admin</option>
                    <option value="1" {{ old('type_user') == 1 ? 'selected' : '' }}>Manager</option>
                    <option value="2" {{ old('type_user') == 2 ? 'selected' : '' }}>Supervisor</option>
                    <option value="3" {{ old('type_user') == 3 ? 'selected' : '' }}>Foreman/Forelady Produksi</option>
                    <option value="8" {{ old('type_user') == 8 ? 'selected' : '' }}>Foreman/Forelady QC</option>
                    <option value="4" {{ old('type_user') == 4 ? 'selected' : '' }}>Inspector</option>
                    <option value="5" {{ old('type_user') == 5 ? 'selected' : '' }}>Engineer</option>
                    <option value="6" {{ old('type_user') == 6 ? 'selected' : '' }}>Warehouse</option>
                    <option value="7" {{ old('type_user') == 7 ? 'selected' : '' }}>Lab</option>
                </select>
                @error('type_user')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="activation" id="activation"
                value="1" {{ old('activation', 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="activation">
                    Aktifkan User
                </label>
            </div> -->

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">💾 Simpan</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">⬅ Kembali</a>
            </div>

        </form>
    </div>
</div>

</div>
</div>
</div>
@endsection
