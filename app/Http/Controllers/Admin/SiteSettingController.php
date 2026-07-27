<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\FontCatalog;
use App\Support\HeadlineAnimationCatalog;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    use HandlesImageUploads;

    public function edit()
    {
        return view('admin.settings.edit', [
            'settings' => SiteSetting::current(),
            'headingFonts' => array_keys(FontCatalog::headingFonts()),
            'bodyFonts' => array_keys(FontCatalog::bodyFonts()),
            'animationTypes' => HeadlineAnimationCatalog::types(),
            'animationStyles' => HeadlineAnimationCatalog::styles(),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:1000'],
            'hero_headline_prefix' => ['nullable', 'string', 'max:255'],
            'hero_headline_words' => ['nullable', 'string', 'max:2000'],
            'hero_headline_suffix' => ['nullable', 'string', 'max:255'],
            'hero_headline_animation_type' => ['required', 'string', 'in:'.implode(',', array_keys(HeadlineAnimationCatalog::types()))],
            'hero_headline_animation_style' => ['required', 'string', 'in:'.implode(',', array_keys(HeadlineAnimationCatalog::styles()))],
            'about_text' => ['nullable', 'string'],
            'goal_text' => ['nullable', 'string'],
            'vision_text' => ['nullable', 'string'],
            'mission_text' => ['nullable', 'string'],
            'showcase_title' => ['nullable', 'string', 'max:255'],
            'showcase_text' => ['nullable', 'string', 'max:1000'],
            'address' => ['nullable', 'string', 'max:255'],
            'email_primary' => ['nullable', 'email', 'max:255'],
            'email_secondary' => ['nullable', 'email', 'max:255'],
            'phone_primary' => ['nullable', 'string', 'max:50'],
            'phone_secondary' => ['nullable', 'string', 'max:50'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'whatsapp_url' => ['nullable', 'url', 'max:255'],
            'tiktok_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'whatsapp_agents_enabled' => ['nullable', 'boolean'],
            'whatsapp_agent_1_name' => ['nullable', 'string', 'max:255'],
            'whatsapp_agent_1_number' => ['nullable', 'string', 'max:20'],
            'whatsapp_agent_1_active' => ['nullable', 'boolean'],
            'whatsapp_agent_1_photo_upload' => ['nullable', 'image', 'max:2048'],
            'remove_whatsapp_agent_1_photo' => ['nullable', 'boolean'],
            'whatsapp_agent_2_name' => ['nullable', 'string', 'max:255'],
            'whatsapp_agent_2_number' => ['nullable', 'string', 'max:20'],
            'whatsapp_agent_2_active' => ['nullable', 'boolean'],
            'whatsapp_agent_2_photo_upload' => ['nullable', 'image', 'max:2048'],
            'remove_whatsapp_agent_2_photo' => ['nullable', 'boolean'],
            'whatsapp_agent_3_name' => ['nullable', 'string', 'max:255'],
            'whatsapp_agent_3_number' => ['nullable', 'string', 'max:20'],
            'whatsapp_agent_3_active' => ['nullable', 'boolean'],
            'whatsapp_agent_3_photo_upload' => ['nullable', 'image', 'max:2048'],
            'remove_whatsapp_agent_3_photo' => ['nullable', 'boolean'],
            'color_primary' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'color_secondary' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'color_accent' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'font_heading' => ['required', 'string', 'in:'.implode(',', array_keys(FontCatalog::headingFonts()))],
            'font_body' => ['required', 'string', 'in:'.implode(',', array_keys(FontCatalog::bodyFonts()))],
            'nav_about_visible' => ['nullable', 'boolean'],
            'nav_leadership_visible' => ['nullable', 'boolean'],
            'nav_services_visible' => ['nullable', 'boolean'],
            'nav_gallery_visible' => ['nullable', 'boolean'],
            'nav_news_visible' => ['nullable', 'boolean'],
            'nav_careers_visible' => ['nullable', 'boolean'],
            'nav_contact_visible' => ['nullable', 'boolean'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:512'],
            'about_image_upload' => ['nullable', 'image', 'max:4096'],
            'hero_background_image_upload' => ['nullable', 'image', 'max:4096'],
            'header_image_about_upload' => ['nullable', 'image', 'max:4096'],
            'header_image_services_upload' => ['nullable', 'image', 'max:4096'],
            'header_image_gallery_upload' => ['nullable', 'image', 'max:4096'],
            'header_image_careers_upload' => ['nullable', 'image', 'max:4096'],
            'header_image_news_upload' => ['nullable', 'image', 'max:4096'],
            'header_image_leadership_upload' => ['nullable', 'image', 'max:4096'],
            'header_image_contact_upload' => ['nullable', 'image', 'max:4096'],
            'remove_logo' => ['nullable', 'boolean'],
            'remove_favicon' => ['nullable', 'boolean'],
            'remove_about_image' => ['nullable', 'boolean'],
            'remove_hero_background_image' => ['nullable', 'boolean'],
            'remove_header_image_about' => ['nullable', 'boolean'],
            'remove_header_image_services' => ['nullable', 'boolean'],
            'remove_header_image_gallery' => ['nullable', 'boolean'],
            'remove_header_image_careers' => ['nullable', 'boolean'],
            'remove_header_image_news' => ['nullable', 'boolean'],
            'remove_header_image_leadership' => ['nullable', 'boolean'],
            'remove_header_image_contact' => ['nullable', 'boolean'],
        ]);

        $settings = SiteSetting::current();

        $validated['logo_path'] = $this->resolveImageField($request, 'logo', 'remove_logo', 'branding', $settings->logo_path);
        $validated['favicon_path'] = $this->resolveImageField($request, 'favicon', 'remove_favicon', 'branding', $settings->favicon_path);
        $validated['about_image'] = $this->resolveImageField($request, 'about_image_upload', 'remove_about_image', 'branding', $settings->about_image);
        $validated['hero_background_image'] = $this->resolveImageField($request, 'hero_background_image_upload', 'remove_hero_background_image', 'branding', $settings->hero_background_image);

        $pageHeaderFields = ['header_image_about', 'header_image_services', 'header_image_gallery', 'header_image_careers', 'header_image_news', 'header_image_leadership', 'header_image_contact'];

        foreach ($pageHeaderFields as $field) {
            $validated[$field] = $this->resolveImageField($request, "{$field}_upload", "remove_{$field}", 'branding', $settings->$field);
        }

        $navVisibilityFields = [
            'nav_about_visible',
            'nav_leadership_visible',
            'nav_services_visible',
            'nav_gallery_visible',
            'nav_news_visible',
            'nav_careers_visible',
            'nav_contact_visible',
        ];

        foreach ($navVisibilityFields as $field) {
            $validated[$field] = $request->boolean($field);
        }

        $validated['whatsapp_agents_enabled'] = $request->boolean('whatsapp_agents_enabled');

        for ($i = 1; $i <= 3; $i++) {
            $validated["whatsapp_agent_{$i}_active"] = $request->boolean("whatsapp_agent_{$i}_active");
            $validated["whatsapp_agent_{$i}_photo"] = $this->resolveImageField($request, "whatsapp_agent_{$i}_photo_upload", "remove_whatsapp_agent_{$i}_photo", 'branding', $settings->{"whatsapp_agent_{$i}_photo"});
        }

        $settings->update(collect($validated)->reject(fn ($value, $key) => str_ends_with($key, '_upload') || str_starts_with($key, 'remove_'))->all());

        return back()->with('success', 'Site settings updated.');
    }

    protected function resolveImageField(Request $request, string $fileField, string $removeField, string $folder, ?string $existingPath): ?string
    {
        if ($request->boolean($removeField)) {
            $this->deleteImage($existingPath);

            return null;
        }

        return $this->replaceImage($request->file($fileField), $folder, $existingPath);
    }
}
