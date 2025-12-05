<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; // <-- TAMBAHAN: Import Auth Facade

class Disposition extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

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
        'plant_uuid', 
        'created_by',
        'updated_by', 
        'status_spv',
        'catatan_spv',
        'verified_by',
        'verified_at',
    ];

    /**
     * Booted method untuk menangani event model otomatis.
     */
    protected static function booted(): void
    {
        // Event saat data AKAN dibuat (Creating)
        static::creating(function ($disposition) {
            $disposition->uuid = (string) Str::uuid();

            // <-- TAMBAHAN: Otomatis isi plant_uuid & created_by jika user login
            if (Auth::check()) {
                // Ambil column 'plant' dari user yang login
                $disposition->plant_uuid = Auth::user()->plant; 
                
                // Jika created_by belum diisi di controller, isi otomatis disini
                if (!$disposition->created_by) {
                    $disposition->created_by = Auth::id();
                }
            }
        });

        // Event saat data AKAN diupdate (Updating)
        // <-- TAMBAHAN: Konfigurasi updated_by sinkron dengan updated_at
        static::updating(function ($disposition) {
            if (Auth::check()) {
                $disposition->updated_by = Auth::id();
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    // RELASI
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // <-- TAMBAHAN: Relasi untuk mengetahui siapa yang mengupdate terakhir
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}