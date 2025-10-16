<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MagnetTrapModel extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'magnet_traps';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'nama_produk',
        'kode_batch',
        'pukul',
        'jumlah_temuan',
        'status',
        'keterangan',
        'produksi_id',
        'engineer_id',
    ];

    // Opsional: Definisikan relasi ke model User (jika operator dan engineer ada di tabel users)
    // public function operator()
    // {
    //     return $this->belongsTo(User::class, 'produksi_id');
    // }

    // public function engineer()
    // {
    //     return $this->belongsTo(User::class, 'engineer_id');
    // }
}
