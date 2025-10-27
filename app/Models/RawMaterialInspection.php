<?php

namespace App\Models;

// 1. HAPUS baris ini
// use Illuminate\Database\Eloquent\Concerns\HasUuids; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str; // 2. TAMBAHKAN baris ini

class RawMaterialInspection extends Model
{
    // 3. HAPUS 'HasUuids' dari sini
    use HasFactory, /* HasUuids, */ SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'setup_kedatangan' => 'datetime',
        'mobil_check_warna' => 'boolean',
        'mobil_check_kotoran' => 'boolean',
        'mobil_check_aroma' => 'boolean',
        'mobil_check_kemasan' => 'boolean',
        'suhu_daging' => 'decimal:2',
        'analisa_ka_ffa' => 'boolean',
        'analisa_logo_halal' => 'boolean',
        'dokumen_halal_berlaku' => 'boolean',
    ];
    /**
     * 4. TAMBAHKAN method ini
     * Ini akan otomatis mengisi kolom 'uuid' baru saat data dibuat.
     */
    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Mengubah binding route dari 'id' ke 'uuid'
     * Ini akan membuat URL seperti /inspections/{uuid}/edit
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function productDetails(): HasMany
    {
        // PERUBAHAN DI SINI:
        // Kita beritahu Eloquent foreign key di tabel anak adalah 'raw_material_inspection_uuid'
        // dan local key (primary) di tabel ini adalah 'uuid'
        return $this->hasMany(InspectionProductDetail::class, 'raw_material_inspection_uuid', 'uuid');
    }
}
