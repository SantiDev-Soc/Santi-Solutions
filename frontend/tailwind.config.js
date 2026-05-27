/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
    ],
    theme: {
        extend: {
            colors: {
                'santi-blue': '#003366',
                'santi-gold': '#C5A021',
            }
        },
    },
    plugins: [],
}
