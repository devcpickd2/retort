<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid; 

class Area_hygiene extends Model
{
    use HasFactory, HasUuid;
    
    protected $fillable = ['area', 'username', 'plant', 'uuid'];
}
