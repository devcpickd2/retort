@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="bi bi-plus-circle"></i> Form Input Pemeriksaan Suhu dan RH
            </h4>

            <form id="suhuForm" action="{{ route('suhu.store') }}" method="POST">
                @csrf

                {{-- ===================== IDENTITAS DATA ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Pemeriksaan Suhu</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="date" id="dateInput" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select name="shift" id="shiftInput" class="form-control" required>
                                    <option value="">-- Pilih Shift --</option>
                                    <option value="1">Shift 1</option>
                                    <option value="2">Shift 2</option>
                                    <option value="3">Shift 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Pukul</label>
                                <input type="time" id="timeInput" name="pukul" class="form-control" step="3600" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <strong>Input Suhu Area</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr class="text-center">
                                        <th style="width: 5%">No</th>
                                        <th>Area</th>
                                        <th>Standar Suhu (°C)</th>
                                        <th>Hasil Suhu (°C)</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($area_suhus as $index => $area)
                                    @php
                                    // Cari nilai suhu berdasarkan nama area
                                    $matched = collect($suhuData)->firstWhere('area', $area->area);
                                    $nilai = $matched['nilai'] ?? '';
                                    @endphp

                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <input type="hidden" name="hasil_suhu[a{{ $index }}][area]" value="{{ $area->area }}">
                                            {{ $area->area }}
                                        </td>
                                        <td class="text-center">{{ $area->standar }}</td>
                                        <td>
                                            <input
                                            type="number"
                                            step="0.1"
                                            name="hasil_suhu[a{{ $index }}][nilai]"
                                            value="{{ $nilai }}"
                                            class="form-control suhu-input"
                                            data-standar="{{ $area->standar }}"
                                            placeholder="Masukkan suhu">

                                            <small class="text-danger warning-msg d-none">
                                                ⚠️ Suhu di luar standar!
                                            </small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                {{-- ===================== CATATAN ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-light"><strong>Keterangan</strong></div>
                    <div class="card-body">
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan bila ada">{{ old('keterangan') }}</textarea>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header bg-light"><strong>Catatan</strong></div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan bila ada">{{ old('catatan') }}</textarea>
                    </div>
                </div>

                {{-- ===================== TOMBOL ===================== --}}
                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('suhu.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // ====== Set tanggal & shift otomatis ======
        const dateInput = document.getElementById("dateInput");
        const shiftInput = document.getElementById("shiftInput");
        const now = new Date();
        const yyyy = now.getFullYear();
        const mm = String(now.getMonth() + 1).padStart(2, '0');
        const dd = String(now.getDate()).padStart(2, '0');
        const hh = now.getHours();

        dateInput.value = `${yyyy}-${mm}-${dd}`;
        if (hh >= 7 && hh < 15) shiftInput.value = "1";
        else if (hh >= 15 && hh < 23) shiftInput.value = "2";
        else shiftInput.value = "3";

    // ====== Validasi Suhu per Area ======
        const inputs = document.querySelectorAll('.suhu-input');

    // buat regex via constructor agar Blade tidak salah baca "<?"
        const lessThanPattern = new RegExp('^<' + '?=?\\s*-?\\d+(?:\\.\\d+)?$');
        const numberExtractPattern = /-?\d+(?:\.\d+)?/g;

        inputs.forEach(function (input) {
            input.addEventListener('input', function () {
                const val = parseFloat(this.value);
                const standarText = (this.getAttribute('data-standar') || '').trim();
                const warningMsg = this.parentElement.querySelector('.warning-msg');

            // Reset
                this.classList.remove('is-invalid');
                warningMsg.classList.add('d-none');
                if (isNaN(val) || !standarText) return;

                let min = null, max = null;

            // format "<10" atau "≤10"
                if (lessThanPattern.test(standarText)) {
                    const limit = parseFloat(standarText.replace(/[^\d.-]/g, ''));
                    if (!isNaN(limit) && val > limit) {
                        warningMsg.textContent = `⚠️ Nilai melebihi batas < ${limit}°C`;
                        warningMsg.classList.remove('d-none');
                        this.classList.add('is-invalid');
                    }
                }
                else {
                // format rentang "(-18) - (-22)" atau "0 - 4" atau "25 - 36"
                    const matches = standarText.replace(/[()]/g, '').match(numberExtractPattern);
                    if (matches && matches.length >= 2) {
                        min = parseFloat(matches[0]);
                        max = parseFloat(matches[1]);

                    // Tukar bila terbalik
                        if (min > max) [min, max] = [max, min];

                        if (val < min || val > max) {
                            warningMsg.textContent = `⚠️ Nilai di luar standar (${min} – ${max}°C)`;
                            warningMsg.classList.remove('d-none');
                            this.classList.add('is-invalid');
                        }
                    }
                }
            });
        });
    });
</script>
<script>
    document.getElementById('timeInput').addEventListener('input', function() {
        let val = this.value; 
        if(val){
            let jam = val.split(':')[0];
            this.value = jam.padStart(2,'0') + ':00'; 
        }
    });
</script>
@endpush

@endsection
