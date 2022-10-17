const mix = require('laravel-mix');
const domain = 'jossa22.test';
require('laravel-mix-simple-image-processing')

require('dotenv').config();

mix
  .setPublicPath('build')
  .webpackConfig(() => ({
    resolve: {
      modules: ['assets/js', 'node_modules'],
    },
  }))
  .js('assets/js/bundle.js', 'build/js/bundle.min.js')
  .sass('assets/scss/style.scss', 'build/css')
  .copyDirectory('assets/svg', 'build/svg')
  .copyDirectory('assets/fonts', 'build/fonts')
  .copyDirectory('assets/favicons', 'build/favicons')
  .sourceMaps()
  .browserSync({
    proxy: 'http://' + domain,
    host: domain,
    open: 'external',
    files: [
      {
        match: ["**/*.php", "**/*.scss", "**/*.js"],
      }
  ]
  }).options({
    processCssUrls: false
  }).imgs({
    source: 'assets/img',
    destination: 'build/img',
    thumbnailsSizes: [150, 300, 600, 900, 1500, 3000],
    webp: true,
    // smallerThumbnailsOnly: true,
    thumbnailsOnly:true
})

/*
 |--------------------------------------------------------------------------
 | Production Mode
 |--------------------------------------------------------------------------
 */

if (mix.inProduction()) {
  mix
    .sourceMaps(false)
    .version()
    .options({
      terser: {
        terserOptions: {
          compress: {
            drop_console: true,
          },
        },
      },
    });
}
