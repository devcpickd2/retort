<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

// Nama class diubah
class PemeriksaanKekuatanMagnetTrap extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Menentukan nama tabel secara eksplisit
     */
    protected $table = 'pemeriksaan_kekuatan_magnet_traps';

    // Mass assignment
    protected $guarded = ['id'];

    /**
     * Tipe data casting
     */
    protected $casts = [
        'tanggal' => 'date',
        'parameter_sesuai' => 'boolean',
        'verified_at' => 'datetime',
        'kekuatan_median_1' => 'decimal:2',
        'kekuatan_median_2' => 'decimal:2',
        'kekuatan_median_3' => 'decimal:2',
    ];

    /**
     * Boot method untuk otomatis mengisi 'uuid'.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
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
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    /**
     * Relasi ke user (SPV) yang verifikasi
     */
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by', 'uuid');
    }
}