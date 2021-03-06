var gulp        = require('gulp'),
	plugins     = require('gulp-load-plugins')(),
	del         = require('del'),
	fs          = require('fs'),
	cp          = require('child_process');


// Gulp / Node utilities
var u = require( 'gulp-util' );
var log = u.log;
var c = u.colors;

function logError( err, res ) {
	log( c.red( 'Sass failed to compile' ) );
	log( c.red( '> ' ) + err.file.split( '/' )[err.file.split( '/' ).length - 1] + ' ' + c.underline( 'line ' + err.line ) + ': ' + err.message );
}

var jsFiles = [
	'./theme-content/js/vendor/*.js',
	'./theme-content/js/plugins/*.js',
	'./theme-content/js/main/shared_vars.js',
	'./theme-content/js/main/wrapper_start.js',
	'./theme-content/js/main/magnific-popup.js',
	'./theme-content/js/main/riloadr.js',
	'./theme-content/js/main/royalslider.js',
	'./theme-content/js/main/main.js',
	'./theme-content/js/main/unsorted.js',
	'./theme-content/js/main/wrapper_end.js',
	'./theme-content/js/main/functions.js'
];

var theme_name = 'bucket-lite',
	theme = theme_name;

var config = {
	"baseurl": "demos.dev/bucket-lite"
};

if ( fs.existsSync( './gulpconfig.json' ) ) {
	config = require( './gulpconfig.json' )
} else {
	console.log( "Don't forget to create your own gulpconfig.json from gulpconfig.json.example" );
}

// -----------------------------------------------------------------------------
// Sass Task
//
// Compiles Sass and runs the CSS through autoprefixer. A separate task will
// combine the compiled CSS with vendor files and minify the aggregate.
// -----------------------------------------------------------------------------

