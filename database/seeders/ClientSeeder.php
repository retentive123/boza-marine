<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Onshore Offshore Solutions Ghana', 'order' => 1],
            ['name' => 'North-Brook Limited', 'order' => 2],
        ];

        foreach ($items as $item) {
            Client::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
