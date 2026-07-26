<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Offshore Crewing & Maritime Recruitment',
                'category' => 'Offshore',
                'icon' => 'ship',
                'summary' => 'End-to-end manning for vessels and offshore projects.',
                'description' => "We source, certify, and mobilize crew for OSVs, AHTS, PSVs, FPSO support vessels, tankers, tugs, and dredgers. Our talent pool covers Masters, Chief Officers, Chief Engineers, ETOs, Cooks, Catering crew, Medics, ROV Technicians, Ratings, Mechanics, Electricians, Welders/Fabricators, Bunker crew, Mooring crew, Tank cleaners, and BOSEIT crew — all validated against STCW, flag endorsement, medical, and MLC 2006 requirements.",
                'deliverables' => [
                    'Candidate sourcing from our certified seafarer database',
                    'Document validation: STCW, Flag endorsement, Seaman Book, Medical, BOSEIT, HUET',
                    'Mobilization: visas, flights, travel, joining',
                    'Crew management: contracts, payroll, relief planning, repatriation',
                    'Crew welfare and incident reporting per MLC 2006',
                ],
                'order' => 1,
            ],
            [
                'title' => 'Landbase Recruitment',
                'category' => 'Land-Based',
                'icon' => 'briefcase',
                'summary' => 'Talent acquisition for shore-based operations in ports, logistics, energy, and services.',
                'description' => 'We place qualified personnel across ports, logistics, construction, manufacturing, and facility management — from drivers and technicians to HSE officers and administrative staff. Every candidate passes through structured job profiling, screening, and background checks before onboarding.',
                'deliverables' => [
                    'Drivers, Cleaners, HSE Officers, Admin, Finance, Technicians',
                    'Port Operations, Electricians, Welders/Fabricators, Plumbers',
                    'Forklift Operators, Transport Staff, Messengers, Gardeners',
                    'Security Guards and general facility support staff',
                ],
                'order' => 2,
            ],
            [
                'title' => 'Consultancy Services',
                'category' => 'Consultancy',
                'icon' => 'academic-cap',
                'summary' => 'Expert advisory to improve compliance, safety, and workforce efficiency.',
                'description' => 'Our consultants help maritime and land-based operators stay ahead of regulatory change while strengthening internal HR and safety systems.',
                'deliverables' => [
                    'Maritime Compliance Consultancy: GMA audit, MLC readiness, STCW gap analysis',
                    'HR & Organizational Consultancy: policy development, job evaluation, performance systems',
                    'HSE Consultancy: risk assessment, safety training, PPE programs, incident investigation',
                    'Local Content Advisory: support for Ghanaian content compliance in oil & gas and maritime',
                ],
                'order' => 3,
            ],
            [
                'title' => 'Logistics & Operations Support',
                'category' => 'Logistics',
                'icon' => 'truck',
                'summary' => 'We handle the movement of people and materials to keep operations running.',
                'description' => 'From crew changes to cargo clearance, our logistics team coordinates the moving parts so vessel owners and contractors can stay focused on operations.',
                'deliverables' => [
                    'Crew Logistics: domestic/international travel, hotel, airport transfers, crew change coordination',
                    'Vessel Husbandry: port clearance, provisioning, bunkering coordination, waste disposal',
                    'Cargo & Equipment Logistics: freight forwarding, customs clearance, haulage for offshore/land projects',
                    'Transport Services: staff bus services, vehicle leasing with drivers for project sites',
                ],
                'order' => 4,
            ],
            [
                'title' => 'HR Outsourcing',
                'category' => 'HR Outsourcing',
                'icon' => 'users',
                'summary' => 'Act as your external HR department, reducing admin burden and compliance risk.',
                'description' => 'We manage the full HR lifecycle for land-based and offshore companies alike — from contract administration to payroll, welfare, and audit documentation — so you carry less compliance risk.',
                'deliverables' => [
                    'Land-Based: medicals, insurance, grievance handling, monthly HR dashboards, contract management, Ghana Labour Act compliance, recruitment, onboarding, exit management, attendance and leave management, training',
                    'Offshore: payroll with sea pay/offshore pay/travel pay allowances, contract administration per MLC and flag state requirements, medical/insurance/welfare management, rotation planning, incident reporting and audit documentation',
                ],
                'order' => 5,
            ],
        ];

        foreach ($services as $service) {
            $slug = Str::slug($service['title']);

            Service::updateOrCreate(
                ['slug' => $slug],
                array_merge($service, ['slug' => $slug, 'is_active' => true])
            );
        }
    }
}
