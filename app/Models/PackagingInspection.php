<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Diperlukan untuk relasi 'verifier'

class PackagingInspection extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Otomatis mengisi UUID saat membuat record baru.
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
     * Memberitahu Laravel untuk menggunakan 'uuid' untuk Route Model Binding.
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Kolom yang dapat diisi.
     */
    protected $fillable = [
        'inspection_date',
        'shift',
        
        // Kolom Verifikasi Baru ditambahkan dari migrasi
        'status_spv',
        'catatan_spv',
        'verified_by',
        'verified_at',
    ];

    /**
     * Cast tipe data untuk kolom.
     */
    protected $casts = [
        'inspection_date' => 'date',
        'verified_at' => 'datetime', // Cast baru
    ];

    /**
     * Mendapatkan semua item yang terkait dengan inspeksi ini.
     */
    public function items(): HasMany
    {
        return $this->hasMany(PackagingInspectionItem::class);
    }

    /**
     * Relasi ke user yang melakukan verifikasi. (Baru)
     */
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}

