<?php

namespace Database\Seeders;

use App\Models\Differentiator;
use Illuminate\Database\Seeder;

class DifferentiatorSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'One-Stop Provider',
                'description' => 'Crewing, HR, logistics, and consultancy under one roof.',
                'icon' => 'building-office',
                'order' => 1,
            ],
            [
                'title' => 'Compliance Driven',
                'description' => 'Zero tolerance for documentation or statutory breaches.',
                'icon' => 'shield-check',
                'order' => 2,
            ],
            [
                'title' => 'Dual Sector Expertise',
                'description' => 'We understand both offshore rigors and land-based operations.',
                'icon' => 'scale',
                'order' => 3,
            ],
            [
                'title' => 'Speed to Deploy',
                'description' => 'Pre-qualified talent pool for 48-hour mobilization.',
                'icon' => 'bolt',
                'order' => 4,
            ],
            [
                'title' => 'Local Presence, Global Network',
                'description' => 'Ghana-based with a network of crewing agents across West Africa, the Middle East, Asia, and Europe.',
                'icon' => 'globe',
                'order' => 5,
            ],
            [
                'title' => 'Cadet Development',
                'description' => 'We recruit and maintain a database of Engine and Deck Cadets, including female candidates, ready to learn and build experience at sea.',
                'icon' => 'academic-cap',
                'order' => 6,
            ],
        ];

        foreach ($items as $item) {
            Differentiator::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
