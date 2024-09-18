const mix = require('laravel-mix');
const JavaScriptObfuscator = require('webpack-obfuscator');
const path = require('path');
require('laravel-mix-tailwind');
console.log(path.resolve(__dirname, '/resources/js/app.js'))
mix
    .tailwind('./tailwind.config.js')
    .css('resources/css/app.css', 'public/css')
    .css('resources/css/custom.css', 'public/css')
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/custom.js', 'public/js')
    .js('resources/js/editor.js', 'public/js')
    .js('resources/js/ghl/test.js', 'public/js/ghl')
    .js('resources/js/ghl/main.js', 'public/js/ghl')
    .js('resources/js/ghl/helper.js', 'public/js/ghl')
    .js('resources/js/ghl/assets.js', 'public/js/ghl')
    .js('resources/js/ghl/global.js', 'public/js/ghl')
    .js('resources/js/ghl/loading.js', 'public/js/ghl')
    .js('resources/js/iframes/iframe.js', 'public/js/iframes')
    .webpackConfig({
        output: {
            // ...
            environment: {
                // ...
                arrowFunction: false, // <-- this line does the trick
            },
            iife: false,
        },

        module: {
            rules: [
                {
                    test: /\.js$/,
                    include: [
                        // path.resolve(__dirname, 'resources/js/custom.js'),
                        // path.resolve(__dirname, 'resources/js/ghl/test.js'),
                        // path.resolve(__dirname, 'resources/js/ghl/helper.js'),
                        // path.resolve(__dirname, 'resources/js/ghl/main.js'),
                        // Add more files or directories you want to obfuscate
                    ],

                    /* exclude: [
                        path.resolve(__dirname, 'resources/js/app.js')
                        // path.resolve(__dirname, '../../../../storage/app/public/ghl_script/custom--commandbar.js')
                    ], */
                    enforce: 'post',
                    use: {
                        loader: JavaScriptObfuscator.loader,
                        options: {
                            compact: true,
                            simplify: true,
                            sourceMap: false,
                            wrap: false,
                        }
                    }
                }
            ]
        },

    });

if (mix.inProduction()) {
    mix.version();
}
