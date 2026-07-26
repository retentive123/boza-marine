<?php

namespace App\Support;

class FontCatalog
{
    /**
     * Curated heading (display) fonts: name => [Google Fonts param, CSS fallback stack].
     */
    public static function headingFonts(): array
    {
        return [
            'Fraunces' => ['Fraunces:opsz,wght@9..144,500;9..144,600', 'ui-serif, Georgia, serif'],
            'Playfair Display' => ['Playfair+Display:wght@500;600;700', 'ui-serif, Georgia, serif'],
            'Merriweather' => ['Merriweather:wght@400;700', 'ui-serif, Georgia, serif'],
            'Libre Baskerville' => ['Libre+Baskerville:wght@400;700', 'ui-serif, Georgia, serif'],
            'Cormorant Garamond' => ['Cormorant+Garamond:wght@500;600;700', 'ui-serif, Georgia, serif'],
            'Poppins' => ['Poppins:wght@500;600;700', 'ui-sans-serif, system-ui, sans-serif'],
        ];
    }

    /**
     * Curated body (text) fonts: name => [Google Fonts param, CSS fallback stack].
     */
    public static function bodyFonts(): array
    {
        return [
            'Plus Jakarta Sans' => ['Plus+Jakarta+Sans:wght@400;500;600;700', 'ui-sans-serif, system-ui, sans-serif'],
            'Inter' => ['Inter:wght@400;500;600;700', 'ui-sans-serif, system-ui, sans-serif'],
            'Nunito Sans' => ['Nunito+Sans:wght@400;500;600;700', 'ui-sans-serif, system-ui, sans-serif'],
            'Work Sans' => ['Work+Sans:wght@400;500;600;700', 'ui-sans-serif, system-ui, sans-serif'],
            'Source Sans 3' => ['Source+Sans+3:wght@400;500;600;700', 'ui-sans-serif, system-ui, sans-serif'],
            'Poppins' => ['Poppins:wght@400;500;600;700', 'ui-sans-serif, system-ui, sans-serif'],
        ];
    }

    public static function googleFontsUrl(string $heading, string $body): string
    {
        $heading = static::headingFonts()[$heading] ?? static::headingFonts()['Fraunces'];
        $body = static::bodyFonts()[$body] ?? static::bodyFonts()['Plus Jakarta Sans'];

        $families = collect([$heading[0], $body[0]])->unique()->map(fn ($f) => 'family='.$f)->implode('&');

        return "https://fonts.googleapis.com/css2?{$families}&display=swap";
    }

    public static function stack(string $name, array $catalog): string
    {
        $entry = $catalog[$name] ?? reset($catalog);

        return "'{$name}', {$entry[1]}";
    }

    public static function headingStack(string $name): string
    {
        return static::stack($name, static::headingFonts());
    }

    public static function bodyStack(string $name): string
    {
        return static::stack($name, static::bodyFonts());
    }
}
