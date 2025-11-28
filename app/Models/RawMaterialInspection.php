<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use App\Models\User; 

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
           if (Auth::check() && empty($model->created_by_uuid)) {
              $model->created_by_uuid = Auth::user()->uuid; // Auth::id() akan mengambil UUID user
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

    public function creator(): BelongsTo
    {
        // Sesuaikan 'User::class', 'created_by_uuid', dan 'uuid' jika perlu
        return $this->belongsTo(User::class, 'created_by_uuid', 'uuid');
    }
}
