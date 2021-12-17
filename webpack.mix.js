const mix = require('laravel-mix');

const tailwindcss = require('tailwindcss')

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/front.js', 'public/js')
    .js('resources/js/admin.js', 'public/js')
    .js('resources/js/pages/checkout.js', 'public/js/pages')
    .js('resources/js/pages/calendar.js', 'public/js/pages')
    .js('resources/js/pages/agent/listing/advertising-settings.js', 'public/js/pages/agent/listing')
    .js('resources/js/pages/agent/listing/index.js', 'public/js/pages/agent/listing')
    .js('resources/js/pages/agent/listing/mls.js', 'public/js/pages/agent/listing')
    .js('resources/js/pages/agent/listing/card.js', 'public/js/pages/agent/listing')
    .js('resources/js/pages/agent/listing/modal_broker_email/index.js', 'public/js/pages/agent/listing/modal_broker_email')
    .js('resources/js/pages/agent/listing/borrowed/modal-form.js', 'public/js/pages/agent/listing/borrowed')
    .js('resources/js/pages/agent/listing/borrowed/modal-select.js', 'public/js/pages/agent/listing/borrowed')
    .js('resources/js/pages/agent/listing/borrowed/table.js', 'public/js/pages/agent/listing/borrowed')
    .js('resources/js/pages/agent/ads/create/index.js', 'public/js/pages/agent/ads/create')
    .js('resources/js/pages/agent/ads/create/seller-lead.js', 'public/js/pages/agent/ads/create')
    .js('resources/js/pages/agent/ads/create/buyer-lead.js', 'public/js/pages/agent/ads/create')
    .js('resources/js/pages/agent/ads/campaigns.js', 'public/js/pages/agent/ads')
    .js('resources/js/pages/agent/ads/card.js', 'public/js/pages/agent/ads')
    .js('resources/js/shared/components/ad-slide-over.js', 'public/js/shared/components');


mix.sass('resources/sass/front.scss', 'public/css');
mix.sass('resources/sass/common/loading.scss', 'public/css/common/');

mix.sass('resources/sass/app.scss', 'public/css')
  .options({
    processCssUrls: false,
    postCss: [ tailwindcss('./tailwind.config.js') ],
})