function stylesMain() {
	return gulp.src('theme-content/scss/**/*.scss')
	           .pipe(plugins.sourcemaps.init())
	           .pipe(plugins.sass({'sourcemap=auto': true, style: 'expanded'}).on('error', logError))
	           .pipe(plugins.autoprefixer())
	           .pipe(plugins.sourcemaps.write('.'))
	           .pipe(plugins.replace(/^@charset \"UTF-8\";\n/gm, ''))
	           .pipe(gulp.dest('./theme-content/css/', {mode: "0644"}))
}
stylesMain.description = 'Compiles main css files (ie. style.css editor-style.css)';
gulp.task('styles-main', stylesMain);

function stylesAdmin() {

	return gulp.src('./theme-content/scss/admin/*.scss')
	           .pipe(plugins.sourcemaps.init())
	           .pipe(plugins.sass().on('error', logError))
	           .pipe(plugins.autoprefixer())
	           .pipe(plugins.replace(/^@charset \"UTF-8\";\n/gm, ''))
	           .pipe(gulp.dest('/theme-content/css/admin/'))
}
stylesAdmin.description = 'Compiles WordPress admin Sass and uses autoprefixer';
gulp.task('styles-admin', stylesAdmin )

function stylesWatch() {
	plugins.livereload.listen();
	return gulp.watch('theme-content/scss/**/*.scss', stylesMain);
}
gulp.task('styles-watch', stylesWatch);

function stylesSequence(cb) {
	return gulp.series( 'styles-main', 'styles-admin' )(cb);
}
stylesSequence.description = 'Compile the styles.';
gulp.task( 'styles', stylesSequence  );

// -----------------------------------------------------------------------------
// Combine JavaScript files
// -----------------------------------------------------------------------------

function scripts() {
	return gulp.src(jsFiles)
	           .pipe(plugins.concat('main.js'))
	           .pipe(plugins.beautify({indentSize: 2}))
	           .pipe(gulp.dest('./theme-content/js/'));
}
gulp.task('scripts', scripts);

function scriptsWatch() {
	plugins.livereload.listen();
	return gulp.watch('assets/js/**/*.js', scripts);
}
gulp.task('scripts-watch', scriptsWatch);

function watch() {
	gulp.watch('theme-content/scss/**/*.scss', stylesMain);
	gulp.watch('theme-content/scss/admin/*.scss', stylesAdmin);
	gulp.watch('assets/js/**/*.js', scripts);
}
gulp.task('watch', watch);

// -----------------------------------------------------------------------------
// Copy theme folder outside in a build folder, recreate styles before that
// -----------------------------------------------------------------------------
function copyFolder() {
	var dir = process.cwd();
	return gulp.src( './*' )
	           .pipe( plugins.exec( 'rm -Rf ./../build; mkdir -p ./../build/' + theme + ';', {
		           silent: true,
		           continueOnError: true // default: false
	           } ) )
	           .pipe( plugins.rsync({
		           root: dir,
		           destination: '../build/' + theme + '/',
		           progress: false,
		           silent: false,
		           compress: false,
		           recursive: true,
		           emptyDirectories: true,
		           clean: true,
		           exclude: ['node_modules']
	           }));
}
gulp.task( 'copy-folder', copyFolder );

// -----------------------------------------------------------------------------
// Clean the folder of unneeded files and folders
// -----------------------------------------------------------------------------
function removeUnneededFiles(done) {

	// files that should not be present in build
	files_to_remove = [
		'**/codekit-config.json',
		'node_modules',
		'config.rb',
		'gulpfile.js',
		'package.json',
		'build',
		'css',
		'.idea',
		'**/.svn*',
		'**/*.css.map',
		'**/.sass*',
		'.sass*',
		'.travis.yml',
		'**/.git*',
		'*.sublime-project',
		'.DS_Store',
		'**/.DS_Store',
		'__MACOSX',
		'**/__MACOSX',
		'README.md',
		'.csscomb',
		'circle.yml',
		'.circleci',
		'tests',

		'theme-content/scss',
		'theme-content/js/main',
		'theme-content/js/plugins',

		'.labels'
	];

	files_to_remove.forEach(function (e, k) {
		files_to_remove[k] = '../build/' + theme + '/' + e;
	});

	return del(files_to_remove, {force: true});
}
gulp.task( 'remove-files', removeUnneededFiles );


function maybeFixBuildDirPermissions(done) {

	cp.execSync('find ./../build -type d -exec chmod 755 {} \\;');

	return done();
}
maybeFixBuildDirPermissions.description = 'Make sure that all directories in the build directory have 755 permissions.';
gulp.task( 'fix-build-dir-permissions', maybeFixBuildDirPermissions );

function maybeFixBuildFilePermissions(done) {

	cp.execSync('find ./../build -type f -exec chmod 644 {} \\;');

	return done();
}
maybeFixBuildFilePermissions.description = 'Make sure that all files in the build directory have 644 permissions.';
gulp.task( 'fix-build-file-permissions', maybeFixBuildFilePermissions );

function maybeFixIncorrectLineEndings(done) {

	cp.execSync('find ./../build -type f -print0 | xargs -0 -n 1 -P 4 dos2unix');

	return done();
}
maybeFixIncorrectLineEndings.description = 'Make sure that all line endings in the files in the build directory are UNIX line endings.';
gulp.task( 'fix-line-endings', maybeFixIncorrectLineEndings );

// -----------------------------------------------------------------------------
// Replace the themes' text domain with the actual text domain (think variations)
// -----------------------------------------------------------------------------
function replaceThemeTextdomainPlaceholder() {

	return gulp.src( '../build/' + theme + '/**/*.php' )
	           .pipe( plugins.replace( /wpgrade\:\:textdomain\(\)/g, '\'' + theme + '\'' ) )
	           .pipe( gulp.dest( '../build/' + theme ) );
}
gulp.task( 'txtdomain-replace', replaceThemeTextdomainPlaceholder);

// -----------------------------------------------------------------------------
// Create a zip archive out of the cleaned folder and delete the folder
// -----------------------------------------------------------------------------
function createZipFile(){

	// Right now we create a zip without the version information in the name.
	return gulp.src('./')
	           .pipe(plugins.exec('cd ./../; rm -rf ' + theme + '*.zip; cd ./build/; zip -r -X ./../' + theme + '.zip ./; cd ./../; rm -rf build'));
}
gulp.task( 'make-zip', createZipFile );

function buildSequence(cb) {
	return gulp.series( 'copy-folder', 'remove-files', 'fix-build-dir-permissions', 'fix-build-file-permissions', 'fix-line-endings', 'txtdomain-replace' )(cb);
}
buildSequence.description = 'Sets up the build folder';
gulp.task( 'build', buildSequence );

function zipSequence(cb) {
	return gulp.series( 'build', 'make-zip' )(cb);
}
zipSequence.description = 'Creates the zip file';
gulp.task( 'zip', zipSequence  );


// -----------------------------------------------------------------------------
// Short commands help
// -----------------------------------------------------------------------------
function help(done) {

	var $help = '\nCommands available : \n \n' +
	            '=== General Commands === \n' +
	            'start              (default)Compiles all styles and scripts and makes the theme ready to start \n' +
	            'zip               	Generate the zip archive \n' +
	            'build				Generate the build directory with the cleaned theme \n' +
	            'help               Print all commands \n' +
	            '=== Style === \n' +
	            'styles-main        Compiles styles in production mode\n' +
	            'styles-rtl         Compiles RTL styles in production mode\n' +
	            '=== Scripts === \n' +
	            'scripts            Concatenate all js scripts \n' +
	            '=== Watchers === \n' +
	            'watch              Watches all js and scss files \n' +
	            'styles-watch       Watch only styles\n' +
	            'scripts-watch      Watch scripts only \n';

	console.log($help);

	done();
}
gulp.task('help', help);

