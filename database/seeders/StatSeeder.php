<?php

namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            ['label' => 'Mobilization Time', 'value' => '48', 'suffix' => 'hrs', 'order' => 1],
            ['label' => 'Regulatory Frameworks Aligned', 'value' => '4', 'suffix' => '+', 'order' => 2],
            ['label' => 'Global Crewing Network Regions', 'value' => '4', 'suffix' => '', 'order' => 3],
            ['label' => 'Service Lines', 'value' => '5', 'suffix' => '', 'order' => 4],
        ];

        foreach ($stats as $stat) {
            Stat::updateOrCreate(['label' => $stat['label']], $stat);
        }
    }
}
