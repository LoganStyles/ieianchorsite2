let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
   
var SWPrecacheWebpackPlugin = require('sw-precache-webpack-plugin');

mix.webpackConfig({
    plugins: [
    new SWPrecacheWebpackPlugin({
        cacheId: 'pwa',
        filename: 'service-worker.js',
        staticFileGlobs: ['public/**/*.{css,eot,svg,ttf,woff,woff2,js,html,png,jpg,gif,min.css,min.js}','public/**/a-zA-Z0-9-.{css,eot,svg,ttf,woff,woff2,js,html,png,jpg,gif,min.css,min.js}'],
//        minify: true,
        stripPrefix: 'public',
        handleFetch: true,
        dynamicUrlToDependencies: {
            '/IEI_WEB/public/page/index': ['resources/views/includes/header.blade.php','resources/views/includes/footer.blade.php','resources/views/site/index.blade.php'],
            '/IEI_WEB/public/page/show_pension_calculator': ['resources/views/includes/header.blade.php','resources/views/includes/footer.blade.php','resources/views/site/pension_calculator.blade.php'],
            '/IEI_WEB/public/page/investment': ['resources/views/includes/header.blade.php','resources/views/includes/footer.blade.php','resources/views/site/investment.blade.php']
        },
        staticFileGlobsIgnorePatterns: [/\.map$/, /mix-manifest\.json$/, /manifest\.json$/, /service-worker\.js$/],
        runtimeCaching: [
            {
                urlPattern: /^https:\/\/fonts\.googleapis\.com\//,
                handler: 'cacheFirst'
            }
        ],
        importScripts: [
        //    './js/push_message.js'
        ]
    }),
    ]
});
