<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Import Str

class PemeriksaanRetain extends Model
{
    // Hapus 'HasUuids' dari sini
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hari',
        'tanggal',
        'keterangan',
        'created_by',
        'status_spv',     
        'catatan_spv',    
        'verified_by',    
        'verified_at',    
    ];

    /**
     * Otomatis mengisi 'uuid' dan 'created_by' saat membuat data baru.
     */
    protected static function booted(): void
    {
        static::creating(function ($model) {
            // Isi 'uuid' jika kosong
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
            
            // Isi 'created_by' dengan 'uuid' user yang login
            if (Auth::check() && empty($model->created_by)) {
                $model->created_by = Auth::user()->uuid; 
            }
        });
    }

    /**
     * Relasi: Satu PemeriksaanRetain memiliki banyak Item.
     * Terhubung ke 'pemeriksaan_retain_id' (angka) -> 'id' (angka)
     */
    public function items(): HasMany
    {
        return $this->hasMany(PemeriksaanRetainItem::class, 'pemeriksaan_retain_id');
    }

    /**
     * Relasi: Satu PemeriksaanRetain dibuat oleh satu User.
     * Terhubung ke 'created_by' (uuid) -> 'uuid' (di tabel users)
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }
    
    /**
     * Memberi tahu Laravel untuk menggunakan 'uuid' di URL (Route Model Binding).
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

     public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by', 'uuid');
    }
}