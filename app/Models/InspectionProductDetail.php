<?php

// app/Models/InspectionProductDetail.php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InspectionProductDetail extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    /**
     * Relasi ke data inspeksi utama
     */
    public function rawMaterialInspection(): BelongsTo
    {
        return $this->belongsTo(RawMaterialInspection::class);
    }
}