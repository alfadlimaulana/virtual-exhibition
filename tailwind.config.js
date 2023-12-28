/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");

export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        extend: {
            colors: {
                brand: {
                    gray: "#4A5759",
                    blue: {
                        900: "#6d8896",
                        800: "#7f9eaf",
                        700: "#91b5c8",
                        600: "#a3cbe1",
                        500: "#b5e2fa",
                        400: "#bce5fb",
                        300: "#c4e8fb",
                        200: "#cbebfc",
                        100: "#d3eefc",
                    },
                    cream: "#F9F7F3",
                    yellow: {
                        900: "#8e8562",
                        800: "#a69b73",
                        700: "#beb283",
                        600: "#d5c894",
                        500: "#eddea4",
                        400: "#efe1ad",
                        300: "#f1e5b6",
                        200: "#f2e8bf",
                        100: "#f4ebc8",
                    },
                    orange: {
                        900: "#946044",
                        800: "#ad7050",
                        700: "#c6805b",
                        600: "#de9067",
                        500: "#f7a072",
                        400: "#f8aa80",
                        300: "#f9b38e",
                        200: "#f9bd9c",
                        100: "#fac6aa",
                    },
                },
            },
        },
        screens: {
            xs: "475px",
            ...defaultTheme.screens,
        },
        container: {
            center: true,
            padding: {
                DEFAULT: "1rem",
                sm: "2rem",
                md: "3rem",
                lg: "4rem",
                xl: "5rem",
            },
        },
    },
    plugins: [],
};
