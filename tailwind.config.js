/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['index.html', 'register.html', 'login.html', 'allbook.html', 'book.html', 'profile.html', 'blog.html', 'categories.html', 'dashboard.html', 'dashboard_categories.html', 'dashboard_books.html'],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: '#EBC788',
        dark: '#818F8F',
        darken: '#3E5351',
        bgdark: '#020C1B',
        bgdarken: '#01060f',
        txtdark: '#e5e5e5',
      },
      fontFamily: {
        poppins: ["Poppins", 'sans-serif'],
      },
    },
  },
  plugins: [],
}
