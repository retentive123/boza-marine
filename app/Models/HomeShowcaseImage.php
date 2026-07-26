<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeShowcaseImage extends Model
{
    protected $fillable = [
        'image_path',
        'caption',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
