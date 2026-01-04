<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $table = 'sellers';

    protected $fillable = [
        'user_id',
        'store_name',
        'owner_name',
        'email',
        'store_description',
        'status',
        'logo',
        'banner',
        'photos',
        'phone',
        'address',
        'city',
        'province',
        'postal_code',
        'open_time',
        'close_time',
        'operational_days',
        'shipping_estimate',
        'slogan',
        'theme_color',
        'instagram',
        'facebook',
        'tiktok',
        'website',
    ];

    protected $casts = [
        'photos' => 'array',
    ];
}
