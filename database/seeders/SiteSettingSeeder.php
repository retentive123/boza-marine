<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $setting = SiteSetting::first();

        $data = [
            'company_name' => 'Boza Marine Solutions and Crewing Services Ltd.',
            'tagline' => 'People. Compliance. Operations. Delivered',
            'hero_title' => 'Certified Crew. Compliant HR. Reliable Logistics.',
            'hero_subtitle' => 'Boza Marine Solutions bridges the gap between maritime companies and qualified seafarers — while delivering compliant HR and logistics solutions for land-based operations across West Africa.',
            'about_text' => 'Boza Marine Solutions and Crewing Services is a Ghanaian-owned integrated maritime and HR solutions company. We support offshore and land-based companies across shipping, oil and gas, logistics, and industrial sectors, bridging the gap between maritime companies and qualified seafarers while providing compliant HR solutions that let vessel owners and marine contractors focus on operations.',
            'goal_text' => 'Deliver certified people, compliant processes, and reliable logistics so our clients can focus on core operations.',
            'vision_text' => "To be West Africa's trusted partner for safe, compliant, and efficient marine manpower solutions.",
            'mission_text' => 'Deliver certified crew and HR services that meet international maritime standards while supporting local employment.',
            'showcase_title' => 'Life at Boza',
            'showcase_text' => 'A glimpse of our crew, operations, and the people delivering certified, compliant service across West Africa.',
            'address' => 'Takoradi, Western Region, Ghana',
            'email_primary' => 'bozamarinesolutions@gmail.com',
            'email_secondary' => 'bozamarineservices@gmail.com',
            'phone_primary' => '+233 50 569 5555',
            'phone_secondary' => '+233 20 835 2627',
            'facebook_url' => null,
            'linkedin_url' => null,
            'whatsapp_url' => null,
        ];

        if ($setting) {
            $setting->update($data);
        } else {
            SiteSetting::create($data);
        }
    }
}
