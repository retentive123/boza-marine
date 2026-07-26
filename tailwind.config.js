import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    safelist: [
        'reveal-visible',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['var(--font-body)', '"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                navy: {
                    50: '#eef1f6',
                    100: '#d3dae8',
                    200: '#a8b7d1',
                    300: '#7d94ba',
                    400: '#4f6da0',
                    500: '#2c4a7c',
                    600: '#1c355f',
                    700: '#142848',
                    800: '#0d1c33',
                    900: '#0a1626',
                    950: '#060d18',
                },
                ocean: {
                    50: '#e6f7fd',
                    100: '#c0ecfa',
                    200: '#8ddaf3',
                    300: '#5cc3ea',
                    400: '#2aa8dd',
                    500: '#128dc4',
                    600: '#0d6fa0',
                    700: '#0a577f',
                    800: '#084363',
                    900: '#06324a',
                },
                gold: {
                    50: '#fff8e6',
                    100: '#ffedbf',
                    200: '#ffdc85',
                    300: '#ffc94d',
                    400: '#ffb81f',
                    500: '#f5a623',
                    600: '#d1860f',
                    700: '#a8690c',
                    800: '#7d4d09',
                    900: '#543306',
                },
            },
            boxShadow: {
                soft: '0 10px 40px -10px rgba(10, 22, 38, 0.15)',
            },
        },
    },

    plugins: [forms],
};
