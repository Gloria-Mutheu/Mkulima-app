import forms from "@tailwindcss/forms";
import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Define your custom colors here
                blue_cart: "#78C1F3",
                blue_primary_dark: "#1D5D9B",
            },
        },
    },

    plugins: [
        forms,
        function ({ addUtilities }) {
            const newUtilities = {
                ".grid-cols-auto-fit": {
                    gridTemplateColumns:
                        "repeat(auto-fill, minmax(350px, 1fr))",
                },
            };
            addUtilities(newUtilities);
        },
    ],
};
