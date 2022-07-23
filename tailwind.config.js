/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['index.html'],
  theme: {
    extend: {
      colors: {
        primary: '#EBC788',
        dark: '#818F8F',
        darken: '#3E5351',
      },
      fontFamily: {
        poppins: ["Poppins", 'sans-serif'],
      },
    },
  },
  plugins: [],
}
