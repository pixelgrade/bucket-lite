var theme = 'bucket',
    gulp = require('gulp'),
    prefix 		= require('gulp-autoprefixer'),
    sass 		= require('gulp-ruby-sass'),
    jshint = require('gulp-jshint'),
    clean = require('gulp-clean'),
    zip = require('gulp-zip'),
    cache = require('gulp-cache'),
    lr = require('tiny-lr'),
    server = lr(),
    exec 		= require('gulp-exec'),
    replace 	= require('gulp-replace'),
    minify 		= require('gulp-minify-css'),
    concat 		= require('gulp-concat'),
    notify 		= require('gulp-notify'),
    beautify 	= require('gulp-beautify'),
    uglify 		= require('gulp-uglify'),
    csscomb 	= require('gulp-csscomb'),
    chmod 		= require('gulp-chmod'),
    fs          = require('fs'),
    rtlcss 		= require('rtlcss'),
    postcss 	= require('gulp-postcss'),
    del         = require('del'),
    rename 		= require('gulp-rename');


var options = {
    silent: true,
    continueOnError: true // default: false
};

/**
 *   #STYLES
 */

gulp.task('styles-dev', function () {
    return gulp.src(['theme-content/scss/**/*.scss'])
            .pipe(sass({'sourcemap=auto': true, style: 'compact'}))
            .on('error', function (e) {
                console.log(e.message);
            })
            .pipe(prefix("last 1 version", "> 1%", "ie 8", "ie 7"))
            .pipe(gulp.dest('./theme-content/css/'))
            .pipe(notify({message: 'Styles task complete'}));
    // .pipe(postcss([
    //     require('rtlcss')({ /* options */ })
    // ]))
    // .pipe(rename("rtl.css"))
    // .pipe(gulp.dest('./'))
});

gulp.task('styles', function () {
    return gulp.src(['theme-content/scss/**/*.scss'])
            .pipe(sass({'sourcemap=auto': true, style: 'expanded'}))
            .pipe(prefix("last 1 version", "> 1%", "ie 8", "ie 7"))
            // .pipe(cmq())
            .pipe(csscomb())
            .pipe(chmod(644))
            .pipe(gulp.dest('./theme-content/css/'))
            .pipe(notify({message: 'Styles task complete'}));
    // .pipe(postcss([
    //     require('rtlcss')({ /* options */ })
    // ]))
    // .pipe(rename("rtl.css"))
    // .pipe(gulp.dest('./'));
});

gulp.task('styles-admin', function () {
    return gulp.src('./theme-content/scss/admin/*.scss')
            .pipe(sass({'sourcemap': true, style: 'expanded'}))
            .on('error', function (e) {
                console.log(e.message);
            })
            .pipe(prefix("last 1 version", "> 1%", "ie 8", "ie 7"))
            .pipe(chmod(644))
            .pipe(gulp.dest('./theme-content/css/admin/'));
});





gulp.task('watch', function () {
    gulp.watch('theme-content/scss/**/*.scss', ['styles']);
});

gulp.task('watch-admin', function () {
    gulp.watch('theme-content/scss/admin/*.scss', ['styles-admin']);
});

gulp.task('server', ['styles'], function () {
    console.log('The styles and scripts have been compiled for production! Go and clear the caches!');
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
        '.travis.yml',
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
        '=== Watchers === \n' +
        'watch              Watches all js and scss files \n' +
        'styles-watch       Watch only styles\n' +

    console.log($help);

});