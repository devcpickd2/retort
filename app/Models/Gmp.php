<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Gmp extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'gmps';

    protected $primaryKey = 'uuid';  

    public $incrementing = false;
    protected $keyType   = 'string';

    protected $fillable = [
        'date', 'area', 'mp_chamber', 'karantina_packing', 'filling_susun', 'sampling_fg',
        'username', 'nama_produksi', 'status_produksi',  'nama_spv', 'status_spv', 'catatan_spv', 
        'username_updated', 'tgl_update_produksi', 'tgl_update_spv', 'plant'
    ];

    protected $casts = [
        'mp_chamber'  => 'array',
        'karantina_packing'  => 'array',
        'filling_susun'  => 'array',
        'sampling_fg'  => 'array',
    ];
}
