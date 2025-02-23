var gulp = require('gulp')
var concat = require('gulp-concat')
var sourcemaps = require('gulp-sourcemaps')
var eslint = require('gulp-eslint')
var uglify = require('gulp-uglify')
var ngAnnotate = require('gulp-ng-annotate')
var notify = require('gulp-notify')
var gulpif = require('gulp-if')
var webpack = require('webpack-stream')
var defaultWebpackConfig = require('../webpack.config.js')
var Elixir = require('laravel-elixir')
var Task = Elixir.Task

require('laravel-elixir-config')
var config = Elixir.config;

Elixir.extend('angular', function (src, output, outputFilename, userWebpackConfig) {
  var webpackConfig = userWebpackConfig || defaultWebpackConfig
  var baseDir = src || Elixir.config.assetsPath + '/angular/'
  new Task('angular in ' + baseDir, function () {
    return gulp.src([baseDir + 'index.main.js', baseDir + '**/*.*.js'])
      .pipe(eslint({
        globals: {
          'jQuery': false,
          '$': true,
          'swal': true
        }
      }))
      .pipe(eslint.format())
      .pipe(gulpif(!config.production, sourcemaps.init()))
      .pipe(webpack(webpackConfig))
      .pipe(ngAnnotate())
      .pipe(gulpif(config.production, uglify()))
      .pipe(gulpif(!config.production, sourcemaps.write()))
      .pipe(gulp.dest(output || config.js.outputFolder))
      .pipe(notify({
        title: 'Laravel Elixir',
        subtitle: 'Angular Compiled!',
        icon: __dirname + '/../node_modules/laravel-elixir/icons/laravel.png',
        message: ' '
      }))
  }).watch(baseDir + '/**/*.js')
})
