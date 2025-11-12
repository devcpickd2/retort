<?php

namespace App\Models;

// <-- TAMBAHAN: Import model User untuk relasi
use App\Models\User; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str; // Penting untuk UUID

class Disposition extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Mengaktifkan SoftDeletes
     */
    protected $dates = ['deleted_at'];

    /**
     * Kolom yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'nomor',
        'tanggal',
        'kepada',
        'disposisi_produk',
        'disposisi_material',
        'disposisi_prosedur',
        'dasar_disposisi',
        'uraian_disposisi',
        'catatan',
        'created_by', 
        'status_spv',
        'catatan_spv',
        'verified_by',
        'verified_at',
    ];

    /**
     * Event 'creating' ini akan otomatis mengisi UUID
     * saat data baru dibuat.
     */
    protected static function booted(): void
    {
        static::creating(function ($disposition) {
            $disposition->uuid = (string) Str::uuid();
        });
    }

    /**
     * Memberitahu Laravel untuk menggunakan 'uuid'
     * saat mencari data via URL (Route Model Binding).
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    // <-- TAMBAHAN: Relasi Eloquent ke User
    /**
     * Mendapatkan user yang membuat disposisi ini.
     */
    public function creator()
    {
        // Relasi belongsTo ke model User, menggunakan foreign key 'created_by'
        return $this->belongsTo(User::class, 'created_by');
    }

    public function verifiedBy()
    {
        // Relasi belongsTo ke model User, menggunakan foreign key 'verified_by'
        return $this->belongsTo(User::class, 'verified_by');
    }
}