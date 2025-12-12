@extends('layouts.app')

@section('content')
<div class="container-fluid py-0">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ trim(session('success')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="bi bi-list-check"></i> Kontrol Labelisasi PVDC</h3>
                <div class="btn-group" role="group">
                    @can('can access add button')
                    <a href="{{ route('labelisasi_pvdc.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </a>
                    @endcan
                    <button type="button" class="btn btn-danger" id="exportPdfBtn">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                    </button>
                </div>
            </div>

            {{-- Filter Bar --}}
            <form id="filterForm" method="GET" action="{{ route('labelisasi_pvdc.index') }}"
                class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2 border rounded bg-light shadow-sm">
                <div class="input-group" style="max-width: 220px;">
                    <span class="input-group-text bg-white border-end-0"><i
                            class="bi bi-calendar-date text-muted"></i></span>
                    <input type="date" name="date" id="filter_date" class="form-control border-start-0"
                        value="{{ request('date') }}">
                </div>
                <div class="input-group" style="max-width: 200px;">
                    <span class="input-group-text bg-white border-end-0"><i
                            class="bi bi-hourglass-split text-muted"></i></span>
                    <select name="shift" id="filter_shift" class="form-select border-start-0 form-control">
                        <option value="">Semua Shift</option>
                        <option value="1" {{ request("shift")=="1" ? "selected" : "" }}>Shift 1</option>
                        <option value="2" {{ request("shift")=="2" ? "selected" : "" }}>Shift 2</option>
                        <option value="3" {{ request("shift")=="3" ? "selected" : "" }}>Shift 3</option>
                    </select>
                </div>
                <div class="input-group flex-grow-1" style="max-width: 350px;">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" id="search" class="form-control border-start-0"
                        value="{{ request('search') }}" placeholder="Cari Produk / Operator...">
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i> Filter</button>
                <a href="{{ route('labelisasi_pvdc.index') }}" class="btn btn-secondary"><i
                        class="bi bi-arrow-counterclockwise"></i> Reset</a>
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const form = document.getElementById('filterForm');
                    const inputs = [document.getElementById('filter_date'), document.getElementById('filter_shift')];
                    const search = document.getElementById('search');
                    let timer;

                    inputs.forEach(el => el.addEventListener('change', () => form.submit()));
                    search.addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(() => form.submit(), 500); });
                    
                    document.getElementById('exportPdfBtn').addEventListener('click', () => {
                        window.open("{{ route('labelisasi_pvdc.exportPdf') }}?" + new URLSearchParams(new FormData(form)).toString(), '_blank');
                    });
                });
            </script>

            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>NO.</th>
                            <th>Date | Shift</th>
                            <th>Nama Produk</th>
                            <th>Hasil Pemeriksaan</th>
                            <th>QC</th>
                            <th>Operator</th>
                            <th>SPV</th>
                            <th>Verification</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $dep)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage()
                                }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($dep->date)->format('d-m-Y') }} | Shift: {{
                                $dep->shift }}</td>
                            <td class="text-center">{{ $dep->nama_produk }}</td>

                            {{-- Modal Result --}}
                            <td class="text-center">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#resModal{{ $dep->uuid }}"
                                    class="fw-bold text-decoration-underline">Result</a>
                                <div class="modal fade" id="resModal{{ $dep->uuid }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning text-white">
                                                <h5 class="modal-title">Detail Labelisasi PVDC</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body table-responsive">
                                                <table class="table table-bordered table-sm text-center align-middle">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Mesin</th>
                                                            <th>Kode Batch</th>
                                                            <th>Gambar</th>
                                                            <th>Ket</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($dep->labelisasi_detail as $item)
                                                        <tr>
                                                            <td>{{ $item['mesin'] ?? '-' }}</td>

                                                            <td>{{ $item['mincing']->kode_produksi ?? 'Batch tidak
                                                                ditemukan' }}</td>

                                                            <td>
                                                                @if(!empty($item['file']))
                                                                <a href="{{ asset(stripslashes($item['file'])) }}"
                                                                    target="_blank">
                                                                    <img src="{{ asset(stripslashes($item['file'])) }}"
                                                                        width="50" class="img-thumbnail">
                                                                </a>
                                                                @else
                                                                -
                                                                @endif
                                                            </td>

                                                            <td>{{ $item['keterangan'] ?? '-' }}</td>
                                                        </tr>
                                                        @endforeach

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="text-center">{{ $dep->username }}</td>
                            <td class="text-center">{{ $dep->nama_operator }}</td>

                            {{-- Status SPV --}}
                            <td class="text-center">
                                @if ($dep->status_spv == 0)
                                <span class="fw-bold text-secondary">Created</span>
                                @elseif ($dep->status_spv == 1)
                                <span class="fw-bold text-success">Verified</span>
                                @elseif ($dep->status_spv == 2)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#revModal{{ $dep->uuid }}"
                                    class="text-danger fw-bold">Revision</a>
                                {{-- Modal Revision Simple --}}
                                <div class="modal fade" id="revModal{{ $dep->uuid }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5>Detail Revisi</h5><button class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body"><strong>Catatan:</strong> {{ $dep->catatan_spv }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>

                            {{-- Action & Verification --}}
                            <td class="text-center">
                                @can('can access verification button')
                                <button class="btn btn-primary btn-sm fw-bold shadow-sm mb-1" data-bs-toggle="modal"
                                    data-bs-target="#verifyModal{{ $dep->uuid }}"><i class="bi bi-shield-check"></i>
                                    Verifikasi</button>
                                @endcan
                                @can('can access update button')
                                <a href="{{ route('labelisasi_pvdc.update.form', $dep->uuid) }}"
                                    class="btn btn-info btn-sm me-1 mb-1"><i class="bi bi-pencil"></i> Update</a>
                                @endcan
                                @can('can access delete button')
                                <form action="{{ route('labelisasi_pvdc.destroy', $dep->uuid) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Hapus data?')">@csrf
                                    @method('DELETE')<button class="btn btn-danger btn-sm mb-1"><i
                                            class="bi bi-trash"></i></button></form>
                                @endcan

                                {{-- Modal Verification (Gradient Style) --}}
                                <div class="modal fade" id="verifyModal{{ $dep->uuid }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form action="{{ route('labelisasi_pvdc.verification.update', $dep->uuid) }}"
                                            method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden text-white"
                                                style="background: linear-gradient(145deg, #7a1f12, #9E3419);">
                                                <div class="modal-header border-bottom border-light-subtle p-4">
                                                    <h5 class="modal-title fw-bolder text-uppercase"
                                                        style="color: #00ffc4;"><i class="bi bi-gear-fill me-2"></i>
                                                        VERIFICATION</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <label class="d-block text-center fw-bold mb-2"
                                                        style="color: #FFE5DE;">Status</label>
                                                    <select name="status_spv"
                                                        class="form-select form-select-lg fw-bold text-center mb-3"
                                                        style="background: #fff1f0; color: #dc3545;">
                                                        <option value="1" {{ $dep->status_spv==1?'selected':'' }}>✅
                                                            Verified</option>
                                                        <option value="2" {{ $dep->status_spv==2?'selected':'' }}>❌
                                                            Revision</option>
                                                    </select>
                                                    <label class="text-light">Catatan</label>
                                                    <textarea name="catatan_spv" rows="3" class="form-control"
                                                        style="background-color: #FFE5DE;">{{ $dep->catatan_spv }}</textarea>
                                                </div>
                                                <div class="modal-footer border-top p-3"
                                                    style="background-color: #9E3419; border-color: #00ffc4 !important;">
                                                    <button type="button" class="btn btn-outline-light rounded-pill"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn fw-bolder rounded-pill"
                                                        style="background-color: #E39581; color: #2c3e50;">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $data->withQueryString()->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>
<script>
    setTimeout(() => { document.querySelector('.alert')?.classList.remove('show'); }, 3000);
</script>
<style>
    .table td,
    .table th {
        font-size: 0.85rem;
        white-space: nowrap;
    }
</style>
@endsection