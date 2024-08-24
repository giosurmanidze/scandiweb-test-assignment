/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  theme: {
      extend: {
          colors: {
             scandiweb_red: "#E04F4F"
          },
          fontFamily: {
            'heading_font': ['SecularOne', 'sans-serif'],
            'body_text_font': ['Inter-VariableFont', 'sans-serif'],
            'SecularOne400': ['SecularOne400', 'sans-serif'],
          },
          screens: {
              sm: '320px',
          }
      }
  },
  plugins: []
}