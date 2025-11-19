<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid; 

class Mesin extends Model
{
    use HasFactory, HasUuid;
    
    protected $fillable = ['nama_mesin', 'jenis_mesin', 'username', 'plant', 'uuid'];
}
