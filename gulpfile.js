// Load plugins
var gulp = require('gulp'),
    exec = require('gulp-exec'),
    clean = require('gulp-clean'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    lr = require('tiny-lr'),
    server = lr(),
    path = './theme-content/',
    jspath = path + 'js/',
	debug = require('gulp-debug');

var options = {
	silent: true,
	continueOnError: true // default: false
};

gulp.task('styles', function() {

    gulp.src('./')
        .pipe( exec('sass --force --update --compass --sourcemap theme-content/scss:theme-content/css --style expanded -E utf-8  2> /dev/null', options) );
//        .pipe(livereload(server));

});

/**
 * Cleanup the css folder and recreate the css files
 */
gulp.task('production-nested', function() {
    return gulp.src('./')
        .pipe( exec('rm -Rf ./theme-content/css/* ; ruby theme-content/+production-nested.rb',options) );
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

gulp.task('start', ['styles-nested', 'scripts'], function(){
	console.log('theme should be ready');
});

gulp.task('server', ['styles-compressed', 'scripts-compressed'], function () {
	console.log('The styles and scripts have been compiled for production! Go and clear the caches!');
});

/**
 * Create a zip archive out of the cleaned folder and delete the folder
 */
gulp.task('zip', ['build'], function(){

	return gulp.src('./')
		.pipe(exec('cd ./../; rm -rf bucket.zip; cd ./build; zip -r -X ./../bucket.zip ./bucket; cd ./../; rm -rf build',options));

});

/**
 * Copy theme folder outside in a build folder, recreate styles before that
 */
gulp.task('copy-folder', ['production-nested'], function(){

	return gulp.src('./')
		.pipe(exec('rm -Rf ./../build; mkdir -p ./../build/bucket; cp -Rf ./* ./../build/bucket/',options));
});

/**
 * Clean the folder of unneeded files and folders
 */
gulp.task('build', ['copy-folder'], function(){

	// files that should not be present in build zip
	files_to_remove = [
		'**/codekit-config.json',
		'node_modules',
		'config.rb',
		'gulpfile.js',
		'package.json',
		'wpgrade-core/vendor/redux2',
		'wpgrade-core/features',
		'wpgrade-core/tests',
		'wpgrade-core/**/*.less',
		'wpgrade-core/**/*.scss',
		'wpgrade-core/**/*.rb',
		'wpgrade-core/**/sass',
		'wpgrade-core/**/scss',
		'pxg.json',
		'build',
		'css',
		'**/*.css.map',
		'**/.sass*',
		'.sass*',
		'**/.git*',
		'*.sublime-project',
		'.DS_Store',
		'**/.DS_Store',
		'__MACOSX',
		'**/__MACOSX'
	];

	files_to_remove.forEach( function(e,k){
		files_to_remove[k] = '../build/bucket/' + e;
	});

	return gulp.src( files_to_remove, { read: false } )
		.pipe( clean({force: true}) );
});

//var fs = require('fs'),
//	gulpConventionalChangelog = require('gulp-conventional-changelog');
//
//var getJsonFile = function(){
//	return JSON.parse(
//		fs.readFileSync('./package.json', 'utf-8'));
//};
//
//gulp.task('diff', function(){
//	var jsonFile = getJsonFile()
//		, commitMsg = "chore(release): v" + jsonFile.version;
//
//
//	require('conventional-changelog')({
//		repository: jsonFile.repository.url,
//		version: jsonFile.version
////		from: '965976566792d95f5afd1f95e0b18276f799307d'
//	}, function(err, log) {
//		console.log(log);
//	});
//
////	console.log(gulpConventionalChangelog());
//
////	return gulp
////		.src(['package.json', 'CHANGELOG.md']) // pass package.json to read data-from
////		.pipe(gulpConventionalChangelog())
////		.pipe(gulp.dest('.')) // only output CHANGELOG.md
////		.pipe(gulpExec('git add -A')) // so the following git commands only execute once
////		.pipe(gulpExec("git commit -m '" + commitMsg + "'"))
////		.pipe(gulpExec("git tag -a v" + jsonFile.version + " -m '" + commitMsg + "'"));
//});


/**
 * Short commands help
 */


gulp.task('help', function(){

    var $help = '\nCommands available : \n \n' +
        '=== General Commands === \n' +
        'start              Compiles all styles and scripts and makes the theme ready to start \n' +
        'build              Create a cleaned up build folder for the current theme \n' +
		'server             Recompile the styles and scripts compressed for server \n' +
        'zip                Create a zip archive from the current build folder and deletes it \n' +
        '=== Style === \n' +
        'styles             Compiles styles in development mode \n' +
        'production-nested  Prepare the style for production (deletes all existing files in the css folder) \n' +
        '=== Scripts === \n' +
        'scripts            Concatenate all js scripts \n' +
        '=== Watchers === \n' +
        'watch              Watches all js and scss files \n' +
        'watch styles       Watch only styles\n' +
        'watch scripts      Watch scripts only \n' +
        'watch-win          Watch on damn windows';


    console.log( $help );

});