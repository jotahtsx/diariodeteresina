/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class', 

  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Se você quiser padronizar o seu vermelho do portal
        'portal-red': '#EA2027',
      }
    },
  },
  plugins: [],
}