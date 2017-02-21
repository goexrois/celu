var gulp = require( 'gulp' ); 
var gutil = require( 'gulp-util' );
var ftp = require( 'vinyl-ftp' );
var sass = require( 'sass' ) ;


gulp.task( 'build', function() {
	gulp.src( [ 'sass/**', 'js/**' ] )
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

});
