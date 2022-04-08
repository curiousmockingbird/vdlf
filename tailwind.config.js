module.exports = {
  important: true,
  purge: {
    content: [
      './app/**/*.php',
      './resources/**/*.{php,vue,js}',
    ],
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    container: {
      padding: {
        DEFAULT: '1rem',
        md: '1.5rem',
        lg: '3rem',
        xl: '4rem'
      },
      center: true,
      screens: {
        sm: "100%",
        md: "100%",
        lg: "100%",
        xl: "100%",
        '2xl': "1280px"
      }
    },
    extend: {
      fontSize: {
        'xs': '.75rem',
        'sm': '.875rem',
        'tiny': '.875rem',
        'base': '1rem',
        'lg': '1.125rem',
        'xl': '1.25rem',
        '2xl': '1.5rem',
        '3xl': '1.875rem',
        '4xl': '2.25rem',
        '5xl': '3rem',
        '6xl': '4rem',
        '7xl': '5rem',
        'display': '4rem',
        'heading': '1.5rem',
        'paragraph': '1.125rem'
      },
      fontFamily: {
        display: ["Montserrat", "sans-serif"],
        body: ["Source Sans Pro", "sans-serif"],
      },
      minHeight: {
        '20': '5rem',
        '24': '6rem',
        '28': '7rem',
        'content': 'calc(100vh - 88px)'
      },
      maxHeight: {
        'content': 'calc(100vh - 88px)'
      },
      height: {
        'content': 'calc(100vh - 88px)'
      },
      minWidth: {
        '0': '0',
        'half': '50%',
        'full': '100%'
      },
      borderWidth: {
        '0': '0px',
        '3': '3px',
      },
      colors: {
        white: '#fff',
        black: '#000',
        primary: '#F0A341',
        secondary: '#C22D28',
        themeGreen: '#357C4C',
        themeRed: '#871D3D',
        themeBrown: '#A0643D',
        themeMagenta: '#C63973',
        themeTortilla: '#D09468',
        themeBlack: '#1C1C1C',
        themeOrange: '#F0A241',
        themeGray: '#636363',
        themeBlue: '#397894',
        themeBlackAlt: '#3E1A00',
        altRed:'#C32B27',
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [require('@tailwindcss/typography')],
};
