<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid; 

class Departemen extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'departemens';

    protected $fillable = ['uuid', 'nama'];

    // pakai route binding berdasarkan UUID
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    // app/Models/Departemen.php
    public static function getByName($name)
    {
        return self::where('nama', 'like', "%{$name}%")->first();
    }

}
