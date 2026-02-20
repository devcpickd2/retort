<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid; 

class Operator extends Model
{
    use HasFactory, HasUuid;
    
    protected $fillable = ['nama_karyawan', 'bagian', 'username', 'plant', 'uuid'];

    public function dataPlant()
    {
        return $this->belongsTo(Plant::class, 'plant', 'uuid');
    }
}
