<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Plant extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'plants';

    // Tambahkan username ke fillable
    protected $fillable = ['uuid', 'plant'];

    // Route model binding pakai UUID
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public static function getByName($name)
    {
        return self::where('plant', 'like', "%{$name}%")->first();
    }
}
