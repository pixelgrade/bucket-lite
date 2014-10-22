var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    prefix = require('gulp-autoprefixer'),
    exec = require('gulp-exec'),
    clean = require('gulp-clean'),
    livereload = require('gulp-livereload'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    csscomb = require('gulp-csscomb'),
	compress = require('gulp-yuicompressor' ),
    beautify = require('gulp-beautify'),
    csscomb = require('gulp-csscomb'),
	themeTextDomain = '\'bucket_txtd\'';


var options = {
    silent: true,
    continueOnError: true // default: false
};

// styles related
gulp.task('styles-dev', function () {
    return gulp.src('theme-content/scss/**/*.scss')
        .pipe(sass({compass: true, sourcemap: true, style: 'compact'}))
        .on('error', function (e) {
            console.log(e.message);
        })
        .pipe(prefix("last 1 version", "> 1%", "ie 8", "ie 7"))
        .pipe(gulp.dest('./theme-content/css/'))
        .pipe(livereload())
        .pipe(notify('Styles task complete'));
});

gulp.task('styles', function () {
    return gulp.src('theme-content/scss/**/*.scss')
        .pipe(sass({compass: true, sourcemap: true, style: 'nested'}))
        .on('error', function (e) {
            console.log(e.message);
        })
        .pipe(prefix("last 1 version", "> 1%", "ie 8", "ie 7"))
        .pipe(gulp.dest('./theme-content/css/'))
        .pipe(notify('Styles task complete'));
});

gulp.task('styles-prod', function () {
    return gulp.src('theme-content/scss/**/*.scss')
        .pipe(sass({compass: true, sourcemap: false, style: 'nested'}))
        .on('error', function (e) {
            console.log(e.message);
        })
        .pipe(prefix("last 1 version", "> 1%", "ie 8", "ie 7"))
        .pipe(csscomb())
        .pipe(gulp.dest('./theme-content/css/'));
});

gulp.task('styles-compressed', function () {
	return gulp.src('theme-content/scss/**/*.scss')
		.pipe(sass({compass: true, sourcemap: false, style: 'compressed'}))
		.on('error', function (e) {
			console.log(e.message);
		})
		.pipe(prefix("last 1 version", "> 1%", "ie 8", "ie 7"))
		.pipe(gulp.dest('./theme-content/css/'));
});

gulp.task('styles-watch', function () {
    return gulp.watch('theme-content/scss/**/*.scss', ['styles-dev']);
});

gulp.task('watch', function () {
    gulp.watch('theme-content/scss/**/*.scss', ['styles-dev']);
    gulp.watch('theme-content/js/**/*.js');
});

// usually there is a default task  for lazy people who just wanna type gulp
gulp.task('start', ['styles'], function () {
    // silence
});

gulp.task('server', ['styles-compressed'], function () {
    console.log('The styles have been completed for production! Go and clear the caches!');
});

/**
 * Replace the bad dynamic text domain with a static one
 */
gulp.task('txtdomain-replace', ['copy-folder'], function(){
	gulp.src('../build/bucket/**/*.php')
		.pipe(replace(/wpgrade\:\:textdomain\(\)/g, themeTextDomain))
		.pipe(gulp.dest('../build/bucket'));
});


/**
 * Copy theme folder outside in a build folder, recreate styles before that
 */
gulp.task('copy-folder', ['styles-prod'], function () {

    return gulp.src('./')
        .pipe(exec('rm -Rf ./../build; mkdir -p ./../build/bucket; rsync -av --exclude="node_modules" ./* ./../build/bucket/', options));
});

/**
 * Clean the folder of unneeded files and folders
 */
gulp.task('build', ['txtdomain-replace'], function () {

    // files that should not be present in build
    files_to_remove = [
        '**/codekit-config.json',
        'node_modules',
        'config.rb',
        'gulpfile.js',
        'package.json',
        'pxg.json',
        'build',
        'css',
        '.idea',
        '**/.svn*',
        '**/*.css.map',
        '**/.sass*',
        '.sass*',
        '**/.git*',
        '*.sublime-project',
        '.DS_Store',
        '**/.DS_Store',
        '__MACOSX',
        '**/__MACOSX',
        'README.md',
        '.csscomb'
    ];

    files_to_remove.forEach(function (e, k) {
        files_to_remove[k] = '../build/bucket/' + e;
    });

    return gulp.src(files_to_remove, {read: false})
        .pipe(clean({force: true}));
});

/**
 * Create a zip archive out of the cleaned folder and delete the folder
 */
gulp.task('zip', ['build'], function(){

    return gulp.src('./')
        .pipe(exec('cd ./../; rm -rf bucket.zip; cd ./build/; zip -r -X ./../bucket.zip ./bucket; cd ./../; rm -rf build'));

});

// usually there is a default task  for lazy people who just wanna type gulp
gulp.task('default', ['start'], function () {
    // silence
});

/**
 * Short commands help
 */

gulp.task('help', function () {

    var $help = '\nCommands available : \n \n' +
        '=== General Commands === \n' +
        'start              (default)Combuckets all styles and scripts and makes the theme ready to start \n' +
        'zip               	Generate the zip archive \n' +
        'build				Generate the build directory with the cleaned theme \n' +
        'help               Print all commands \n' +
        '=== Style === \n' +
        'styles             Combuckets styles \n' +
        'styles-prod        Combuckets styles in production mode \n' +
		'styles-compressed  Combuckets styles in compressed mode \n' +
        'styles-dev         Combuckets styles in development mode \n' +
        '=== Scripts === \n' +
        'scripts            Concatenate all js scripts \n' +
        'scripts-dev        Concatenate all js scripts and live-reload \n' +
        '=== Watchers === \n' +
        'watch              Watches all js and scss files \n' +
        'styles-watch       Watch only styles\n' +
        'scripts-watch      Watch scripts only \n';

    console.log($help);

});