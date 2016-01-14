// by Andrey Starkov (im@andreystarkov.ru)

var gulp = require('gulp'),
    rename = require("gulp-rename"),
    notify = require('gulp-notify'),
    del = require('del'),
    size = require('gulp-size'),
    path = require('path'),
    concat = require('gulp-concat'),
    sourcemaps = require('gulp-sourcemaps'),
    clean = require('gulp-clean'),
    less = require('gulp-less'),
    uglify = require('gulp-uglify'),
    plumber = require('gulp-plumber'),
    changed = require('gulp-changed'),
    minifyCss = require('gulp-minify-css'),
    processhtml = require('gulp-processhtml'),
    imagemin = require('gulp-imagemin'),
    jpegtran = require('imagemin-jpegtran'),
    pngquant = require('imagemin-pngquant'),
    svg2png = require('gulp-svg2png'),
    ftp = require('vinyl-ftp'),
    gutil = require('gulp-util'),
    runSequence = require('run-sequence').use(gulp);

    var secrets = require('../../../../secrets.json');

    var JSFiles = [
     'assets/libs/jquery/dist/jquery.min.js',
     'assets/libs/bootstrap/dist/js/bootstrap.min.js',
     'assets/libs/classie/classie.js',
     'assets/libs/picturefill/dist/picturefill.min.js',
    // 'assets/libs/jquery-touchswipe/jquery.touchSwipe.min.js',
     'assets/libs/jquery-validation/dist/jquery.validate.js',
     'assets/libs/bootstrap-material-design/dist/js/material.min.js',
     'assets/libs/bootstrap-material-design/dist/js/ripples.min.js',
     'assets/libs/waypoints/lib/jquery.waypoints.min.js',
     'assets/libs/snackbarjs/src/snackbar.js',
     'assets/libs/vivus/dist/vivus.min.js',
     'assets/libs/flexslider/jquery.flexslider-min.js',
     'assets/libs/fancybox/source/jquery.fancybox.js',
     'assets/libs/lightgallery/dist/js/lightgallery.min.js',
     'assets/libs/vide/dist/jquery.vide.min.js',
     'assets/libs/wow/dist/wow.min.js',
     'assets/libs/jquery.transit/jquery.transit.js',
     'assets/scripts/instagram.js',
     'assets/scripts/scroll.js',
     'assets/scripts/slider.js',
     'assets/scripts/scripts.js',
     'assets/scripts/template.js',
     'assets/scripts/init.js'
    ];


gulp.task('clean', function() {
    return gulp.src(['dist/css']).pipe(clean());
});

var LessPluginCleanCSS = require('less-plugin-clean-css'),
    LessPluginAutoPrefix = require('less-plugin-autoprefix'),
    LessPluginCSScomb = require('less-plugin-csscomb');

  gulp.task('less', function() {

  var cleancss = new LessPluginCleanCSS({ advanced: true }),
  autoprefix = new LessPluginAutoPrefix({ browsers: ["last 2 versions"] });

    return gulp.src('assets/styles/styles.less')
        .pipe(sourcemaps.init())
        .pipe(less({ plugins: [autoprefix, cleancss]}))
        .pipe(gulp.dest('assets/css'))
        .pipe(sourcemaps.write('./'))
        .pipe(size({
            title: 'LESS'
        }));
});

gulp.task('material', function() {
  var cleancss = new LessPluginCleanCSS({ advanced: true }),
  autoprefix = new LessPluginAutoPrefix({ browsers: ["last 2 versions"] });

    return gulp.src('assets/libs/bootstrap-material-design/less/material-fullpalette.less')
        .pipe(sourcemaps.init())
        .pipe(less({ plugins: [autoprefix, cleancss]}))
        .pipe(gulp.dest('assets/css'))
        .pipe(sourcemaps.write('./'))
        .pipe(size({
            title: 'Material'
        }));
});

gulp.task('bootstrap', function() {
  var cleancss = new LessPluginCleanCSS({ advanced: true });

    return gulp.src('assets/libs/bootstrap/less/bootstrap.less')
        .pipe(less())
        .pipe(gulp.dest('assets/css'))
        .pipe(size({
            title: 'Bootstrap'
        }));
});

gulp.task('css-concat', function() {
  return gulp.src([
    'assets/fonts/*.css',
    'assets/libs/lightgallery/dist/css/*.css',
    'assets/libs/animate.css/animate.min.css',
    'assets/libs/bootstrap-material-design/dist/css/ripples.min.css',
    'assets/css/bootstrap.css',
    'assets/css/material-fullpalette.css',
    'assets/css/styles.css'
    ])
    .pipe(sourcemaps.init())
    .pipe(concat('main.css'))
    .pipe(gulp.dest('dist/styles'))
    .pipe(sourcemaps.write('./'))
    .pipe(size({
        title: 'Concat CSS'
    }));
});

gulp.task('css-min', function() {
  return gulp.src('dist/css/main.css')
    .pipe(sourcemaps.init())
    .pipe(minifyCss())
    .pipe(rename({ suffix: '.min' }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('dist/css'))
    .pipe(size({
        title: 'Minify CSS'
    }));
});


gulp.task('js-min', function() {
  return gulp.src(JSFiles)
    .pipe(concat('main.js'))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('dist/scripts'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('dist/scripts'))
    .pipe(size({
        title: 'JS Min'
    }));
});

gulp.task('images-common', function () {
    return gulp.src(['images.raw/**/*.jpg', 'images.raw/**/*.jpeg', 'images.raw/**/*.png'])
        .pipe(imagemin({
            progressive: false,
            use: [pngquant(), jpegtran()],
            interlaced: true
        }))
        .pipe(size({
            title: 'Images'
        }))
        .pipe(gulp.dest('images'));
});

gulp.task('images-dist', function () {
    return gulp.src(['dist/images.raw/**/*.jpg', 'dist/images.raw/**/*.jpeg', 'dist/images.raw/**/*.png'])
        .pipe(imagemin({
            progressive: false,
            use: [pngquant(), jpegtran()],
            interlaced: true
        }))
        .pipe(size({
            title: 'Images'
        }))
        .pipe(gulp.dest('dist/images'));
});

gulp.task( 'deploy', function() {
var conn = ftp.create( {
   host:     secrets.servers.production.serverhost,
   user:     secrets.servers.production.username,
   password: secrets.servers.production.password,
   parallel: 10,
   log: gutil.log
} );

var globs = [
  'dist/styles/*',
  'dist/scripts/*',
];

return gulp.src( globs, { base: '.', buffer: false } )
  .pipe( conn.newer( secrets.servers.production.remotepath) )   // only upload newer files
  .pipe( conn.dest( secrets.servers.production.remotepath ) );
});

gulp.task('styles', function(callback) {
    runSequence(
        'clean',
        'less',
        'css-concat',
        callback)
});

gulp.task('images', function(callback) {
    runSequence(
        'images-common',
        'images-dist',
        callback)
});

gulp.task('scripts-build', function(callback) {
    runSequence(
        'js-min',
        callback)
});

gulp.task('build', function(callback) {
    runSequence(
        'clean',
     //   'bootstrap',
     //   'material',
        'less',
        'css-concat',
        'js-min',
        'css-min',
      //  'deploy',
        callback)
});


gulp.task('css-build', function(callback) {
    runSequence(
        'less',
        'css-concat',
        'css-min',
    //    'deploy',
        callback)
});


gulp.task('watch', function () {
    gulp.watch('assets/styles/**/*.less', ['css-build']);
    gulp.watch('assets/scripts/**/*.js', ['scripts-build']);
});

gulp.task('default', ['build','watch']);