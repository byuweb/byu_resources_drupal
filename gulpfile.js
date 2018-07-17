'use strict';

const browserSync = require('browser-sync').create();
const gulp = require('gulp');
const initWcBuild = require('byu-web-component-build').gulp;

gulp.task('build', ['wc:build'], function () {
  browserSync.reload();
});

initWcBuild(gulp, {
  componentName: 'byu-resources',
  js: {
    input: './byu-resources.js',
    polyfillUrl: 'https://cdn.byu.edu/web-component-polyfills/latest/web-component-polyfills.min.js'
  }
});

gulp.task('watch', ['build'], function (done) {
  browserSync.init({
    server: {
      baseDir: './',
    },
    startPath: '/js/',
    notify: false
  }, done);

});

gulp.task('default', ['watch']);