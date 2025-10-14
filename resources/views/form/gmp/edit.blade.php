@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-pencil-square"></i> Edit Laporan GMP Patrol</h4>
            <form method="POST" action="{{ route('gmp.update', $gmp->uuid) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Bagian Identitas --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Waktu Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Tanggal</label>
                                <input type="date" id="dateInput" name="date" class="form-control" required
                                       value="{{ old('date', $gmp->date) }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Pemeriksaan --}}
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <strong>Pemeriksaan Area</strong>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-warning mt-2 py-2 px-3" style="font-size: 0.9rem;">
                            <i class="bi bi-info-circle"></i>
                            <strong>Catatan:</strong>  
                            <b>Kosongkan</b> checkbox apabila <u>memakai lengkap</u>.  
                            <strong>Centang</strong> checkbox apabila <u>tidak memakai</u> atau <u>memakai namun tidak benar</u>.
                        </div>

                        {{-- Ribbon Menu --}}
                        <ul class="nav nav-tabs" id="areaTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="mp-chamber-tab" data-bs-toggle="tab" data-bs-target="#mp-chamber" type="button" role="tab">
                                    MP - CHAMBER
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="karantina-packing-tab" data-bs-toggle="tab" data-bs-target="#karantina-packing" type="button" role="tab">
                                    KARANTINA - PACKING
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="filling-susun-tab" data-bs-toggle="tab" data-bs-target="#filling-susun" type="button" role="tab">
                                    FILLING - SUSUN
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="sampling-fg-tab" data-bs-toggle="tab" data-bs-target="#sampling-fg" type="button" role="tab">
                                    SAMPLING FG
                                </button>
                            </li>
                        </ul>

                        {{-- Isi Tab --}}
                        <div class="tab-content mt-3" id="areaTabsContent">

                            {{-- MP - CHAMBER --}}
                            <div class="tab-pane fade show active" id="mp-chamber" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered text-center align-middle compact-table">
                                        <thead class="table-info">
                                            <tr>
                                                <th>Nama Karyawan</th>
                                                <th>Seragam</th>
                                                <th>Boot</th>
                                                <th>Masker</th>
                                                <th>Ciput</th>
                                                <th>Parfum</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($karyawanMp as $i => $nama_karyawan)
                                            <tr>
                                                <td>{{ $nama_karyawan }}
                                                    <input type="hidden" name="mp_chamber[{{ $i }}][nama_karyawan]" value="{{ $nama_karyawan }}">
                                                </td>
                                                @php
                                                    $oldData = $gmp->mp_chamber[$i] ?? [];
                                                @endphp
                                                <td>
                                                    <input type="hidden" name="mp_chamber[{{ $i }}][seragam]" value="0">
                                                    <input type="checkbox" name="mp_chamber[{{ $i }}][seragam]" value="1" {{ (isset($oldData['seragam']) && $oldData['seragam']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="mp_chamber[{{ $i }}][boot]" value="0">
                                                    <input type="checkbox" name="mp_chamber[{{ $i }}][boot]" value="1" {{ (isset($oldData['boot']) && $oldData['boot']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="mp_chamber[{{ $i }}][masker]" value="0">
                                                    <input type="checkbox" name="mp_chamber[{{ $i }}][masker]" value="1" {{ (isset($oldData['masker']) && $oldData['masker']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="mp_chamber[{{ $i }}][ciput]" value="0">
                                                    <input type="checkbox" name="mp_chamber[{{ $i }}][ciput]" value="1" {{ (isset($oldData['ciput']) && $oldData['ciput']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="mp_chamber[{{ $i }}][parfum]" value="0">
                                                    <input type="checkbox" name="mp_chamber[{{ $i }}][parfum]" value="1" {{ (isset($oldData['parfum']) && $oldData['parfum']==1)?'checked':'' }}>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Karantina - Packing --}}
                            <div class="tab-pane fade" id="karantina-packing" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered text-center align-middle compact-table">
                                        <thead class="table-warning">
                                            <tr>
                                                <th>Nama Karyawan</th>
                                                <th>Seragam</th>
                                                <th>Boot</th>
                                                <th>Masker</th>
                                                <th>Ciput</th>
                                                <th>Parfum</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($karyawanKarantina as $i => $nama_karyawan)
                                            <tr>
                                                <td>{{ $nama_karyawan }}
                                                    <input type="hidden" name="karantina_packing[{{ $i }}][nama_karyawan]" value="{{ $nama_karyawan }}">
                                                </td>
                                                @php
                                                    $oldData = $gmp->karantina_packing[$i] ?? [];
                                                @endphp
                                                <td>
                                                    <input type="hidden" name="karantina_packing[{{ $i }}][seragam]" value="0">
                                                    <input type="checkbox" name="karantina_packing[{{ $i }}][seragam]" value="1" {{ (isset($oldData['seragam']) && $oldData['seragam']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="karantina_packing[{{ $i }}][boot]" value="0">
                                                    <input type="checkbox" name="karantina_packing[{{ $i }}][boot]" value="1" {{ (isset($oldData['boot']) && $oldData['boot']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="karantina_packing[{{ $i }}][masker]" value="0">
                                                    <input type="checkbox" name="karantina_packing[{{ $i }}][masker]" value="1" {{ (isset($oldData['masker']) && $oldData['masker']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="karantina_packing[{{ $i }}][ciput]" value="0">
                                                    <input type="checkbox" name="karantina_packing[{{ $i }}][ciput]" value="1" {{ (isset($oldData['ciput']) && $oldData['ciput']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="karantina_packing[{{ $i }}][parfum]" value="0">
                                                    <input type="checkbox" name="karantina_packing[{{ $i }}][parfum]" value="1" {{ (isset($oldData['parfum']) && $oldData['parfum']==1)?'checked':'' }}>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Filling - Susun --}}
                            <div class="tab-pane fade" id="filling-susun" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered text-center align-middle compact-table">
                                        <thead class="table-success">
                                            <tr>
                                                <th>Nama Karyawan</th>
                                                <th>Seragam</th>
                                                <th>Boot</th>
                                                <th>Masker</th>
                                                <th>Ciput</th>
                                                <th>Parfum</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($karyawanFilling as $i => $nama_karyawan)
                                            <tr>
                                                <td>{{ $nama_karyawan }}
                                                    <input type="hidden" name="filling_susun[{{ $i }}][nama_karyawan]" value="{{ $nama_karyawan }}">
                                                </td>
                                                @php
                                                    $oldData = $gmp->filling_susun[$i] ?? [];
                                                @endphp
                                                <td>
                                                    <input type="hidden" name="filling_susun[{{ $i }}][seragam]" value="0">
                                                    <input type="checkbox" name="filling_susun[{{ $i }}][seragam]" value="1" {{ (isset($oldData['seragam']) && $oldData['seragam']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="filling_susun[{{ $i }}][boot]" value="0">
                                                    <input type="checkbox" name="filling_susun[{{ $i }}][boot]" value="1" {{ (isset($oldData['boot']) && $oldData['boot']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="filling_susun[{{ $i }}][masker]" value="0">
                                                    <input type="checkbox" name="filling_susun[{{ $i }}][masker]" value="1" {{ (isset($oldData['masker']) && $oldData['masker']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="filling_susun[{{ $i }}][ciput]" value="0">
                                                    <input type="checkbox" name="filling_susun[{{ $i }}][ciput]" value="1" {{ (isset($oldData['ciput']) && $oldData['ciput']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="filling_susun[{{ $i }}][parfum]" value="0">
                                                    <input type="checkbox" name="filling_susun[{{ $i }}][parfum]" value="1" {{ (isset($oldData['parfum']) && $oldData['parfum']==1)?'checked':'' }}>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Sampling FG --}}
                            <div class="tab-pane fade" id="sampling-fg" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered text-center align-middle compact-table">
                                        <thead class="table-success">
                                            <tr>
                                                <th>Nama Karyawan</th>
                                                <th>Seragam</th>
                                                <th>Boot</th>
                                                <th>Masker</th>
                                                <th>Ciput</th>
                                                <th>Parfum</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($karyawanSampling as $i => $nama_karyawan)
                                            <tr>
                                                <td>{{ $nama_karyawan }}
                                                    <input type="hidden" name="sampling_fg[{{ $i }}][nama_karyawan]" value="{{ $nama_karyawan }}">
                                                </td>
                                                @php
                                                    $oldData = $gmp->sampling_fg[$i] ?? [];
                                                @endphp
                                                <td>
                                                    <input type="hidden" name="sampling_fg[{{ $i }}][seragam]" value="0">
                                                    <input type="checkbox" name="sampling_fg[{{ $i }}][seragam]" value="1" {{ (isset($oldData['seragam']) && $oldData['seragam']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="sampling_fg[{{ $i }}][boot]" value="0">
                                                    <input type="checkbox" name="sampling_fg[{{ $i }}][boot]" value="1" {{ (isset($oldData['boot']) && $oldData['boot']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="sampling_fg[{{ $i }}][masker]" value="0">
                                                    <input type="checkbox" name="sampling_fg[{{ $i }}][masker]" value="1" {{ (isset($oldData['masker']) && $oldData['masker']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="sampling_fg[{{ $i }}][ciput]" value="0">
                                                    <input type="checkbox" name="sampling_fg[{{ $i }}][ciput]" value="1" {{ (isset($oldData['ciput']) && $oldData['ciput']==1)?'checked':'' }}>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="sampling_fg[{{ $i }}][parfum]" value="0">
                                                    <input type="checkbox" name="sampling_fg[{{ $i }}][parfum]" value="1" {{ (isset($oldData['parfum']) && $oldData['parfum']==1)?'checked':'' }}>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <strong>Catatan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Tambahkan catatan bila ada">{{ old('catatan', $gmp->catatan) }}</textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto">
                        <i class="bi bi-save"></i> Perbarui
                    </button>
                    <a href="{{ route('gmp.index') }}" class="btn btn-secondary w-auto">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Script set tanggal otomatis --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("dateInput");
        if(!dateInput.value){
            let now = new Date();
            let yyyy = now.getFullYear();
            let mm = String(now.getMonth() + 1).padStart(2, '0');
            let dd = String(now.getDate()).padStart(2, '0');
            dateInput.value = `${yyyy}-${mm}-${dd}`;
        }
    });
</script>

{{-- CSS compact --}}
<style>
    .compact-table td, .compact-table th {
        padding: 0.3rem !important;
        font-size: 0.85rem;
        line-height: 1.2;
    }
</style>
@endsection
