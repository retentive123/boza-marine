<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'company_name',
        'tagline',
        'hero_title',
        'hero_subtitle',
        'hero_headline_prefix',
        'hero_headline_words',
        'hero_headline_suffix',
        'hero_headline_animation_type',
        'hero_headline_animation_style',
        'about_text',
        'goal_text',
        'vision_text',
        'mission_text',
        'showcase_title',
        'showcase_text',
        'address',
        'email_primary',
        'email_secondary',
        'phone_primary',
        'phone_secondary',
        'facebook_url',
        'linkedin_url',
        'whatsapp_url',
        'logo_path',
        'favicon_path',
        'about_image',
        'hero_background_image',
        'header_image_about',
        'header_image_services',
        'header_image_gallery',
        'header_image_careers',
        'header_image_contact',
        'header_image_news',
        'header_image_leadership',
        'color_primary',
        'color_secondary',
        'color_accent',
        'font_heading',
        'font_body',
        'nav_about_visible',
        'nav_leadership_visible',
        'nav_services_visible',
        'nav_gallery_visible',
        'nav_news_visible',
        'nav_careers_visible',
        'nav_contact_visible',
    ];

    protected $casts = [
        'nav_about_visible' => 'boolean',
        'nav_leadership_visible' => 'boolean',
        'nav_services_visible' => 'boolean',
        'nav_gallery_visible' => 'boolean',
        'nav_news_visible' => 'boolean',
        'nav_careers_visible' => 'boolean',
        'nav_contact_visible' => 'boolean',
    ];

    public static function current(): self
    {
        return static::first() ?? static::create([]);
    }
}
