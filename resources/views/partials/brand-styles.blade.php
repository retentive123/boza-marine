@php
    $brand = \App\Models\SiteSetting::current();
    $headingStack = \App\Support\FontCatalog::headingStack($brand->font_heading ?: 'Fraunces');
    $bodyStack = \App\Support\FontCatalog::bodyStack($brand->font_body ?: 'Plus Jakarta Sans');
@endphp

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="{{ \App\Support\FontCatalog::googleFontsUrl($brand->font_heading ?: 'Fraunces', $brand->font_body ?: 'Plus Jakarta Sans') }}" rel="stylesheet">

<style>
    :root {
        --color-primary: {{ $brand->color_primary ?: '#128dc4' }};
        --color-secondary: {{ $brand->color_secondary ?: '#0a1626' }};
        --color-accent: {{ $brand->color_accent ?: '#f5a623' }};
        --font-heading: {!! $headingStack !!};
        --font-body: {!! $bodyStack !!};
    }
</style>

@if ($brand->favicon_path)
    <link rel="icon" href="{{ asset('storage/'.$brand->favicon_path) }}">
@else
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='19' fill='%230a1626'/%3E%3Ccircle cx='20' cy='20' r='13' fill='none' stroke='%23f5a623' stroke-width='1.8'/%3E%3Ccircle cx='20' cy='20' r='2.2' fill='%23f5a623'/%3E%3C/svg%3E">
@endif
