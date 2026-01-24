@extends('layouts.app')

@section('content')
<div class="container">

    @php
        $type_user = auth()->user()->type_user; // pastikan sesuai kolom di DB
    @endphp

    {{-- Modal hanya untuk user type 4 & 8 --}}
    @if(in_array($type_user, [4,8]) && !session()->has('selected_produksi') && session('pop_up_produksi'))
        <div class="modal fade" id="produksiModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content rounded-4 shadow-lg">
                    <div class="modal-header bg-danger text-white border-0 justify-content-center">
                        <h5 class="modal-title fw-bold">Pilih Produksi</h5>
                    </div>
                    <div class="modal-body p-4 text-center">
                        <form method="POST" action="{{ route('set.produksi') }}">
                            @csrf
                            <div class="mb-4 text-start">
                                <label for="namaProduksi" class="form-label fw-semibold">Nama Produksi</label>
                                <select name="nama_produksi" id="namaProduksi" class="form-select form-select-lg custom-select-red" required autofocus>
                                    <option value="">-- Pilih Produksi --</option>
                                    @foreach(session('pop_up_produksi') as $prod)
                                        <option value="{{ $prod->uuid }}">{{ $prod->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger btn-lg w-100 fw-semibold">Lanjut</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var produksiModal = new bootstrap.Modal(document.getElementById('produksiModal'));
                produksiModal.show();
            });
        </script>
    @endif

    {{-- Tampilkan nama produksi saat ini --}}
    @if(session()->has('selected_produksi'))
        @php
            $prod = \App\Models\User::where('uuid', session('selected_produksi'))->first();
        @endphp
        <p>Foreman/Forelady Produksi saat ini: <strong>{{ $prod ? $prod->name : '-' }}</strong></p>
    @endif

</div>

<style>
/* Modal */
.modal-content {
    border-radius: 1rem;
    overflow: hidden;
    font-family: 'Poppins', sans-serif;
}

.modal-header {
    border-bottom: none;
}

.modal-title {
    font-size: 1.3rem;
}

/* Dropdown merah */
.custom-select-red {
    width: 100%;
    border-radius: 0.75rem;
    padding: 0.6rem 1rem;
    font-size: 1.1rem;
    height: 50px;
    background-color: #f8d7da;
    border: 1px solid #dc3545;
    color: #721c24;
    transition: all 0.2s;
}

.custom-select-red:focus {
    outline: none;
    border-color: #c82333;
    box-shadow: 0 0 5px rgba(220,53,69,0.5);
    background-color: #fff;
}

.custom-select-red option {
    background-color: #fff;
    color: #000;
}

.custom-select-red option:hover {
    background-color: #f8d7da;
}

/* Tombol merah besar */
.btn-danger {
    border-radius: 0.75rem;
    font-size: 1.05rem;
    padding: 0.5rem 1rem;
    transition: all 0.2s;
}

.btn-danger:hover {
    background-color: #b02a37;
    transform: translateY(-1px);
}

/* Hilangkan scroll saat modal terbuka */
body.modal-open {
    overflow: hidden;
}
</style>
@endsection
