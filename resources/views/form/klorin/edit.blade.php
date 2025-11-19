@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="bi bi-pencil-square"></i> Edit Data Pengecekan Klorin
            </h4>

            {{-- ✅ Error dari backend --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form id="klorinEditForm" 
            action="{{ route('klorin.edit_spv', $klorin->uuid) }}" 
            method="POST" 
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ===================== IDENTITAS ===================== --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <strong>Identitas Data Stuffing</strong>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="date" class="form-control" 
                            value="{{ old('date', $klorin->date) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pukul</label>
                            <input type="time" name="pukul" class="form-control" 
                            value="{{ old('pukul', $klorin->pukul) }}" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===================== PEMERIKSAAN ===================== --}}
            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <strong>Pemeriksaan Klorin</strong>
                </div>

                <div class="card-body p-0">
                    <div class="alert alert-danger mt-2 py-3 px-3" style="font-size: 0.9rem;">
                        <i class="bi bi-info-circle"></i>
                        <strong> Standar Pemeriksaan:</strong>
                        <ul class="mb-2 mt-2">
                            <li>Foot Basin : 200 ppm</li>
                            <li>Hand Basin : 50 - 100 ppm</li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            {{-- FOOTBASIN --}}
                            <div class="col-md-6">
                                <label class="form-label">Foot Basin (Std 200 ppm)</label>
                                <input type="file" id="footbasin" name="footbasin" class="form-control" accept="image/*">
                                <small id="footbasin-error" class="text-danger"></small>

                                @if($klorin->footbasin)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . str_replace('public/', '', $klorin->footbasin)) }}" target="_blank">
                                        <img src="{{ asset('storage/' . str_replace('public/', '', $klorin->footbasin)) }}"
                                        alt="Footbasin"
                                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                    </a>
                                </div>
                                @endif
                            </div>

                            {{-- HANDBASIN --}}
                            <div class="col-md-6">
                                <label class="form-label">Hand Basin (Std 50-100 ppm)</label>
                                <input type="file" id="handbasin" name="handbasin" class="form-control" accept="image/*">
                                <small id="handbasin-error" class="text-danger"></small>

                                @if($klorin->handbasin)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . str_replace('public/', '', $klorin->handbasin)) }}" target="_blank">
                                        <img src="{{ asset('storage/' . str_replace('public/', '', $klorin->handbasin)) }}"
                                        alt="Handbasin"
                                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===================== CATATAN ===================== --}}
            <div class="card mb-4">
                <div class="card-header bg-light"><strong>Catatan</strong></div>
                <div class="card-body">
                    <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan bila ada">{{ old('catatan', $klorin->catatan) }}</textarea>
                </div>
            </div>

            {{-- ===================== TOMBOL ===================== --}}
            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-success" id="submitBtn">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('klorin.verification') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
</div>

{{-- ===================== SCRIPT ===================== --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("klorinEditForm");
        const submitBtn = document.getElementById("submitBtn");
    const maxFileSize = 2 * 1024 * 1024; // 2 MB

    const footInput = document.getElementById("footbasin");
    const handInput = document.getElementById("handbasin");
    const footErr = document.getElementById("footbasin-error");
    const handErr = document.getElementById("handbasin-error");

    // Fungsi cek ukuran file
    function checkFile(input, errorEl) {
        errorEl.textContent = "";
        if (input.files.length > 0) {
            const file = input.files[0];
            if (file.size > maxFileSize) {
                errorEl.textContent = "❌ Ukuran file maksimal 2MB. Pilih file lain.";
                return false;
            }
        }
        return true;
    }

    // Validasi realtime saat user ganti file
    footInput.addEventListener("change", () => checkFile(footInput, footErr));
    handInput.addEventListener("change", () => checkFile(handInput, handErr));

    // Cegah form dikirim kalau invalid
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // ⛔ cegah submit DULU

        const validFoot = checkFile(footInput, footErr);
        const validHand = checkFile(handInput, handErr);

        // kalau ada yang invalid, tampilkan error dan jangan submit
        if (!validFoot || !validHand) {
            return;
        }

        // ✅ kalau semua valid baru kirim manual
        form.submit();
    });
});
</script>

@endsection
