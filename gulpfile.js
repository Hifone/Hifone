var elixir = require('laravel-elixir'),
    gulp = require('gulp'),
    gutil = require('gulp-util'),
    coffee = require('gulp-coffee');

elixir.config.production = true;
elixir.config.sourcemaps = false;

elixir(function (mix) {
    mix
        .sass('hifone.scss', 'public/dist/css/hifone.css')
        .styles([
            'vendor/bower_components/prism/themes/prism-okaidia.css',
            'vendor/bower_components/nprogress/nprogress.css',
            'vendor/bower_components/messenger/build/css/messenger*.css',
            'vendor/bower_components/select2/dist/css/select2.css',
            'vendor/bower_components/ekko-lightbox/dist/ekko-lightbox.css',
            'public/dist/css/hifone.css'
        ], 'public/dist/css/all.css', './')
        .coffee([
            'resources/assets/coffee/**/*.coffee'
        ])
        .scripts([
            'vendor/bower_components/jquery/dist/jquery.js',
            'vendor/bower_components/bootstrap-sass/assets/javascripts/bootstrap.js',
            'vendor/bower_components/underscore/underscore-min.js',
            'vendor/bower_components/backbone/backbone-min.js',
            'vendor/bower_components/sweetalert/dist/sweetalert.min.js',
            'vendor/bower_components/moment/min/moment-with-locales.js',
            'vendor/bower_components/lodash/lodash.js',
            'vendor/bower_components/messenger/build/js/messenger.js',
            'vendor/bower_components/jquery-pjax/jquery.pjax.js',
            'vendor/bower_components/autosize/jquery.autosize.min.js',
            'vendor/bower_components/scrollup/dist/jquery.scrollUp.min.js',
            'vendor/bower_components/jquery-textcomplete/dist/jquery.textcomplete.min.js',
            'vendor/bower_components/nprogress/nprogress.js',
            'vendor/bower_components/jquery-serialize-object/jquery.serialize-object.js',
            'vendor/bower_components/jquery-caret/jquery.caret.js',
            'vendor/bower_components/marked/marked.min.js',
            'vendor/bower_components/markdown/lib/markdown.js',
            'vendor/bower_components/prism/prism.js',
            'vendor/bower_components/prism/components/prism-php*.min.js',
            'vendor/bower_components/localforage/dist/localforage.min.js',
            'vendor/bower_components/emoji/lib/emoji.js',
            'vendor/bower_components/emojify/emojify.js',
            'vendor/bower_components/ekko-lightbox/dist/ekko-lightbox.min.js',
            'vendor/bower_components/Sortable/Sortable.js',
            'vendor/bower_components/select2/dist/js/select2.min.js',
            'vendor/bower_components/inline-attachment/src/inline-attach.js',
            'vendor/bower_components/inline-attachment/src/jquery.inline-attach.js',
            'public/js/app.js'
        ], 'public/dist/js/all.js', './')
        .version(['public/dist/css/all.css', 'public/dist/js/all.js'])
        .copy('vendor/bower_components/font-awesome/fonts/', 'public/fonts/');
});
