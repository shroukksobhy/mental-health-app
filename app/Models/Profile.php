<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'role_id'
    ];
    protected $attributes = [
        'is_active' => false,
        'role_id' => [0,1]
    ];
}