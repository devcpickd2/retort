@extends('layouts.app') {{-- Menggunakan layout utama Anda --}}

{{-- Mendefinisikan bagian style kustom --}}
@push('styles')
{{-- Menambahkan link untuk Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
{{-- 1. Include Select2 CSS --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{-- Optional: Theme for Select2 to match Bootstrap 5 --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<style>
    /* Mengubah font utama untuk tampilan yang lebih modern */
    body {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
    }
    /* Kustomisasi label */
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    /* Kustomisasi input, select, dan textarea */
    .form-control, .form-select {
        border-radius: 8px;
    }
    
    /* Memastikan Select2 sesuai dengan tinggi Bootstrap */
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px); /* Match Bootstrap's input height */
        padding: .375rem .75rem;
        border: 1px solid #ced4da;
    }
    .select2-container--bootstrap-5 .select2-selection {
        border-radius: 8px !important;
    }
    .select2-container--bootstrap-5.select2-container--focus .select2-selection,
    .select2-container--bootstrap-5.select2-container--open .select2-selection {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    /* Style untuk tombol OK/Not OK */
    .btn-check-group .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
    }
    .btn-check-group .btn-outline-success,
    .btn-check-group .btn-outline-danger {
        font-weight: 600;
    }

    /* Style untuk item dinamis */
    .dynamic-item-card {
        background-color: #fdfdfd;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
</style>
@endpush

{{-- Mendefinisikan bagian konten --}}
@section('content')
<div class="container-fluid py-0">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4 p-md-5">

            <h4 class="mb-1"><i class="bi bi-pencil-square"></i> Edit Pemeriksaan Packaging #{{ $packagingInspection->id }}</h4>
            <p class="text-muted mb-4">Perbarui detail formulir pemeriksaan packaging di bawah ini.</p>

            {{-- Tampilkan error jika ada --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops! Ada beberapa masalah dengan input Anda:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('packaging-inspections.update', $packagingInspection->uuid) }}" method="POST">
                @csrf
                @method('PUT') {{-- Method untuk update --}}

                {{-- CARD INFORMASI UMUM --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong><i class="bi bi-info-circle-fill"></i> Informasi Inspeksi</strong>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="inspection_date" class="form-label">Hari/Tanggal</label>
                                <input type="date" class="form-control @error('inspection_date') is-invalid @enderror" id="inspection_date" name="inspection_date" value="{{ old('inspection_date', $packagingInspection->inspection_date) }}" required>
                                @error('inspection_date') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="shift" class="form-label">Shift</label>
                                <input type="text" class="form-control @error('shift') is-invalid @enderror" id="shift" name="shift" value="{{ old('shift', $packagingInspection->shift) }}" required>
                                @error('shift') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD DETAIL ITEM (DINAMIS) --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong><i class="bi bi-list-nested"></i> Detail Item Packaging</strong>
                            <button type="button" id="add-detail-btn" class="btn btn-secondary btn-sm"><i class="bi bi-plus-lg"></i> Tambah Item</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="details-container">
                            {{-- Item dinamis akan ditambahkan di sini oleh JS --}}
                        </div>
                    </div>
                </div>
                
                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-check-circle"></i> Update Inspeksi</button>
                    <a href="{{ route('packaging-inspections.index') }}" class="btn btn-secondary btn-lg"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- 1. Include jQuery (Select2 depends on it) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- 2. Include Select2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // 3. Initialize Select2 (untuk dropdown statis jika ada)
    $(document).ready(function() {
        $('.select2-static').select2({
            theme: "bootstrap-5",
            placeholder: "Ketik untuk mencari...",
            allowClear: true,
            dropdownAutoWidth: true
        });
    });

    // 4. Script untuk form dinamis dan tombol OK/Not OK
    document.addEventListener('DOMContentLoaded', function() {
        
        const container = document.getElementById('details-container');
        const addBtn = document.getElementById('add-detail-btn');
        let detailIndex = 0;

        // Data dari PHP untuk dropdown
        const vehicleConditions = @json($vehicleConditions);
        // Buat string HTML untuk options
        const vehicleOptions = vehicleConditions.map(c => `<option value="${c}">${c}</option>`).join('');

        /**
         * Fungsi untuk merender form detail, bisa dengan data (untuk old() atau $inspection) atau kosong
         */
        function renderDetailForm(data = null) {
            const i = detailIndex;
            
            // Siapkan nilai default atau dari 'old' data
            const no_pol = data?.no_pol || '';
            const vehicle_cond = data?.vehicle_condition || '';
            const pbb_op = data?.pbb_op || '';
            const packaging_type = data?.packaging_type || '';
            const supplier = data?.supplier || '';
            const lot_batch = data?.lot_batch || '';
            const dimension = data?.condition_dimension || '';
            const qty_goods = data?.quantity_goods || 0;
            const qty_sample = data?.quantity_sample || 0;
            const qty_reject = data?.quantity_reject || 0;
            const notes = data?.notes || '';

            // Logika untuk tombol OK/Not OK (default 'OK' jika baru)
            const design_val = data?.condition_design || 'OK';
            const sealing_val = data?.condition_sealing || 'OK';
            const color_val = data?.condition_color || 'OK';
            
            // Logika untuk dropdown Penerimaan (default 'OK' jika baru)
            const accept_val = data?.acceptance_status || 'OK';

            const newDetail = document.createElement('div');
            newDetail.classList.add('dynamic-item-card', 'border', 'p-3', 'mb-3', 'rounded', 'shadow-sm'); 
            
            // --- INI BAGIAN YANG DIUBAH (URUTAN FIELD) ---
            newDetail.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Item #${i + 1}</h5>
                    <button type="button" class="btn btn-danger btn-sm remove-detail-btn"><i class="bi bi-trash"></i> Hapus</button>
                </div>
                
                <div class="row g-3">
                    
                    <!-- URUTAN BARU 1, 2, 3: Jenis, Supplier, Lot Batch -->
                    <div class="col-md-4">
                        <label class="form-label">Jenis Packaging</label>
                        <input type="text" name="items[${i}][packaging_type]" class="form-control" value="${packaging_type}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Supplier</label>
                        <input type="text" name="items[${i}][supplier]" class="form-control" value="${supplier}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Lot Batch</label>
                        <input type="text" name="items[${i}][lot_batch]" class="form-control" value="${lot_batch}" required>
                    </div>

                    <!-- URUTAN BARU 4, 5, 6, 7: Kondisi & Dimensi -->
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label d-block">Kondisi Design</label>
                        <input type="hidden" name="items[${i}][condition_design]" id="design_${i}" value="${design_val}">
                        <div class="btn-group btn-check-group" role="group">
                            <button type="button" class="btn ${design_val === 'OK' ? 'btn-success' : 'btn-outline-success'}" data-value="OK" data-target-input="#design_${i}"><i class="bi bi-check-lg"></i> OK</button>
                            <button type="button" class="btn ${design_val === 'Not OK' ? 'btn-danger' : 'btn-outline-danger'}" data-value="Not OK" data-target-input="#design_${i}"><i class="bi bi-x-lg"></i> Not OK</button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label d-block">Kondisi Sealing</label>
                        <input type="hidden" name="items[${i}][condition_sealing]" id="sealing_${i}" value="${sealing_val}">
                        <div class="btn-group btn-check-group" role="group">
                            <button type="button" class="btn ${sealing_val === 'OK' ? 'btn-success' : 'btn-outline-success'}" data-value="OK" data-target-input="#sealing_${i}"><i class="bi bi-check-lg"></i> OK</button>
                            <button type="button" class="btn ${sealing_val === 'Not OK' ? 'btn-danger' : 'btn-outline-danger'}" data-value="Not OK" data-target-input="#sealing_${i}"><i class="bi bi-x-lg"></i> Not OK</button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label d-block">Kondisi Warna</label>
                        <input type="hidden" name="items[${i}][condition_color]" id="color_${i}" value="${color_val}">
                        <div class="btn-group btn-check-group" role="group">
                            <button type="button" class="btn ${color_val === 'OK' ? 'btn-success' : 'btn-outline-success'}" data-value="OK" data-target-input="#color_${i}"><i class="bi bi-check-lg"></i> OK</button>
                            <button type="button" class="btn ${color_val === 'Not OK' ? 'btn-danger' : 'btn-outline-danger'}" data-value="Not OK" data-target-input="#color_${i}"><i class="bi bi-x-lg"></i> Not OK</button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Dimensi</label>
                        <input type="text" name="items[${i}][condition_dimension]" class="form-control" value="${dimension}">
                    </div>

                    <!-- URUTAN BARU 8, 9, 10, 11: Kuantitas & Penerimaan -->
                    <div class="col-md-3">
                        <label class="form-label">Qty Barang</label>
                        <input type="number" name="items[${i}][quantity_goods]" class="form-control" value="${qty_goods}" min="0" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Qty Sampel</label>
                        <input type="number" name="items[${i}][quantity_sample]" class="form-control" value="${qty_sample}" min="0" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Qty Reject</label>
                        <input type="number" name="items[${i}][quantity_reject]" class="form-control" value="${qty_reject}" min="0" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Penerimaan</label>
                        <select name="items[${i}][acceptance_status]" class="form-select select2-dynamic" required>
                            <option value="OK" ${accept_val === 'OK' ? 'selected' : ''}>OK</option>
                            <option value="Tolak" ${accept_val === 'Tolak' ? 'selected' : ''}>Tolak</option>
                        </select>
                    </div>

                    <!-- URUTAN BARU 12, 13, 14: Info Kendaraan -->
                    <div class="col-md-4">
                        <label class="form-label">No. Polisi</label>
                        <input type="text" name="items[${i}][no_pol]" class="form-control" value="${no_pol}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kondisi Kendaraan</label>
                        <select name="items[${i}][vehicle_condition]" class="form-select select2-dynamic" required>
                            <option></option> ${vehicleConditions.map(c => `<option value="${c}" ${vehicle_cond === c ? 'selected' : ''}>${c}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">PBB / OP</label>
                        <input type="text" name="items[${i}][pbb_op]" class="form-control" value="${pbb_op}">
                    </div>
                    
                    <!-- URUTAN BARU 15: Keterangan -->
                    <div class="col-12">
                        <label class="form-label">Keterangan (Optional)</label>
                        <textarea name="items[${i}][notes]" class="form-control" rows="2">${notes}</textarea>
                    </div>

                    <!-- Input Tersembunyi (Hidden) -->
                    <input type="hidden" name="items[${i}][id]" value="${data?.id || ''}">
                    <input type="hidden" name="items[${i}][condition_weight_pcs]" value="${data?.condition_weight_pcs || ''}">
                </div>
            `;
            // --- AKHIR DARI BAGIAN YANG DIUBAH ---

            container.appendChild(newDetail);
            
            // Inisialisasi Select2 pada elemen yang baru ditambahkan
            $(newDetail).find('.select2-dynamic').select2({
                theme: "bootstrap-5",
                placeholder: "Pilih...",
                allowClear: true,
                dropdownAutoWidth: true
            });

            detailIndex++;
        }

        // --- Event Listener untuk Tombol "Tambah Item" ---
        if (addBtn) {
            addBtn.addEventListener('click', () => renderDetailForm(null));
        }
        
        // --- Event Listener untuk Tombol Hapus & Grup Tombol OK/Not OK ---
        if (container) {
            container.addEventListener('click', function(e) {
                // Logika Tombol Hapus
                const removeBtn = e.target.closest('.remove-detail-btn');
                if (removeBtn) {
                    removeBtn.closest('.dynamic-item-card').remove();
                }

                // Logika Tombol OK/Not OK
                if (e.target.matches('.btn-check-group .btn')) {
                    const button = e.target;
                    const value = button.dataset.value; // "OK" or "Not OK"
                    const targetInputId = button.dataset.targetInput;
                    
                    if (!targetInputId) return; 
                    
                    const targetInput = document.querySelector(targetInputId);
                    if (targetInput) {
                        targetInput.value = value;
                    }

                    // Reset style tombol di grup
                    const group = button.closest('.btn-check-group');
                    const buttonsInGroup = group.querySelectorAll('button');
                    
                    buttonsInGroup.forEach(btn => {
                        if (btn.dataset.value === 'OK') {
                            btn.classList.remove('btn-success');
                            btn.classList.add('btn-outline-success');
                        } else { // Tombol Not OK
                            btn.classList.remove('btn-danger');
                            btn.classList.add('btn-outline-danger');
                        }
                    });

                    // Set style aktif
                    if (value === 'OK') {
                        button.classList.remove('btn-outline-success');
                        button.classList.add('btn-success');
                    } else {
                        button.classList.remove('btn-outline-danger');
                        button.classList.add('btn-danger');
                    }
                }
            });
        }

        // --- Render data 'old' atau $packagingInspection->items saat halaman dimuat ---
        const existingDetails = @json(old('items', $packagingInspection->items ?? []));
        
        if (existingDetails.length > 0) {
            existingDetails.forEach(itemData => {
                renderDetailForm(itemData);
            });
        } else {
            // Tambah satu form kosong jika tidak ada data sama sekali
            renderDetailForm(null);
        }

    });
</script>
@endpush
