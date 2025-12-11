<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid; 

class Supplier extends Model
{
    use HasFactory, HasUuid;
    
    protected $fillable = ['nama_supplier', 'jenis_barang', 'alamat', 'username', 'plant', 'uuid'];
}
