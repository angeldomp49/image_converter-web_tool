const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

const sourceDirectory = './resources';
const distDirectory = './public/assets';
const bower_components = './bower_components';

const jsSources = [
    'resources/js/checkConversion.js'
];

const stylesSources = [
    '/scss/style.css'
];

const assets = [
    '/img',
    '/json',
    '/fonts'
];

const vendors = [
    {
        'name': 'bootstrap', 
        'source': {
            'css': [
                bower_components+'/bootstrap/dist/bootstrap.min'
            ],
        }
    }
];

mix.combine(jsSources, distDirectory+'/js/app.min.js')
    .sourceMaps();

copyAssetsRecursively(assets);





function copyAssetsRecursively( assets ){
    assets.map((asset) => {
        copyAssets(asset);
    });
}

function copyAssets(source, dest = ''){
    if(dest == ''){
        dest = source;
    }
    mix.copyDirectory(sourceDirectory+source, distDirectory+dest);
}