import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
         './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
          colors: {
                'gray-light': '#edf2f7',
                'gray-ligher' : ' #f7fafc'
            },

              fontFamily: {
                sans: [
                    '-apple-system',
                    'BlinkMacSystemFont',
                    '"Segoe UI"', 
                    'Roboto',
                    '"Helvetica Neue"',
                    'sans-serif',
                ],
            },
        },
    },
    plugins: [],
};
