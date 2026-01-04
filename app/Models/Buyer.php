<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Buyer extends Authenticatable
{
    use HasFactory;

    protected $table = 'buyers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'store_name',
        'store_description',
    ];

    protected $hidden = ['password'];
}
