/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        './storage/framework/views/*.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
        'node_modules/preline/dist/*.js',
    ],
  theme: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/typography'),
      require('preline/plugin'),
  ],
}

