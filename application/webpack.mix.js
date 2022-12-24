const mix = require('laravel-mix');

const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin')
const CaseSensitivePathsPlugin = require('case-sensitive-paths-webpack-plugin')
const purgecss = require('@fullhuman/postcss-purgecss')({
    // Specify the paths to all of the template files in your project
    content: ['./resources/assets/js/**/*.vue'],
    css: ['./resources/assets/css/app.css'],

    // Include any special characters you're using in this regular expression
    defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || [],
})

var webpackConfig = {
    plugins: [
        new VuetifyLoaderPlugin(),
        new CaseSensitivePathsPlugin()
    ],
}

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .postCss('resources/assets/css/app.css', 'public/css', [
        require('tailwindcss'),
        require("postcss-import"),
        require('autoprefixer'),
        ...process.env.NODE_ENV === 'production' ? [purgecss] : []
    ])
    .webpackConfig(webpackConfig)
    .disableNotifications();
mix.browserSync('http://192.168.1.51:8000/');



/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


