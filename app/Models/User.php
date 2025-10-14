<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory,  HasUuids;

    protected $table = 'users'; // nama tabel
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid', 'name', 'username', 'password', 'plant',
        'department', 'type_user', 'photo', 'email',
        'activation', 'updater'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Jika pakai timestamp di database
    public $timestamps = true;

// app/Models/User.php
    public function plantRelasi()
    {
        return $this->belongsTo(Plant::class, 'plant'); 
    }

    public function departmentRelasi()
    {
        return $this->belongsTo(Departemen::class, 'department');
    }

}
