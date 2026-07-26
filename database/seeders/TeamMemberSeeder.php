<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => "Add Director's Name",
                'role' => 'Managing Director',
                'category' => 'Director',
                'bio' => 'Replace this placeholder bio in Admin → Leadership Team. Oversees strategic direction across crewing, HR outsourcing, consultancy, and logistics operations.',
                'order' => 1,
            ],
            [
                'name' => "Add Director's Name",
                'role' => 'Director of Operations',
                'category' => 'Director',
                'bio' => 'Replace this placeholder bio in Admin → Leadership Team. Leads day-to-day offshore and land-based operations and compliance oversight.',
                'order' => 2,
            ],
            [
                'name' => "Add Manager's Name",
                'role' => 'Head of Crewing & Recruitment',
                'category' => 'Management',
                'bio' => 'Replace this placeholder bio in Admin → Leadership Team. Manages the certified seafarer database and candidate sourcing pipeline.',
                'order' => 3,
            ],
            [
                'name' => "Add Manager's Name",
                'role' => 'Head of HR & Compliance',
                'category' => 'Management',
                'bio' => 'Replace this placeholder bio in Admin → Leadership Team. Runs HR outsourcing services for land-based and offshore clients.',
                'order' => 4,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name'], 'role' => $member['role']],
                array_merge($member, ['is_active' => true])
            );
        }
    }
}
