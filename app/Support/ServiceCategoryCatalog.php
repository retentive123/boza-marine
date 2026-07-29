<?php

namespace App\Support;

class ServiceCategoryCatalog
{
    /**
     * The fixed set of service categories shown in the admin dropdown.
     */
    public static function categories(): array
    {
        return [
            'Offshore',
            'Land-Based',
            'Consultancy',
            'Logistics',
            'HR Outsourcing',
        ];
    }
}
