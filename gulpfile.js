const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

// Compile SASS files into CSS
function compileSass() {
  return gulp.src('./sass/**/*.scss') // source folder for SASS files
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./css')); // destination folder for CSS files
}

// Watch SASS files for changes
function watchSass() {
  gulp.watch('./sass/**/*.scss', compileSass);
}

// Default Gulp task
exports.default = gulp.series(compileSass, watchSass);
