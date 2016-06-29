"use strict";

var gulp = require('gulp'),
    rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    livereload = require('gulp-livereload'),
    sass = require('gulp-sass'),
    jsmin = require('gulp-jsmin'),
    concat = require('gulp-concat'),
    cleanCss = require('gulp-clean-css');

// css
gulp.task('css', function () {
    return gulp.src('public/assets/scss/main.scss') // path to folder we are working with
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCss()) // minify
        .pipe(rename('main.min.css')) // rename minified
        .pipe(gulp.dest('./public/assets/css/')) // folder where to save
        .pipe(notify('.scss compiled!'))
        .pipe(livereload())
        ;
});

//js
gulp.task('js', function () {
    return gulp.src('public/assets/js/modules/**/*.js') // path to folder we are working with
        .pipe(concat('main.min.js'))
        .pipe(jsmin())
        .pipe(gulp.dest('public/assets/js/'))
        .pipe(notify('.js compiled!'))
        .pipe(livereload())
        ;
});

//html
gulp.task('html',function() {
    return gulp.src('**/*.html')
        .pipe(livereload())
        ;
});

//php?
gulp.task('php',function() {
    return gulp.src('**/*.php')
        .pipe(livereload())
        ;
});

// watch
gulp.task('watch', function() {
    livereload.listen();
    gulp.watch('public/assets/scss/**/*.scss', ['css']);
    gulp.watch('public/assets/js/modules/**/*.js', ['js']);
    gulp.watch('**/*.html', ['html']);
    gulp.watch('**/*.php', ['php']);
});

// default
gulp.task('default', ['css','js','html','php','watch']);