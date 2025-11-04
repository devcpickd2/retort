{{-- CSS Sederhana untuk styling form --}}
<style>
    :root {
        --color-primary: #007bff;
        --color-success: #28a745;
        --color-danger: #dc3545;
        --color-light-gray: #f8f9fa;
        --color-gray: #dee2e6;
        --color-dark-gray: #6c757d;
        --border-radius: 0.375rem;
    }

    .form-group { margin-bottom: 1rem; }
    .form-group label { 
        display: block; 
        margin-bottom: 0.5rem; 
        font-weight: 600; 
        color: #333;
    }
    .form-group input, .form-group select { 
        width: 100%; 
        padding: 0.6rem 0.75rem; 
        box-sizing: border-box; 
        border: 1px solid var(--color-gray);
        border-radius: var(--border-radius);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-group input:focus, .form-group select:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        outline: 0;
    }

    .form-fieldset {
        border: 1px solid var(--color-gray); 
        padding: 1.5rem; 
        margin-bottom: 1.5rem;
        border-radius: var(--border-radius);
        background-color: #fff;
    }
    .form-legend {
        padding: 0 0.5rem;
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--color-primary);
    }

    /* Styling untuk tabel item */
    .items-table-container {
        overflow-x: auto;
        width: 100%;
        border: 1px solid var(--color-gray);
        border-radius: var(--border-radius);
    }
    .items-table { 
        width: 100%; 
        border-collapse: collapse; 
        min-width: 1200px;
    }
    .items-table th, .items-table td { 
        border-bottom: 1px solid var(--color-gray); 
        padding: 0.75rem; 
        text-align: left; 
        vertical-align: middle;
    }
    .items-table th { 
        background-color: var(--color-light-gray); 
        white-space: nowrap;
        font-weight: 600;
        color: #333;
    }
    .items-table tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .items-table input,
    .items-table select { 
        width: 100%; 
        min-width: 120px;
        padding: 6px; 
    }
    .items-table input.small-input {
        min-width: 80px;
    }

    /* Styling custom untuk tombol radio OK/Not OK */
    .radio-group {
        display: flex;
        gap: 15px;
        white-space: nowrap;
    }
    .radio-group label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        font-weight: 500;
    }
    .radio-group input[type="radio"] {
        /* Sembunyikan radio button asli */
        appearance: none;
        -webkit-appearance: none;
        width: 0;
        height: 0;
        margin: 0;
    }
    /* Buat radio button palsu */
    .radio-group label::before {
        content: '';
        display: inline-block;
        width: 18px;
        height: 18px;
        border: 2px solid var(--color-gray);
        border-radius: 50%;
        background-color: #fff;
        transition: all 0.2s;
    }
    /* Style saat terpilih */
    .radio-group input[type="radio"]:checked + label::before {
        border-color: var(--color-primary);
        background-color: var(--color-primary);
        box-shadow: 0 0 0 2px #fff inset;
    }
    /* Style saat "Not OK" */
    .radio-group input[type="radio"][value="Not OK"]:checked + label::before {
        border-color: var(--color-danger);
        background-color: var(--color-danger);
    }
    .radio-group input[type="radio"]:focus + label::before {
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }


    /* Style Tombol Aksi */
    .btn {
        padding: 0.6rem 1rem;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s ease;
    }
    .btn-remove { 
        background-color: var(--color-danger); 
        color: white; 
    }
    .btn-remove:hover { background-color: #c82333; }
    
    .btn-add { 
        background-color: var(--color-success); 
        color: white; 
        margin-top: 1rem; 
    }
    .btn-add:hover { background-color: #218838; }

</style>

{{-- ===================== BAGIAN HEADER ===================== --}}
<fieldset class="form-fieldset">
    <legend class="form-legend">Data Inspeksi</legend>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
        <div class="form-group">
            <label for="inspection_date">Hari/Tanggal</label>
            <input type="date" id="inspection_date" name="inspection_date" value="{{ old('inspection_date', $inspection->inspection_date ?? date('Y-m-d')) }}" required>
        </div>
        <div class="form-group">
            <label for="shift">Shift</label>
            <input type="text" id="shift" name="shift" value="{{ old('shift', $inspection->shift) }}" required>
        </div>
    </div>
</fieldset>

{{-- ===================== BAGIAN ITEMS (DETAIL) ===================== --}}
<fieldset class="form-fieldset">
    <legend class="form-legend">Detail Item Packaging</legend>
    
    <div class="items-table-container">
        <table class="items-table">
            <thead>
                <tr>
                    <th>No. Polisi</th>
                    <th>Kondisi Kendaraan</th>
                    <th>PBB / OP</th>
                    <th>Jenis Packaging</th>
                    <th>Supplier</th>
                    <th>Lot Batch</th>
                    <th>Design</th>
                    <th>Sealing</th>
                    <th>Warna</th>
                    <th>Dimensi</th>
                    <th>Qty Barang</th>
                    <th>Qty Sampel</th>
                    <th>Qty Reject</th>
                    <th>Penerimaan</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="items-container">
                @foreach(old('items', $inspection->items ?? []) as $index => $item)
                    @php $item = (object) $item; @endphp
                    <tr class="item-row">
                        <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id ?? '' }}">

                        {{-- Data Kendaraan --}}
                        <td><input type="text" name="items[{{ $index }}][no_pol]" value="{{ $item->no_pol ?? '' }}" required></td>
                        <td>
                            <select name="items[{{ $index }}][vehicle_condition]" required>
                                <option value="">-- Pilih --</option>
                                @foreach($vehicleConditions as $condition)
                                    <option value="{{ $condition }}" {{ (old("items.$index.vehicle_condition", $item->vehicle_condition ?? '') == $condition) ? 'selected' : '' }}>
                                        {{ $condition }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="items[{{ $index }}][pbb_op]" value="{{ $item->pbb_op ?? '' }}"></td>

                        {{-- Data Item --}}
                        <td><input type="text" name="items[{{ $index }}][packaging_type]" value="{{ $item->packaging_type ?? '' }}" required></td>
                        <td><input type="text" name="items[{{ $index }}][supplier]" value="{{ $item->supplier ?? '' }}" required></td>
                        <td><input type="text" name="items[{{ $index }}][lot_batch]" value="{{ $item->lot_batch ?? '' }}" required></td>

                        {{-- Data Kondisi Packaging --}}
                        <td>
                            <div class="radio-group">
                                <input type="radio" id="design_ok_{{ $index }}" name="items[{{ $index }}][condition_design]" value="OK" {{ (old("items.$index.condition_design", $item->condition_design ?? 'OK') == 'OK') ? 'checked' : '' }}>
                                <label for="design_ok_{{ $index }}">OK</label>
                                
                                <input type="radio" id="design_no_{{ $index }}" name="items[{{ $index }}][condition_design]" value="Not OK" {{ (old("items.$index.condition_design", $item->condition_design ?? '') == 'Not OK') ? 'checked' : '' }}>
                                <label for="design_no_{{ $index }}">Not OK</label>
                            </div>
                        </td>
                        <td>
                            <div class="radio-group">
                                <input type="radio" id="sealing_ok_{{ $index }}" name="items[{{ $index }}][condition_sealing]" value="OK" {{ (old("items.$index.condition_sealing", $item->condition_sealing ?? 'OK') == 'OK') ? 'checked' : '' }}>
                                <label for="sealing_ok_{{ $index }}">OK</label>
                                
                                <input type="radio" id="sealing_no_{{ $index }}" name="items[{{ $index }}][condition_sealing]" value="Not OK" {{ (old("items.$index.condition_sealing", $item->condition_sealing ?? '') == 'Not OK') ? 'checked' : '' }}>
                                <label for="sealing_no_{{ $index }}">Not OK</label>
                            </div>
                        </td>
                        <td>
                            <div class="radio-group">
                                <input type="radio" id="color_ok_{{ $index }}" name="items[{{ $index }}][condition_color]" value="OK" {{ (old("items.$index.condition_color", $item->condition_color ?? 'OK') == 'OK') ? 'checked' : '' }}>
                                <label for="color_ok_{{ $index }}">OK</label>
                                
                                <input type="radio" id="color_no_{{ $index }}" name="items[{{ $index }}][condition_color]" value="Not OK" {{ (old("items.$index.condition_color", $item->condition_color ?? '') == 'Not OK') ? 'checked' : '' }}>
                                <label for="color_no_{{ $index }}">Not OK</label>
                            </div>
                        </td>
                        <td><input type="text" name="items[{{ $index }}][condition_dimension]" value="{{ $item->condition_dimension ?? '' }}" class="small-input"></td>

                        {{-- Data Kuantitas --}}
                        <td><input type="number" name="items[{{ $index }}][quantity_goods]" value="{{ $item->quantity_goods ?? 0 }}" min="0" required class="small-input"></td>
                        <td><input type="number" name="items[{{ $index }}][quantity_sample]" value="{{ $item->quantity_sample ?? 0 }}" min="0" required class="small-input"></td>
                        <td><input type="number" name="items[{{ $index }}][quantity_reject]" value="{{ $item->quantity_reject ?? 0 }}" min="0" required class="small-input"></td>
                        <td>
                            <select name="items[{{ $index }}][acceptance_status]" required>
                                <option value="OK" {{ (old("items.$index.acceptance_status", $item->acceptance_status ?? '') == 'OK') ? 'selected' : '' }}>OK</option>
                                <option value="Tolak" {{ (old("items.$index.acceptance_status", $item->acceptance_status ?? '') == 'Tolak') ? 'selected' : '' }}>Tolak</option>
                            </select>
                        </td>
                        <td><input type="text" name="items[{{ $index }}][notes]" value="{{ $item->notes ?? '' }}"></td>
                        <td>
                            <button type="button" class="btn btn-remove" onclick="removeItem(this)">Hapus</button>
                        </td>
                        
                        <input type="hidden" name="items[{{ $index }}][condition_weight_pcs]" value="{{ $item->condition_weight_pcs ?? '' }}">
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button type="button" id="btn-add-item" class="btn btn-add">+ Tambah Item</button>
</fieldset>

{{-- ===================== TEMPLATE UNTUK ITEM BARU (PENTING!) ===================== --}}
<template id="item-template">
    <tr class="item-row">
        <input type="hidden" name="items[__INDEX__][id]" value="">

        {{-- Data Kendaraan --}}
        <td><input type="text" name="items[__INDEX__][no_pol]" required></td>
        <td>
            <select name="items[__INDEX__][vehicle_condition]" required>
                <option value="">-- Pilih --</option>
                @foreach($vehicleConditions as $condition)
                    <option value="{{ $condition }}">{{ $condition }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" name="items[__INDEX__][pbb_op]"></td>

        {{-- Data Item --}}
        <td><input type="text" name="items[__INDEX__][packaging_type]" required></td>
        <td><input type="text" name="items[__INDEX__][supplier]" required></td>
        <td><input type="text" name="items[__INDEX__][lot_batch]" required></td>

        {{-- Data Kondisi Packaging --}}
        <td>
            <div class="radio-group">
                <input type="radio" id="design_ok___INDEX__" name="items[__INDEX__][condition_design]" value="OK" checked>
                <label for="design_ok___INDEX__">OK</label>
                
                <input type="radio" id="design_no___INDEX__" name="items[__INDEX__][condition_design]" value="Not OK">
                <label for="design_no___INDEX__">Not OK</label>
            </div>
        </td>
        <td>
            <div class="radio-group">
                <input type="radio" id="sealing_ok___INDEX__" name="items[__INDEX__][condition_sealing]" value="OK" checked>
                <label for="sealing_ok___INDEX__">OK</label>
                
                <input type="radio" id="sealing_no___INDEX__" name="items[__INDEX__][condition_sealing]" value="Not OK">
                <label for="sealing_no___INDEX__">Not OK</label>
            </div>
        </td>
        <td>
            <div class="radio-group">
                <input type="radio" id="color_ok___INDEX__" name="items[__INDEX__][condition_color]" value="OK" checked>
                <label for="color_ok___INDEX__">OK</label>
                
                <input type="radio" id="color_no___INDEX__" name="items[__INDEX__][condition_color]" value="Not OK">
                <label for="color_no___INDEX__">Not OK</label>
            </div>
        </td>
        <td><input type="text" name="items[__INDEX__][condition_dimension]" class="small-input"></td>

        {{-- Data Kuantitas --}}
        <td><input type="number" name="items[__INDEX__][quantity_goods]" value="0" min="0" required class="small-input"></td>
        <td><input type="number" name="items[__INDEX__][quantity_sample]" value="0" min="0" required class="small-input"></td>
        <td><input type="number" name="items[__INDEX__][quantity_reject]" value="0" min="0" required class="small-input"></td>
        <td>
            <select name="items[__INDEX__][acceptance_status]" required>
                <option value="OK" selected>OK</option>
                <option value="Tolak">Tolak</option>
            </select>
        </td>
        <td><input type="text" name="items[__INDEX__][notes]"></td>
        <td>
            <button type="button" class="btn btn-remove" onclick="removeItem(this)">Hapus</button>
        </td>
        
        <input type="hidden" name="items[__INDEX__][condition_weight_pcs]" value="">
    </tr>
</template>


{{-- ===================== JAVASCRIPT UNTUK TOMBOL + ===================== --}}
@push('scripts')
<script>
    let itemIndex = {{ count(old('items', $inspection->items ?? [])) }};

    document.getElementById('btn-add-item').addEventListener('click', function() {
        const template = document.getElementById('item-template').innerHTML;
        
        // Ganti placeholder __INDEX__ dengan index unik
        // Penting untuk mengganti ID dan FOR pada label radio button
        let newRowHtml = template.replace(/__INDEX__/g, itemIndex);
        
        const container = document.getElementById('items-container');
        container.insertAdjacentHTML('beforeend', newRowHtml);
        
        itemIndex++;
    });

    function removeItem(button) {
        button.closest('tr.item-row').remove();
    }
</script>
@endpush