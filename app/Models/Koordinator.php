<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid; 

class Koordinator extends Model
{
    use HasFactory, HasUuid;
    
    protected $fillable = ['nama_koordinator', 'username', 'plant', 'uuid'];
}
