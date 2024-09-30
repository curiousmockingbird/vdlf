const mix = require('laravel-mix');
// Removed the incompatible package
// require('@tinypixelco/laravel-mix-wp-blocks');
require('laravel-mix-svg-vue');

mix
  .setPublicPath('./public')
  .browserSync('vdlf.test');

mix
  .sass('resources/styles/app.scss', 'styles')
  .sass('resources/styles/editor.scss', 'styles')
  .options({
    processCssUrls: false,
    postCss: [require('tailwindcss')],
  });

mix
  .js('resources/scripts/app.js', 'scripts')
  .js('resources/scripts/customizer.js', 'scripts')
  .js('resources/scripts/editor.js', 'scripts') // Compiling editor.js
  .vue()
  .svgVue()
  .autoload({ jquery: ['$', 'window.jQuery'] })
  .extract();

mix
  .copyDirectory('resources/images', 'public/images')
  .copyDirectory('resources/fonts', 'public/fonts');

mix
  .sourceMaps()
  .version();

// **Add this Babel configuration**
mix.babelConfig({
  presets: ['@wordpress/babel-preset-default'],
});

// Configure externals to prevent bundling WordPress globals
mix.webpackConfig({
  externals: {
    '@wordpress/blocks': ['wp', 'blocks'],
    '@wordpress/i18n': ['wp', 'i18n'],
    '@wordpress/element': ['wp', 'element'],
    '@wordpress/components': ['wp', 'components'],
    '@wordpress/block-editor': ['wp', 'blockEditor'],
    // Add other WordPress packages as needed
  },
});