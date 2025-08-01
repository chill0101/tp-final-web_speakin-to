import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                primary: '#ff3366',      // Azul principal (botones, enlaces activos)
                secondary: '#011627',    // Gris oscuro (fondos, nav, textos secundarios)
                accent: '#20A4F3',       // Naranja/acento (elementos destacados, hover)
                neutral: '#F6F7F8',      // Gris claro (fondos, tarjetas)
                info: '#38bdf8',         // Azul claro (mensajes informativos)
                success: '#22c55e',      // Verde (mensajes de éxito)
                warning: '#fbbf24',      // Amarillo (advertencias)
                error: '#ef4444',        // Rojo (errores)
                background: '#f8fafc',   // Fondo general
                text: '#0f172a',         // Texto principal  // Texto claro
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
