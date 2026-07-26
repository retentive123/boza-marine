<?php

namespace App\Support;

class HeadlineAnimationCatalog
{
    /**
     * Animation Type: the overall behavior of the rotating headline.
     */
    public static function types(): array
    {
        return [
            'rotate' => 'Rotate (words swap in/out)',
            'typing' => 'Typing (typewriter effect)',
        ];
    }

    /**
     * Animation Style: the transition used between words. Only applies when
     * Animation Type is "rotate" — ignored for "typing".
     */
    public static function styles(): array
    {
        return [
            'fade' => 'Fade',
            'slide-up' => 'Slide Up',
            'slide-down' => 'Slide Down',
            'flip' => 'Flip',
            'zoom' => 'Zoom',
        ];
    }

    /**
     * Alpine x-transition enter/leave classes for a given style, keyed as
     * [enterStart, enterEnd, leaveStart, leaveEnd].
     */
    public static function transitionClasses(string $style): array
    {
        return match ($style) {
            'fade' => [
                'opacity-0', 'opacity-100',
                'opacity-100', 'opacity-0',
            ],
            'slide-down' => [
                'opacity-0 -translate-y-2', 'opacity-100 translate-y-0',
                'opacity-100 translate-y-0', 'opacity-0 translate-y-2',
            ],
            'flip' => [
                'opacity-0 [transform:rotateX(90deg)]', 'opacity-100 [transform:rotateX(0deg)]',
                'opacity-100 [transform:rotateX(0deg)]', 'opacity-0 [transform:rotateX(-90deg)]',
            ],
            'zoom' => [
                'opacity-0 scale-75', 'opacity-100 scale-100',
                'opacity-100 scale-100', 'opacity-0 scale-125',
            ],
            default => [ // slide-up
                'opacity-0 translate-y-2', 'opacity-100 translate-y-0',
                'opacity-100 translate-y-0', 'opacity-0 -translate-y-2',
            ],
        };
    }
}
