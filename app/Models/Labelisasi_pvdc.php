<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Labelisasi_pvdc extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'labelisasi_pvdcs';

    protected $primaryKey = 'uuid';  

    public $incrementing = false;
    protected $keyType   = 'string';

    protected $fillable = [
        'date', 'plant', 'shift', 'nama_produk', 'labelisasi', 'nama_operator', 'status_operator', 'tgl_update_operator', 
        'username', 'username_updated',  'nama_spv', 'status_spv', 'catatan_spv', 'tgl_update_spv'
    ];

    protected $casts = [
        'labelisasi'  => 'array',
    ];
}
