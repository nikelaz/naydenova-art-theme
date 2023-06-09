const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const rename = require('gulp-rename');
const postcss = require('gulp-postcss');
const cssnano = require('cssnano');
const mqpacker = require('css-mqpacker');
const path = require('path');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify-es').default;

const srcDefaultOptions = {
  allowEmpty: true
};

const compile = () => gulp.src(process.cwd() + '/styles/style.sass', srcDefaultOptions)
  .pipe(sass())
  .pipe(gulp.dest('assets'));

const renameBundle = () => gulp.src(path.resolve('./assets/style.css'), srcDefaultOptions)
  .pipe(postcss([ mqpacker() ]))
  .pipe(rename('style.css'))
  .pipe(gulp.dest('assets'));

const minify = () => gulp.src('./assets/style.css', srcDefaultOptions)
  .pipe(postcss([ mqpacker(), cssnano(), ]))
  .pipe(rename('style.min.css'))
  .pipe(gulp.dest('assets'));

const js = () => gulp.src('scripts/**/*.js', srcDefaultOptions)
  .pipe(concat('main.js'))
  .pipe(gulp.dest('assets'))
  .pipe(rename('main.min.js'))
  .pipe(uglify())
  .pipe(gulp.dest('assets'));

// @TODO: Enable
// gulp.task('watch', () => gulp.watch(['./styles/**/*.sass', './styles/**/*.scss', './**/*.js'], gulp.series(compile, renameBundle, minify)));

exports.default = gulp.series(js, compile, renameBundle, minify);