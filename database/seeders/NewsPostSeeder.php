<?php

namespace Database\Seeders;

use App\Models\NewsPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Boza Marine Solutions Achieves Full MLC 2006 Compliance Review',
                'category' => 'Compliance',
                'excerpt' => 'Our crew welfare and documentation processes have passed an independent MLC 2006 compliance review, reinforcing our commitment to seafarer welfare standards.',
                'body' => "Boza Marine Solutions and Crewing Services has completed an independent review of its crew welfare, documentation, and repatriation processes against the Maritime Labour Convention (MLC) 2006 standard.\n\nThe review covered candidate sourcing, medical and certification validation, contract administration, and incident reporting procedures across our offshore crewing operations.\n\nThis milestone reflects our ongoing commitment to compliance-driven operations — ensuring every seafarer we place is certified, protected, and supported throughout their contract.",
                'published_at' => now()->subDays(5)->toDateString(),
            ],
            [
                'title' => 'Expanding Our Landbase Recruitment Network Across the Western Region',
                'category' => 'Company News',
                'excerpt' => 'We are growing our landbase recruitment capacity to better serve logistics, construction, and facility management clients across Ghana\'s Western Region.',
                'body' => "As demand for skilled land-based talent continues to grow across ports, logistics, and industrial operations in the Western Region, Boza Marine Solutions is expanding its recruitment and screening capacity.\n\nOur team has strengthened its candidate database across roles including HSE officers, technicians, drivers, and facility support staff — all processed through our structured job profiling, screening, and background check pipeline.\n\nClients in construction, logistics, and facility management can now expect faster turnaround on landbase placements without compromising on compliance or candidate quality.",
                'published_at' => now()->subDays(14)->toDateString(),
            ],
            [
                'title' => '48-Hour Mobilization: How We Keep Offshore Projects on Schedule',
                'category' => 'Crew Welfare',
                'excerpt' => 'A look at how our pre-qualified seafarer database and streamlined document validation process enable rapid crew mobilization for offshore clients.',
                'body' => "Offshore projects can't afford delays — which is why rapid, compliant mobilization is central to how Boza Marine Solutions operates.\n\nOur certified seafarer database is continuously validated against STCW, flag endorsement, medical, and MLC 2006 requirements, meaning candidates are ready to deploy the moment a request comes in. Combined with our in-house logistics team handling visas, flights, and travel coordination, we're able to mobilize qualified crew within 48 hours for most offshore roles.\n\nThis capability has been key to supporting marine contractors and FPSO operators across West Africa who need reliable crew changes on tight schedules.",
                'published_at' => now()->subDays(28)->toDateString(),
            ],
        ];

        foreach ($posts as $post) {
            $slug = Str::slug($post['title']);

            NewsPost::updateOrCreate(
                ['slug' => $slug],
                array_merge($post, ['slug' => $slug, 'is_published' => true])
            );
        }
    }
}
