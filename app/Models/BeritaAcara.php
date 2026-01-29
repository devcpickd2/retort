<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; // <-- Import Auth

class BeritaAcara extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

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
     * Boot method untuk otomatisasi pengisian data sistem
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

            // Jika user sedang login
            if (Auth::check()) {
                $user = Auth::user();
                
                // Isi plant_uuid dari data user
                $model->plant_uuid = $user->plant; // Pastikan kolom 'plant' ada di tabel users

                // Isi created_by otomatis (jika belum diisi controller)
                if (empty($model->created_by)) {
                    $model->created_by = $user->uuid;
                }
            }
        });

        // 2. Event saat data AKAN diupdate (Updating)
        static::updating(function ($model) {
            if (Auth::check()) {
                // Isi updated_by dengan UUID user yang sedang login
                // Ini akan tereksekusi otomatis setiap kali save() atau update() dipanggil
                $model->updated_by = Auth::user()->uuid;
            }
        });
    }

    // --- RELASI ---

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    // Relasi baru untuk melihat siapa yang terakhir update
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by', 'uuid');
    }

    public function verifierPpic()
    {
        return $this->belongsTo(User::class, 'ppic_verified_by', 'uuid');
    }

    public function verifierSpv()
    {
        return $this->belongsTo(User::class, 'spv_verified_by', 'uuid');
    }
}