<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PenyimpanganKualitas extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Menentukan nama tabel secara eksplisit
     */
    protected $table = 'penyimpangan_kualitas';

    // Mass assignment
    protected $guarded = ['id'];

    /**
     * Tipe data casting
     */
    protected $casts = [
        'tanggal' => 'date',
        'diketahui_at' => 'datetime',
        'disetujui_at' => 'datetime',
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
     * Relasi ke user (SPV 1) yang mengetahui
     */
    public function verifierDiketahui()
    {
        return $this->belongsTo(User::class, 'diketahui_by', 'uuid');
    }

    /**
     * Relasi ke user (SPV 2) yang menyetujui
     */
    public function verifierDisetujui()
    {
        return $this->belongsTo(User::class, 'disetujui_by', 'uuid');
    }
}