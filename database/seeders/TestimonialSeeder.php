<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Operations Manager',
                'role' => 'Offshore Marine Contractor',
                'quote' => 'Boza Marine mobilized a full crew within 48 hours and every document was audit-ready. That kind of reliability is rare in this region.',
                'order' => 1,
            ],
            [
                'name' => 'HR Director',
                'role' => 'Facility Management Contractor',
                'quote' => 'Outsourcing our HR compliance to Boza cut our admin burden significantly while keeping us fully aligned with the Labour Act.',
                'order' => 2,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['name' => $testimonial['name'], 'role' => $testimonial['role']],
                array_merge($testimonial, ['is_active' => true])
            );
        }
    }
}
