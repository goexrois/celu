'use strict';
var gulp = require( 'gulp' ); 
var gutil = require( 'gulp-util' );
var ftp = require( 'vinyl-ftp' );
var sass = require( 'gulp-sass' ) ;

gulp.task('sass', function () {
  return gulp.src('./sass/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./css'));
} );

gulp.task('sass:watch', function () {
  gulp.watch('./sass/**/*.scss', ['sass']);
});
/*
gulp.task( 'build', function() {
	return gulp.src( [ 'css/**', 'js/**' ] )
		.pipe( minify() ) 
		.pipe( gulp.dest('build') ) ; 
} );

gulp.task( 'ftp-deploy', function() {

	var conn = ftp.create( {
		host: 'celu2.psi.unc.edu.ar',
		user: 'seadcelu2',
		password: '!8oSmsUoRVDy0',
		parallel: 10,
		log: gutil.log
	} );

	var globs = [
		'src/**',
		'css/**',
		'js/**',
		'fonts/**',
		'index.html'
	] ;

	return gulp.src( globs, { base: '.', buffer: false } )
        .pipe( conn.newer( '/public_html' ) ) // only upload newer files 
        .pipe( conn.dest( '/public_html' ) );

});*/
