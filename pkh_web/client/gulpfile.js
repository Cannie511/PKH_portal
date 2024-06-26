'use strict';

var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    sassNoRuby = require('gulp-sass'),
    minifyCss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    path = require('path'),
    gutil = require('gulp-util'),
    gulpif = require('gulp-if'),
    gulpIfElse = require('gulp-if-else'),
    args   = require('yargs').argv;

var isProduction = (args.production === undefined) ? false : true;
console.log('isProduction=' + isProduction);

var PATHS = {
    // Destination folder
    DEST_DIR : '../public',
    DEST_DIR_JS_FRONTEND : '../public/frontend/js',
    DEST_DIR_CSS_FRONTEND : '../public/frontend/css',
    DEST_DIR_FONTS_FRONTEND : '../public/frontend/fonts',


    DIR_FRONTEND: './frontend',

    // VENDOR
    VENDOR : 'bower_components',
    MANUAL_VENDOR: 'manual-vendor',
    DIR_JS: './src/js',
    DIR_SCSS: './src/scss',
    //DIR_LESS: './src/less',
    DIR_IMAGES: './src/images',
    DIR_DIST: './dist'
};

// style: compact, compressed, or expanded.
var configSass = {
    style: 'expanded',
    compass: true ,
    lineNumbers: true
};

var configSassNoRuby = {
    outputStyle: 'expanded'
};

if( isProduction ) {
    configSass = {
        style: 'compressed',
        compass: true ,
        lineNumbers: false
    };
}

/**
 * Build vendor js + css
 * Usage: gulp vendor
 */
gulp.task('vendor', [], function() {
    // Vendor JS
    gulp.src([
        // Jquery
        PATHS.VENDOR + '/jquery/dist/jquery.min.js',
        // Bootstrap
        PATHS.VENDOR + '/bootstrap/dist/js/bootstrap.min.js',
    ])
    .pipe(concat('vendors.js'))
    .pipe(gulp.dest(PATHS.DEST_DIR_JS_FRONTEND))
    .pipe(notify({ message: 'Create <%= file.relative %> complete' }));

    // Vendor CSS
    gulp.src([
            PATHS.VENDOR + '/bootstrap/dist/css/bootstrap.min.css',
            PATHS.VENDOR + '/font-awesome/css/font-awesome.min.css',
            PATHS.VENDOR + '/simple-line-icons/css/simple-line-icons.min.css'
        ])
        .pipe(concat('vendors.css'))
        .pipe(gulp.dest(PATHS.DEST_DIR_CSS_FRONTEND))
        .pipe(notify({ message: 'Create <%= file.relative %> complete' }));

    var min = "";
    if( isProduction) {
        min = ".min";
    }

    // gulp.src([
    //         PATHS.MANUAL_VENDOR + '/metronic/assets/global/css/components' + min + '.css',
    //         PATHS.MANUAL_VENDOR + '/metronic/assets/global/css/plugins' + min + '.css'
    //     ])
    //     .pipe(concat('base.css'))
    //     .pipe(gulp.dest(PATHS.DEST_DIR_CSS_FRONTEND))
    //     .pipe(notify({ message: 'Create <%= file.relative %> complete' }));

    // gulp.src([
    //         PATHS.MANUAL_VENDOR + '/metronic/assets/layouts/layout3/css/layout' + min + '.css',
    //         PATHS.MANUAL_VENDOR + '/metronic/assets/layouts/layout3/css/themes/default' + min + '.css',
    //         PATHS.MANUAL_VENDOR + '/metronic/assets/layouts/layout3/css/custom' + min + '.css'
    //     ])
    //     .pipe(concat('theme.css'))
    //     .pipe(gulp.dest(PATHS.DEST_DIR_CSS_FRONTEND))
    //     .pipe(notify({ message: 'Create <%= file.relative %> complete' }));

    // Copy fonts
    gulp.src([
            PATHS.VENDOR + '/bootstrap/fonts/*.*',
            PATHS.VENDOR + '/simple-line-icons/fonts/*.*',
            PATHS.VENDOR + '/font-awesome/fonts/*.*',
        ])
        .pipe(gulp.dest(PATHS.DEST_DIR_FONTS_FRONTEND));

    // Copy image
    // gulp.src([
    //         PATHS.VENDOR + '/chosen/*.png'
    //     ])
    //     .pipe(gulp.dest(PATHS.DEST_DIR_CSS_FRONTEND));
});

gulp.task('scripts', function() {
    
});

/**
 * SCSS
 * Usage: gulp styles
 */
gulp.task('styles', function() {
    sass( PATHS.DIR_FRONTEND + '/scss/app.scss', configSass)
        .on('error', reportError)
        .pipe(gulp.dest(PATHS.DEST_DIR_CSS_FRONTEND))
        .pipe(gulpif(isProduction, minifyCss()))
        .pipe(gulp.dest(PATHS.DEST_DIR_CSS_FRONTEND))
        .pipe(notify({ message: 'Styles task complete. (File: <%= file.relative %>)' }));

    // gulp.src( PATHS.DIR_SCSS + '/pages/*.scss')
    //     .pipe(sassNoRuby(configSassNoRuby).on('error', reportError))
    //     .pipe(gulpif(isProduction, minifyCss()))
    //     .pipe(gulp.dest(PATHS.DEST_DIR_CSS))
    //     .pipe(notify({ message: 'pages complete (File: <%= file.relative %>)' }));
});

// Watch
gulp.task('watch', function() {

    // Watch .scss files of vendor
    // gulp.watch( PATHS.MANUAL_VENDOR + '/metronic/sass/**/*.scss', ['vendor']);

    // Watch .scss files
    gulp.watch( PATHS.DIR_FRONTEND + '/**/*.scss', ['styles']);

    // Watch .js files
    // gulp.watch( PATHS.DIR_JS + '/**/*.js', ['scripts']);

    // Watch image files
    //gulp.watch( PATHS.DIR_IMAGES + '/**/*', ['images']);

    // Create LiveReload server
    //livereload.listen();

    // Watch any files in dist/, reload on change
    //gulp.watch(['dist/**']).on('change', livereload.changed);

});

gulp.task('default', ['vendor', 'styles', 'scripts'], function() {
});

// =============================
// Private Function

/**
 * Exception handler
 * @param  {[type]} error [description]
 * @return {[type]}       [description]
 */
var reportError = function (error) {
    var lineNumber = (error.lineNumber) ? 'LINE ' + error.lineNumber + ' -- ' : '';

    notify({
        title: 'Task Failed [' + error.plugin + ']',
        message: lineNumber + 'See console.',
        sound: 'Sosumi' // See: https://github.com/mikaelbr/node-notifier#all-notification-options-with-their-defaults
    }).write(error);

    gutil.beep(); // Beep 'sosumi' again

    // Inspect the error object
    //console.error(error);

    // Easy error reporting
    //console.error(error.toString());

    // Pretty error reporting
    var report = '';
    var chalk = gutil.colors.white.bgRed;

    report += chalk('TASK:') + ' [' + error.plugin + ']\n';
    report += chalk('PROB:') + ' ' + error.message + '\n';
    if (error.lineNumber) { report += chalk('LINE:') + ' ' + error.lineNumber + '\n'; }
    if (error.fileName)   { report += chalk('FILE:') + ' ' + error.fileName + '\n'; }
    console.error(report);

    // Prevent the 'watch' task from stopping
    this.emit('end');
}