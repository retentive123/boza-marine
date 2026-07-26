<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Boza Marine Solutions') }}</title>

        @include('partials.brand-styles')

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-navy-900 antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center bg-brand-hero px-4 py-12">
            <a href="{{ route('home') }}">
                <x-logo light class="justify-center" />
            </a>

            <div class="mt-8 w-full max-w-md overflow-hidden rounded-2xl bg-white px-6 py-8 shadow-soft sm:px-10">
                {{ $slot }}
            </div>

            <p class="mt-6 text-xs text-white/40">&copy; {{ now()->year }} Boza Marine Solutions and Crewing Services Ltd.</p>
        </div>
    </body>
</html>
