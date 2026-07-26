<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeHighlight extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'icon',
        'button_text',
        'button_url',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
