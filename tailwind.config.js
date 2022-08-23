/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: 'jit',
  content: ['index.php', 'register.php', 'login.php', 'allbook.php', 'book.php', 'profile.php', 'categories.php', 'category.php', './admin/template/header.php', './admin/template/sidebar.php', './admin/index.php', './admin/print_member.php', './admin/categories_data.php', './admin/books_data.php', './admin/update_book.php', './admin/members_data.php', './admin/insert_book.php', './admin/insert_member.php', './admin/insert_transaction.php', './member/index.php', './admin/transactions_data.php', './member/index.php', 'template/header.php', 'template/footer.php'],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: '#ED2024',
        dark: '#818F8F',
        darken: '#262626',
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
