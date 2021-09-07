module.exports = {
  purge: {
    content: [
      './app/**/*.php',
      './resources/**/*.{php,vue,js}',
    ],
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        white: '#fff',
        black: '#000',
        primary: '#F0A341',
        secondary: '#C22D28',
        themeGreen: '#357C4C',
        themeRed: '#871D3D',
        themeBrown: '#A0643D',
        themeMagenta: '#C63973',
        themeTortilla: '#D09468'
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [require('@tailwindcss/typography')],
};
