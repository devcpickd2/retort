<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; 

class PenyimpanganKualitas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penyimpangan_kualitas';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal' => 'date',
        'diketahui_at' => 'datetime',
        'disetujui_at' => 'datetime',
    ];

    /**
     * Boot method untuk otomatis mengisi data sistem (uuid, plant, user logs)
     */
    protected static function boot()
    {
        parent::boot();

        // 1. Event saat data AKAN dibuat (Creating)
        static::creating(function ($model) {
            // Isi UUID jika kosong
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }

            // Logic otomatisasi Plant dan Created By
            if (Auth::check()) {
                $user = Auth::user();
                $model->plant_uuid = $user->plant; // Isi plant_uuid

                if (empty($model->created_by)) {
                    $model->created_by = $user->uuid;
                }
            }
        });

        // 2. Event saat data AKAN diupdate (Updating)
        static::updating(function ($model) {
            if (Auth::check()) {
                // Isi updated_by dengan user yang sedang login saat ini
                $model->updated_by = Auth::user()->uuid;
            }
        });
    }

    // --- RELASI ---

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    // Tambahan relasi updater
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by', 'uuid');
    }

    public function verifierDiketahui()
    {
        return $this->belongsTo(User::class, 'diketahui_by', 'uuid');
    }

    public function verifierDisetujui()
    {
        return $this->belongsTo(User::class, 'disetujui_by', 'uuid');
    }
}