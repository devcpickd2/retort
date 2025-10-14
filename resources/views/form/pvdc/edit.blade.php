@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Data No. Lot PVDC</h4>

            <form method="POST" action="{{ route('pvdc.update', $pvdc->uuid) }}">
                @csrf
                @method('PUT')

                {{-- ===================== Bagian Identitas ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Data PVDC</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="date" class="form-control"
                                value="{{ old('date', $pvdc->date) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select name="shift" class="form-control" required>
                                    <option value="1" {{ $pvdc->shift == 1 ? 'selected' : '' }}>Shift 1</option>
                                    <option value="2" {{ $pvdc->shift == 2 ? 'selected' : '' }}>Shift 2</option>
                                    <option value="3" {{ $pvdc->shift == 3 ? 'selected' : '' }}>Shift 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Produk</label>
                                <select id="nama_produk" name="nama_produk" class="form-control selectpicker" data-live-search="true" title="Ketik nama produk..." required>
                                    @foreach($produks as $produk)
                                    <option value="{{ $produk->nama_produk }}" {{ $pvdc->nama_produk == $produk->nama_produk ? 'selected' : '' }}>
                                        {{ $produk->nama_produk }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Kedatangan PVDC</label>
                                <input type="date" name="tgl_kedatangan" class="form-control" value="{{ old('tgl_kedatangan', $pvdc->tgl_kedatangan) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Expired</label>
                                <input type="date" name="tgl_expired" class="form-control" value="{{ old('tgl_expired', $pvdc->tgl_expired) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                        <strong>Data PVDC</strong>
                        <button type="button" id="addMesinRow" class="btn btn-primary btn-sm">+ Tambah Mesin</button>
                    </div>

                    <div class="card-body table-responsive" style="overflow-x:auto;">
                        <div class="alert alert-danger mt-2 py-2 px-3" style="font-size: 0.9rem;">
                            <i class="bi bi-info-circle"></i>
                            <strong>Catatan:</strong>
                            <i class="bi bi-check-circle text-success"></i> Checkbox apabila hasil <u>Oke</u>.
                            Kosongkan Checkbox apabila hasil <u>Tidak Oke</u>.
                        </div>

                        <table class="table table-bordered table-sm text-center align-middle" id="pvdcTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Mesin</th>
                                    <th>Batch</th>
                                    <th>No. Lot</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="pvdcBody">
                                @php
                                $dataPvdc = json_decode($pvdc->data_pvdc, true) ?? [];
                                @endphp

                                @foreach($dataPvdc as $mi => $mesin)
                                @foreach($mesin['detail'] as $bi => $detail)
                                <tr class="{{ $bi == 0 ? 'mesin-row' : 'batch-row' }}">
                                    @if($bi == 0)
                                    <td rowspan="{{ count($mesin['detail']) }}" class="mesin-cell">
                                        <select name="data_pvdc[{{ $mi }}][mesin]" class="form-control form-control-sm mesin-input">
                                            <option value="">-- Pilih Mesin --</option>
                                            @foreach($mesins as $m)
                                            <option value="{{ $m->nama_mesin }}" {{ ($mesin['mesin'] ?? '') == $m->nama_mesin ? 'selected' : '' }}>
                                                {{ $m->nama_mesin }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    @endif

                                    <td><input type="text" name="data_pvdc[{{ $mi }}][detail][{{ $bi }}][batch]" value="{{ $detail['batch'] ?? '' }}" class="form-control form-control-sm"></td>
                                    <td><input type="text" name="data_pvdc[{{ $mi }}][detail][{{ $bi }}][no_lot]" value="{{ $detail['no_lot'] ?? '' }}" class="form-control form-control-sm"></td>
                                    <td><input type="time" name="data_pvdc[{{ $mi }}][detail][{{ $bi }}][waktu]" value="{{ $detail['waktu'] ?? '' }}" class="form-control form-control-sm"></td>
                                    <td>
                                        @if($bi == 0)
                                        <button type="button" class="btn btn-success btn-sm addBatchRow">+ Batch</button>
                                        @endif
                                        <button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- ===================== Catatan ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-light"><strong>Catatan</strong></div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan bila ada">{{ old('catatan', $pvdc->catatan) }}</textarea>
                    </div>
                </div>

                {{-- ===================== Tombol Simpan ===================== --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto"><i class="bi bi-save"></i> Update Data</button>
                    <a href="{{ route('pvdc.index') }}" class="btn btn-secondary w-auto"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===================== SCRIPT ===================== --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let mesinIndex = {{ count($dataPvdc) }};

    // Tambah Mesin Baru
        document.getElementById('addMesinRow').addEventListener('click', function() {
            const newRow = `
            <tr class="mesin-row">
                <td rowspan="1" class="mesin-cell">
                    <select name="data_pvdc[${mesinIndex}][mesin]" class="form-control form-control-sm mesin-input">
                        <option value="">-- Pilih Mesin --</option>
                        @foreach($mesins as $m)
                            <option value="{{ $m->nama_mesin }}">{{ $m->nama_mesin }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" name="data_pvdc[${mesinIndex}][detail][0][batch]" class="form-control form-control-sm"></td>
                <td><input type="text" name="data_pvdc[${mesinIndex}][detail][0][no_lot]" class="form-control form-control-sm"></td>
                <td><input type="time" name="data_pvdc[${mesinIndex}][detail][0][waktu]" class="form-control form-control-sm"></td>
                <td>
                    <button type="button" class="btn btn-success btn-sm addBatchRow">+ Batch</button>
                    <button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button>
                </td>
            </tr>
            `;
            document.querySelector('#pvdcBody').insertAdjacentHTML('beforeend', newRow);
            mesinIndex++;
        });

    // Delegasi Event
        document.querySelector('#pvdcBody').addEventListener('click', function(e) {
            const target = e.target;

        // Tambah Batch Baru
            if (target.classList.contains('addBatchRow')) {
                const mesinRow = target.closest('.mesin-row');
                const mesinCell = mesinRow.querySelector('.mesin-cell');
                const currentRowspan = parseInt(mesinCell.getAttribute('rowspan')) || 1;
                const mesinIdx = mesinRow.querySelector('.mesin-input').name.match(/\d+/)[0];
                const batchIdx = currentRowspan;

            // Baris batch baru
                const newBatchRow = `
                <tr class="batch-row">
                    <td><input type="text" name="data_pvdc[${mesinIdx}][detail][${batchIdx}][batch]" class="form-control form-control-sm"></td>
                    <td><input type="text" name="data_pvdc[${mesinIdx}][detail][${batchIdx}][no_lot]" class="form-control form-control-sm"></td>
                    <td><input type="time" name="data_pvdc[${mesinIdx}][detail][${batchIdx}][waktu]" class="form-control form-control-sm"></td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button></td>
                </tr>
                `;

            // ✅ Cari batch terakhir dari mesin yang sama
                let lastBatchRow = mesinRow;
                let nextRow = mesinRow.nextElementSibling;
                while (nextRow && !nextRow.classList.contains('mesin-row')) {
                    lastBatchRow = nextRow;
                    nextRow = nextRow.nextElementSibling;
                }

            // Tambahkan batch baru di bawah batch terakhir
                lastBatchRow.insertAdjacentHTML('afterend', newBatchRow);
                mesinCell.setAttribute('rowspan', currentRowspan + 1);
            }

        // Hapus Baris
            if (target.classList.contains('removeRow')) {
                const row = target.closest('tr');
                const mesinRow = row.classList.contains('mesin-row') ? row : row.previousElementSibling.closest('.mesin-row');

                if (row.classList.contains('mesin-row')) {
                // Hapus semua batch milik mesin tersebut
                    let nextRow = row.nextElementSibling;
                    while (nextRow && !nextRow.classList.contains('mesin-row')) {
                        const temp = nextRow.nextElementSibling;
                        nextRow.remove();
                        nextRow = temp;
                    }
                    row.remove();
                } else {
                    row.remove();
                    const mesinCell = mesinRow.querySelector('.mesin-cell');
                    mesinCell.setAttribute('rowspan', parseInt(mesinCell.getAttribute('rowspan')) - 1);
                }
            }
        });
    });
</script>

<style>
    .table-bordered th, .table-bordered td { text-align: center; vertical-align: middle; }
    .form-control-sm { min-width: 120px; }
</style>
@endsection
