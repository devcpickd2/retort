<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LoadingProduk extends Model
{
    use HasFactory, SoftDeletes;

    // Nama tabel harus sesuai dengan migrasi Anda
    protected $table = 'loading_checks'; 
    protected $guarded = [];

    protected $casts = [
        'kondisi_mobil' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
            if (Auth::check() && empty($model->created_by)) {
                $model->created_by = Auth::id();
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
     * Relasi ke LoadingDetail
     */
    public function details()
    {
        // Sesuaikan foreign key jika berbeda
        return $this->hasMany(LoadingDetail::class, 'loading_check_id', 'id');
    }

    /**
     * Relasi ke User pembuat
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

     /* Ini akan otomatis memformat 'jam_mulai' saat dipanggil di view.
     * Ia mengambil "10:30:00" dari DB dan mengubahnya jadi "10:30" untuk view.
     */
    public function getJamMulaiAttribute($value)
    {
        // Cek jika value-nya ada, lalu format ke H:i
        return $value ? \Carbon\Carbon::parse($value)->format('H:i') : null;
    }

    /**
     * Ini akan otomatis memformat 'jam_selesai' saat dipanggil di view.
     * Ia mengambil "10:30:00" dari DB dan mengubahnya jadi "10:30" untuk view.
     */
    public function getJamSelesaiAttribute($value)
    {
        // Cek jika value-nya ada, lalu format ke H:i
        return $value ? \Carbon\Carbon::parse($value)->format('H:i') : null;
    }
}

