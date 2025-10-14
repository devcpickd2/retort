<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid; 

class Produksi extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'produksis';

    protected $fillable = ['nama_karyawan', 'area', 'plant', 'uuid'];
}
