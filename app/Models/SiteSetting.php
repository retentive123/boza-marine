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
        'tiktok_url',
        'youtube_url',
        'whatsapp_agents_enabled',
        'whatsapp_agent_1_name',
        'whatsapp_agent_1_number',
        'whatsapp_agent_1_active',
        'whatsapp_agent_1_photo',
        'whatsapp_agent_2_name',
        'whatsapp_agent_2_number',
        'whatsapp_agent_2_active',
        'whatsapp_agent_2_photo',
        'whatsapp_agent_3_name',
        'whatsapp_agent_3_number',
        'whatsapp_agent_3_active',
        'whatsapp_agent_3_photo',
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
        'whatsapp_agents_enabled' => 'boolean',
        'whatsapp_agent_1_active' => 'boolean',
        'whatsapp_agent_2_active' => 'boolean',
        'whatsapp_agent_3_active' => 'boolean',
    ];

    public static function current(): self
    {
        return static::first() ?? static::create([]);
    }

    public function whatsappAgents(): \Illuminate\Support\Collection
    {
        if (! $this->whatsapp_agents_enabled) {
            return collect();
        }

        return collect([1, 2, 3])
            ->map(fn ($i) => [
                'name' => $this->{"whatsapp_agent_{$i}_name"},
                'number' => $this->{"whatsapp_agent_{$i}_number"},
                'active' => $this->{"whatsapp_agent_{$i}_active"},
                'photo' => $this->{"whatsapp_agent_{$i}_photo"},
            ])
            ->filter(fn ($agent) => $agent['active'] && filled($agent['name']) && filled($agent['number']))
            ->values();
    }
}
