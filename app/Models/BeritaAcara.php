<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BeritaAcara extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Mengisi $guarded agar semua field bisa di-mass-assign
     */
    protected $guarded = ['id'];

    /**
     * Tipe data casting untuk boolean (checkbox) dan tanggal
     */
    protected $casts = [
        'tanggal_kedatangan' => 'date',
        'tanggal_keputusan' => 'date',
        'keputusan_pengembalian' => 'boolean',
        'keputusan_potongan_harga' => 'boolean',
        'keputusan_sortir' => 'boolean',
        'keputusan_penukaran_barang' => 'boolean',
        'keputusan_penggantian_biaya' => 'boolean',
        'ppic_verified_at' => 'datetime',
        'spv_verified_at' => 'datetime',
    ];

    /**
     * Boot method untuk otomatis mengisi 'uuid' saat membuat data baru.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            // Otomatis isi UUID jika kosong
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Relasi ke user yang membuat
     */
    public function creator()
    {
        // Asumsi relasi ke kolom 'uuid' di tabel User
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    /**
     * Relasi ke user (PPIC) yang verifikasi
     */
    public function verifierPpic()
    {
        return $this->belongsTo(User::class, 'ppic_verified_by', 'uuid');
    }

    /**
     * Relasi ke user (SPV) yang verifikasi
     */
    public function verifierSpv()
    {
        return $this->belongsTo(User::class, 'spv_verified_by', 'uuid');
    }
}