<?php

// app/Models/RawMaterialInspection.php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialInspection extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $guarded = ['id']; // Memperbolehkan mass assignment untuk semua kolom kecuali id

    /**
     * Relasi ke detail produk
     */
    public function productDetails(): HasMany
    {
        return $this->hasMany(InspectionProductDetail::class);
    }
}