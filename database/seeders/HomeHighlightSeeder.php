<?php

namespace Database\Seeders;

use App\Models\HomeHighlight;
use Illuminate\Database\Seeder;

class HomeHighlightSeeder extends Seeder
{
    public function run(): void
    {
        $highlights = [
            [
                'title' => '48-Hour Mobilization',
                'description' => 'Our pre-qualified seafarer database and in-house logistics team mean certified crew can be mobilized for offshore projects within 48 hours — visas, flights, and travel fully coordinated.',
                'icon' => 'bolt',
                'button_text' => 'See Our Services',
                'button_url' => '/services',
                'order' => 1,
            ],
            [
                'title' => 'Compliance You Can Verify',
                'description' => 'Every seafarer we place is validated against STCW, flag endorsement, medical, and MLC 2006 requirements. Every HR process is audited against the Ghana Labour Act 2003. Nothing is left to chance.',
                'icon' => 'shield-check',
                'button_text' => 'Meet Our Leadership',
                'button_url' => '/leadership',
                'order' => 2,
            ],
            [
                'title' => 'One Team, End to End',
                'description' => 'From candidate sourcing to crew change logistics, HR outsourcing to consultancy — one team manages the full lifecycle, so vessel owners and contractors can stay focused on operations.',
                'icon' => 'globe',
                'button_text' => 'Get in Touch',
                'button_url' => '/contact',
                'order' => 3,
            ],
        ];

        foreach ($highlights as $highlight) {
            HomeHighlight::updateOrCreate(
                ['title' => $highlight['title']],
                array_merge($highlight, ['is_active' => true])
            );
        }
    }
}
