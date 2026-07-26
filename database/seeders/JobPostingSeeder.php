<?php

namespace Database\Seeders;

use App\Models\JobPosting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobPostingSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'ETO – Electro-Technical Officer',
                'sector' => 'Offshore',
                'location' => 'West Africa (Offshore)',
                'employment_type' => 'Contract / Rotational',
                'vessel_type' => 'PSV / AHTS',
                'description' => 'We are sourcing a certified Electro-Technical Officer for offshore support vessel operations along the West African coast. Rotation and mobilization support provided.',
                'requirements' => "STCW certification\nValid Seaman's Book and Medical\nMinimum 2 years offshore experience\nBOSEIT / HUET certified",
                'closing_date' => now()->addMonths(2)->toDateString(),
            ],
            [
                'title' => 'HSE Officer',
                'sector' => 'Land-Based',
                'location' => 'Takoradi, Ghana',
                'employment_type' => 'Full-time',
                'vessel_type' => null,
                'description' => 'Oversee site safety, PPE compliance, and incident reporting for a land-based logistics operation in the Western Region.',
                'requirements' => "NEBOSH or equivalent HSE certification\n3+ years HSE experience in industrial or logistics settings\nStrong incident investigation and reporting skills",
                'closing_date' => now()->addMonths(1)->toDateString(),
            ],
            [
                'title' => 'Able Seaman (Rating)',
                'sector' => 'Offshore',
                'location' => 'Gulf of Guinea',
                'employment_type' => 'Contract / Rotational',
                'vessel_type' => 'OSV',
                'description' => 'Ratings needed for offshore supply vessel operations. Certified seafarer database candidates preferred; fast mobilization available.',
                'requirements' => "Valid STCW Basic Safety Training\nSeaman's Book and Medical certificate\nPrevious OSV experience an advantage",
                'closing_date' => now()->addWeeks(6)->toDateString(),
            ],
        ];

        foreach ($jobs as $job) {
            $slug = Str::slug($job['title']).'-'.Str::slug($job['location']);

            JobPosting::updateOrCreate(
                ['slug' => $slug],
                array_merge($job, ['slug' => $slug, 'is_active' => true])
            );
        }
    }
}
