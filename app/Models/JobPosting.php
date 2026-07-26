<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPosting extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'sector',
        'location',
        'employment_type',
        'vessel_type',
        'description',
        'requirements',
        'closing_date',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'closing_date' => 'date',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
}
