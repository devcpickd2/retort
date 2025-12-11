<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackagingInspection extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected $fillable = [
        'inspection_date',
        'shift',

        // --- FIELD BARU (Identity & Location) ---
        'plant_uuid',
        'created_by',
        'updated_by',
        
        // Field Verifikasi
        'status_spv',
        'catatan_spv',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'inspection_date' => 'date',
        'verified_at' => 'datetime',
    ];

    /**
     * Relasi ke Items
     */
    public function items(): HasMany
    {
        return $this->hasMany(PackagingInspectionItem::class);
    }

    /**
     * Relasi ke User Verifikator
     */
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Relasi ke User Pembuat (Creator)
     */
    public function creator(): BelongsTo
    {
        // Parameter 2: Foreign key di table ini ('created_by')
        // Parameter 3: Owner key di table user ('uuid') -> INI PENTING
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    /**
     * Relasi ke User Pengupdate
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'uuid');
    }
}