<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str; // Import Str

class PemeriksaanRetainItem extends Model
{
    // Hapus 'HasUuids'
    use HasFactory;

    // Nonaktifkan 'updated_at' jika tidak perlu
    // public const UPDATED_AT = null;

    protected $fillable = [
        'pemeriksaan_retain_id',
        'kode_produksi',
        'exp_date',
        'varian',
        'panjang',
        'diameter',
        'sensori_rasa',
        'sensori_warna',
        'sensori_aroma',
        'sensori_texture',
        'temuan_jamur',
        'temuan_lendir',
        'temuan_pinehole',
        'temuan_kejepit',
        'temuan_seal',
        'lab_garam',
        'lab_air',
        'lab_mikro',
    ];

    protected $casts = [
        'temuan_jamur' => 'boolean',
        'temuan_lendir' => 'boolean',
        'temuan_pinehole' => 'boolean',
        'temuan_kejepit' => 'boolean',
        'temuan_seal' => 'boolean',
        'panjang' => 'decimal:2',
        'diameter' => 'decimal:2',
    ];
    
    /**
     * Otomatis mengisi 'uuid' saat membuat data baru.
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
     * Relasi: Satu Item dimiliki oleh satu PemeriksaanRetain.
     */
    public function pemeriksaanRetain(): BelongsTo
    {
        return $this->belongsTo(PemeriksaanRetain::class, 'pemeriksaan_retain_id');
    }
}