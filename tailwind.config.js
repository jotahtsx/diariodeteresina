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
        'portal-blue': '#1e40af',
        'portal-yellow': '#facc15',
        'portal-red': '#1e40af',
      }
    },
  },
  plugins: [],
}