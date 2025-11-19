<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid; 

class Supplier_rm extends Model
{
    use HasFactory, HasUuid;
    
    protected $fillable = ['nama_supplier', 'username', 'plant', 'uuid'];
}
