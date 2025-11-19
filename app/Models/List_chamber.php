<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid; 

class List_chamber extends Model
{
    use HasFactory, HasUuid;
    
    protected $fillable = ['no_chamber', 'username', 'plant', 'uuid'];
}
