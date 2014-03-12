// Load plugins
var gulp = require('gulp'),
    exec = require('gulp-exec'),
    clean = require('gulp-clean'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    lr = require('tiny-lr'),
    server = lr(),
    path = './theme-content/',
    jspath = path + 'js/';

var options = {
	silent: true,
	continueOnError: true // default: false
};


gulp.task('start', ['production-nested'], function(){
    console.log('theme should be ready');
});

gulp.task('styles', function() {

    gulp.src('./')
        .pipe( exec('sass --force --update --compass --sourcemap theme-content/scss:theme-content/css --style expanded -E utf-8  2> /dev/null', options) );
//        .pipe(livereload(server));

});

gulp.task('production-nested', function() {
    gulp.src('./')
        .pipe( exec('ruby theme-content/+production-nested.rb',options) );
});

gulp.task('dev', function() {
    gulp.src('./')
        .pipe(
            exec('sass --force --update --compass --sourcemap theme-content/scss:theme-content/css --style expanded -E utf-8',options)
        )
});

gulp.task('watch-win', function() {

    // Watch .scss files
    gulp.watch('./theme-content/scss/**/*.scss', ['dev']);

});

gulp.task('watch styles', function() {

    // Watch .js files
    gulp.watch('./theme-content/scss/**/*.scss', ['styles']);

});

gulp.task('default', ['help'], function() {

    // silence
});

gulp.task('zip', ['prezip', 'build'], function(){
	// silance
});

	gulp.task('prezip',function(){

		gulp.src('./')
			.pipe(exec('cd ./../build/; ls -al; rm -rf bucket.zip; zip -r -X ../bucket.zip bucket; cd ./../bucket/',options))
			.pipe(gulp.dest('./../../'))
			.pipe(exec('cd ../; rm -rf build',options));

	});

    /**
     * Create a prezip archive
     */
    gulp.task('create-prezip', function(){
        return gulp.src('./**')
            .pipe(gulp.dest('../build/bucket/'));
    });

    /**
     * Clean the prezip archive
     */
    gulp.task('build', ['start', 'create-prezip'], function(){
        // files that should not be present in build zip
        files_to_remove = [
            'codekit-config.json',
            'node_modules',
            'config.rb',
            'gulpfile.js',
            'package.json',
            'wpgrade-core/vendor/redux2',
	        'wpgrade-core/features',
	        'wpgrade-core/tests',
            'pxg.json',
	        'build'
        ];

        files_to_remove.forEach( function(e,k){
            files_to_remove[k] = '../build/bucket/' + e;
        });

        var clean_stream = gulp.src( files_to_remove, { read: false } ) ;
        clean_stream.pipe( clean({force: true}) );
        return clean_stream;

    });



/**
 * Short commands help
 */


gulp.task('help', function(){

    var $help = '\nCommands available : \n \n' +
        '=== General Commands === \n' +
        'start              Compiles all styles and scripts and makes the theme ready to start \n' +
        'build              Create a build folder for the current theme \n' +
        'zip                Create a zip archive from the current build \n' +
        '=== Style === \n' +
        'styles             Compiles styles \n' +
        'production-nested  Prepare the style for production \n' +
        '=== Scripts === \n' +
        'scripts            Concatenate all js scripts \n' +
        '=== Watchers === \n' +
        'watch              Watches all js and scss files \n' +
        'watch styles       Watch only styles\n' +
        'watch scripts      Watch scripts only \n' +
        'watch-win          Watch on damn windows';


    console.log( $help );

});
