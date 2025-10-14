@extends('layouts.app')

@section('content')
<div class="container-fluid py-0">
    {{-- Alert sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ trim(session('success')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Notifikasi error --}}
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="bi bi-list-check"></i> Data GMP Karyawan</h3>
            </div>

            {{-- Filter dan Search --}}
            <form method="GET" action="{{ route('gmp.verification') }}" class="row g-2 mb-3">
                <div class="col-md-3">
                    <input type="date" name="start_date" class="form-control"
                    value="{{ request('start_date') }}" placeholder="Tanggal awal">
                </div>
                <div class="col-md-3">
                    <input type="date" name="end_date" class="form-control"
                    value="{{ request('end_date') }}" placeholder="Tanggal akhir">
                </div>
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control"
                    value="{{ request('search') }}" placeholder="Cari Nama...">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('gmp.verification') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                </div>
            </form>

            {{-- Tambahkan table-responsive agar tabel tidak keluar border --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>NO.</th>
                            <th>Date</th>
                            <th>MP - CHAMBER</th>
                            <th>KARANTINA - PACKING</th>
                            <th>FILLING - SUSUN</th>
                            <th>SAMPLING FG</th>
                            <th>Produksi</th>
                            <th>SPV</th>
                            <th>Verification</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                        $no = ($data->currentPage() - 1) * $data->perPage() + 1; 
                        @endphp
                        @forelse ($data as $dep)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ \Carbon\Carbon::parse($dep->date)->format('d-m-Y') }}</td>   
                            @php
                            if (!function_exists('hitungPresentase')) {
                                function hitungPresentase($json) {
                                    if (!$json) return 0;

                                    $data = is_array($json) ? $json : json_decode($json, true);
                                    if (!$data) return 0;

                                    $total = 0;
                                    $count = 0;

                                    foreach ($data as $row) {
                                        foreach ($row as $key => $val) {
                                            if ($key !== 'nama_karyawan') {
                                                $total++;
                                                if ($val == 1) $count++;
                                            }
                                        }
                                    }

                                    return $total > 0 ? round(($count / $total) * 100, 1) : 0;
                                }
                            }

                            if (!function_exists('topKaryawan')) {
                                function topKaryawan($json, $limit = 3) {
                                    if (!$json) return [];

                                    $data = is_array($json) ? $json : json_decode($json, true);
                                    if (!$data) return [];

                                    $scores = [];
                                    foreach ($data as $row) {
                                        $nama = $row['nama_karyawan'] ?? 'Tanpa Nama';
                                        $count = 0;
                                        foreach ($row as $key => $val) {
                                            if ($key !== 'nama_karyawan' && $val == 1) $count++;
                                        }
                                        $scores[] = ['nama' => $nama, 'nilai' => $count];
                                    }

                                    usort($scores, function($a, $b) { return $b['nilai'] <=> $a['nilai']; });

                                        return array_slice($scores, 0, $limit);
                                    }
                                }
                                @endphp

                                {{-- Pemakaian di tabel --}}
                                <td>
                                    {{ hitungPresentase($dep->mp_chamber) }} %
                                    <br>
                                    <small>
                                        @foreach(topKaryawan($dep->mp_chamber) as $row)
                                        • {{ $row['nama'] }} ({{ $row['nilai'] }})<br>
                                        @endforeach
                                    </small>
                                </td>

                                <td>
                                    {{ hitungPresentase($dep->karantina_packing) }} %
                                    <br>
                                    <small>
                                        @foreach(topKaryawan($dep->karantina_packing) as $row)
                                        • {{ $row['nama'] }} ({{ $row['nilai'] }})<br>
                                        @endforeach
                                    </small>
                                </td>

                                <td>
                                    {{ hitungPresentase($dep->filling_susun) }} %
                                    <br>
                                    <small>
                                        @foreach(topKaryawan($dep->filling_susun) as $row)
                                        • {{ $row['nama'] }} ({{ $row['nilai'] }})<br>
                                        @endforeach
                                    </small>
                                </td>
                                
                                <td>
                                    {{ hitungPresentase($dep->sampling_fg) }} %
                                    <br>
                                    <small>
                                        @foreach(topKaryawan($dep->sampling_fg) as $row)
                                        • {{ $row['nama'] }} ({{ $row['nilai'] }})<br>
                                        @endforeach
                                    </small>
                                </td>
                                
                                <td>{{ $dep->nama_produksi }}</td>
                                <td class="text-center align-middle">
                                    @if ($dep->status_spv == 0)
                                    <span class="fw-bold text-secondary">Created</span>
                                    @elseif ($dep->status_spv == 1)
                                    <span class="fw-bold text-success">Verified</span>
                                    @elseif ($dep->status_spv == 2)
                                    <!-- Link buka modal -->
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#revisionModal{{ $dep->uuid }}" 
                                     class="text-danger fw-bold text-decoration-none" style="cursor: pointer;">Revision</a>
                                     <!-- Modal -->
                                     <div class="modal fade" id="revisionModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="revisionModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="revisionModalLabel{{ $dep->uuid }}">Detail Revisi</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-unstyled mb-0">
                                                        <li><strong>Status:</strong> Revision</li>
                                                        <li><strong>Catatan:</strong> {{ $dep->catatan_spv ?? '-' }}</li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-primary btn-sm fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#verifyModal{{ $dep->uuid }}">
                                        <i class="bi bi-shield-check me-1"></i> Verifikasi
                                    </button>

                                    <div class="modal fade" id="verifyModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="verifyModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <form action="{{ route('gmp.verification.update', $dep->uuid) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden text-white" 
                                                style="background: linear-gradient(145deg, #7a1f12, #9E3419); 
                                                box-shadow: 0 15px 40px rgba(0,0,0,0.5);">
                                                <div class="modal-header border-bottom border-light-subtle p-4" style="border-bottom-width: 3px !important;">
                                                    <h5 class="modal-title fw-bolder fs-3 text-uppercase" id="verifyModalLabel{{ $dep->uuid }}" style="color: #00ffc4;">
                                                        <i class="bi bi-gear-fill me-2"></i> VERIFICATION
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body p-5">
                                                    <p class="text-light mb-4 fs-6">
                                                        Pastikan data yang akan diverifikasi di check dengan teliti terlebih dahulu.
                                                    </p>
                                                    <div class="row g-4">
                                                        <div class="col-md-12">
                                                            <label for="status_spv_{{ $dep->uuid }}" class="form-label fw-bold mb-2 text-center d-block" 
                                                             style="color: #FFE5DE; font-size: 0.95rem;">
                                                             Pilih Status Verifikasi
                                                         </label>

                                                         <select 
                                                         name="status_spv" 
                                                         id="status_spv_{{ $dep->uuid }}" 
                                                         class="form-select form-select-lg fw-bold text-center mx-auto"
                                                         style="
                                                         background: linear-gradient(135deg, #fff1f0, #ffe5de);
                                                         border: 2px solid #dc3545;
                                                         border-radius: 12px;
                                                         color: #dc3545;
                                                         height: 55px;
                                                         font-size: 1.1rem;
                                                         box-shadow: 0 6px 12px rgba(0,0,0,0.1);
                                                         width: 85%;
                                                         transition: all 0.3s ease;
                                                         "
                                                         required
                                                         >
                                                         <option value="1" {{ $dep->status_spv == 1 ? 'selected' : '' }} 
                                                             style="color: #198754; font-weight: 600;">✅ Verified (Disetujui)</option>
                                                             <option value="2" {{ $dep->status_spv == 2 ? 'selected' : '' }} 
                                                                 style="color: #dc3545; font-weight: 600;">❌ Revision (Perlu Perbaikan)</option>
                                                             </select>
                                                         </div>

                                                         <div class="col-md-12 mt-3">
                                                            <label for="catatan_spv_{{ $dep->uuid }}" class="form-label fw-bold text-light mb-2">
                                                                Catatan Tambahan (Opsional)
                                                            </label>
                                                            <textarea name="catatan_spv" id="catatan_spv_{{ $dep->uuid }}" rows="4" 
                                                              class="form-control text-dark border-0 shadow-none" 
                                                              placeholder="Masukkan catatan, misalnya alasan revisi..." 
                                                              style="background-color: #FFE5DE; height: 120px;">
                                                              {{ $dep->catatan_spv }}
                                                          </textarea>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="modal-footer justify-content-end p-4 border-top" style="background-color: #9E3419; border-color: #00ffc4 !important;">
                                                <button type="button" class="btn btn-outline-light fw-bold rounded-pill px-4 me-2" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn fw-bolder rounded-pill px-5" style="background-color: #E39581; color: #2c3e50;">
                                                    <i class="bi bi-save-fill me-1"></i> SUBMIT
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="19" class="text-center">Belum ada data gmp karyawan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form action="{{ route('gmp.export') }}" method="GET" class="row g-2 align-items-center">

                {{-- Pilih Bulan --}}
                <div class="col-auto">
                    <label for="date" class="col-form-label fw-semibold">Pilih Bulan</label>
                </div>
                <div class="col-auto">
                    <input type="month" id="date" name="date" 
                    class="form-control form-control-sm"
                    value="{{ request('date') }}" required>
                </div>

                {{-- Pilih Atribut --}}
                <div class="col-auto">
                    <label for="atribut" class="col-form-label fw-semibold">Area</label>
                </div>
                <div class="col-auto">
                    <select id="atribut" name="atribut" class="form-control form-control-sm" required>
                        <option value="">-- Pilih Area --</option>
                        <option value="mp_chamber" {{ request('atribut') == 'mp_chamber' ? 'selected' : '' }}>MP-CHAMBER</option>
                        <option value="karantina_packing" {{ request('atribut') == 'karantina_packing' ? 'selected' : '' }}>KARANTINA-PACKING</option>
                        <option value="filling_susun" {{ request('atribut') == 'filling_susun' ? 'selected' : '' }}>FILLING-SUSUN</option>
                        <option value="sampling_fg" {{ request('atribut') == 'sampling_fg' ? 'selected' : '' }}>SAMPLING-FG</option>
                    </select>
                </div>

                {{-- Button --}}
                <div class="col-auto">
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-file-earmark-excel"></i> Export Excel
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
</div>
</div>

{{-- Auto-hide alert setelah 3 detik --}}
<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if(alert){
            alert.classList.remove('show');
            alert.classList.add('fade');
        }
    }, 3000);
</script>

{{-- CSS tambahan agar tabel lebih rapi --}}
<style>
    .table td, .table th {
        font-size: 0.85rem;
        white-space: nowrap; 
    }
    .text-danger {
        font-weight: bold;
    }
    .text-muted.fst-italic {
        color: #6c757d !important;
        font-style: italic !important;
    }
    .container {
        padding-left: 2px !important;
        padding-right: 2px !important;
    }
    /* Header tabel merah */
    .table thead {
        background-color: #dc3545 !important;
        color: #fff;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8d7da;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #f5c2c7; 
    }

/* Hover baris merah gelap */
.table tbody tr:hover {
    background-color: #e4606d !important;
    color: #fff;
}

/* Border tabel merah */
.table-bordered th, .table-bordered td {
    border-color: #dc3545;
}

/* Tombol aksi tetap jelas */
.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #b02a37;
    border-color: #a52834;
}
</style>
@endsection
