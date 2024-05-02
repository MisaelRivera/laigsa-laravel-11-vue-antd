const defaultTheme = require('tailwindcss/defaultTheme');
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        roboto: ['"Roboto"', ...defaultTheme.fontFamily.sans],
        slab: ['"Roboto Slab"', ...defaultTheme.fontFamily.sans]
      },
      colors: {
        'royal-blue': '#246791',
      }
    },
  },
  plugins: [],
}