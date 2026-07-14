import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', 'sans-serif'],
                dm: ['DM Sans', 'sans-serif'],
            },
            colors: {
                white: '#ffffff',
                lightPrimary: '#F4F7FE',
                blueSecondary: '#4318FF',
                brandLinear: '#868CFF',
                gray: {
                    50: '#F5F6FA',
                    100: '#EEF0F6',
                    200: '#DADEEC',
                    300: '#C9D0E3',
                    400: '#B0BBD5',
                    500: '#B5BED9',
                    600: '#A3AED0',
                    700: '#707eae',
                    800: '#2D396B',
                    900: '#1B2559',
                },
                navy: {
                    50: '#d0dcfb',
                    100: '#aac0fe',
                    200: '#a3b9f8',
                    300: '#728fea',
                    400: '#3652ba',
                    500: '#1b3bbb',
                    600: '#24388a',
                    700: '#1B254B',
                    800: '#111c44',
                    900: '#0b1437',
                },
                brand: {
                    50: '#E9E3FF',
                    100: '#C0B8FE',
                    200: '#A195FD',
                    300: '#8171FC',
                    400: '#7551FF',
                    500: '#422AFB',
                    600: '#3311DB',
                    700: '#2111A5',
                    800: '#190793',
                    900: '#11047A',
                },
                horizonGreen: {
                    500: '#01B574',
                },
                horizonOrange: {
                    500: '#FFB547',
                },
                horizonRed: {
                    500: '#E31A1A',
                },
            },
            boxShadow: {
                '3xl': '14px 17px 40px 4px rgba(112, 144, 176, 0.08)',
                inset: 'inset 0px 18px 22px rgba(112, 144, 176, 0.08)',
            },
        },
    },

    plugins: [forms],
};
