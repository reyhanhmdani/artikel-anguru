import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                "gold": "#C3A16C",
                "secondary-gold" : "#fcba03",
                "dark-bg": "#121212",
                "card-bg": "#1a1a1a",
                "text-primary": "#e0e0e0",
                "text-secondary": "#a0a0a0",
                "text-dark": "#121212",
            },
            boxShadow: {
                "datta-sm": "0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)",
                "datta-md": "0 0.5rem 1rem rgba(0, 0, 0, 0.15)",
                "datta-lg": "0 1rem 3rem rgba(0, 0, 0, 0.175)",
            },
            borderRadius: {
                "datta-default": "0.25rem", // 4px
                "datta-lg": "0.5rem", // 8px
            },
            fontFamily: {
                sans: ["Inter", "sans-serif"],
                khusus: ["Cormorant Garamond", "serif"],
                opensans: ['"Open Sans"', "sans-serif"], // Font umum Datta Able
                heading: ['"Montserrat"', "sans-serif"],
            },
        },
    },

    plugins: [
        forms,
        require("@tailwindcss/typography"),
    ],
};
