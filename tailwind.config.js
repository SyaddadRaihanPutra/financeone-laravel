import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Maison', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'fade-in-up': 'fadeInUp 0.7s ease-out',
              },
              keyframes: {
                fadeInUp: {
                  '0%': {
                    opacity: '0',
                    transform: 'translateY(20px)'
                  },
                  '100%': {
                    opacity: '1',
                    transform: 'translateY(0)'
                  }
                }
              }
        },
    },

    plugins: [forms, typography],
};
