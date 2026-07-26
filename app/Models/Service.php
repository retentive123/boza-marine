<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'icon',
        'image_path',
        'summary',
        'description',
        'deliverables',
        'order',
        'is_active',
    ];

    protected $casts = [
        'deliverables' => 'array',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
