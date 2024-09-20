/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                secondary: "#ffe6e2"
            },
            screens: {
                "xs": "480px",
            },
            transitionProperty: {
                "width": "width",
                "height": "height",
            }
        },
    },
    plugins: [],
}

