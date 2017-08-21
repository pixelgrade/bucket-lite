var theme       = theme_name = main_branch = 'bucket',
	gulp        = require('gulp'),
	prefix      = require('gulp-autoprefixer'),
	sass        = require('gulp-sass'),
	clean       = require('gulp-clean'),
	zip         = require('gulp-zip'),
	exec        = require('gulp-exec'),
	replace     = require('gulp-replace'),
	minify      = require('gulp-minify-css'),
	concat      = require('gulp-concat'),
    notify 		= require('gulp-notify'),
	rtlcss      = require('rtlcss'),
	postcss     = require('gulp-postcss'),
	del         = require('del'),
	rename      = require('gulp-rename'),
	fs      = require('fs'),
	prompt      = require('gulp-prompt');

var
    themeTextDomain = '\'bucket\'',
    jsPath = './theme-content/js/',
    jsMainPath = jsPath + 'main/',
    jsFiles = [
        'shared_vars',
        'wrapper_start',
        'magnific-popup',
        'riloadr',
        'royalslider',
        'main',
        'unsorted',
        'wrapper_end',
        'functions'
    ];

// Prepare js paths
jsFiles.forEach(function (e, k) {
    jsFiles[k] = jsMainPath + e + ".js";
});

jsFiles.push('./theme-content/js/plugins/*.js');

var options = {
    silent: true,
    continueOnError: true // default: false
};

/**
 *   #STYLES
 */
gulp.task('styles', function () {
    return gulp.src(['theme-content/scss/**/*.scss'])
            .pipe(sass({'sourcemap=auto': true, style: 'expanded'}))
            .pipe(prefix("last 1 versions", "> 1%"))
            // .pipe(cmq())
            .pipe(gulp.dest('./theme-content/css/', {"mode": "0644"}));
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
            .pipe(prefix("last 1 version", "> 1%"))
            .pipe(gulp.dest('./theme-content/css/admin/', {"mode": "0644"}));
});


/**
 *   #SCRIPTS
 */

gulp.task('scripts', function () {
    gulp.src('./theme-content/js/plugins/*.js');

    return gulp.src(jsFiles)
        .pipe(concat('main.js'))
        .pipe(gulp.dest('./theme-content/js/'));
});

gulp.task('scripts-watch', function () {
    return gulp.watch('assets/js/**/*.js', ['scripts']);
});

gulp.task('watch', function () {
    gulp.watch('theme-content/scss/**/*.scss', ['styles']);
});

gulp.task('watch-admin', function () {
    gulp.watch('theme-content/scss/admin/*.scss', ['styles-admin']);
});

gulp.task('start', ['styles', 'scripts'], function () {
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
gulp.task('copy-folder', function () {

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
        files_to_remove[k] = '../build/bucket/' + e;
    });

    return del.sync(files_to_remove, {force: true});
});

/**
 * Create a zip archive out of the cleaned folder and delete the folder
 */
gulp.task('zip', ['build'], function(){

    var versionString = '';
    //get theme version from styles.css
    var contents = fs.readFileSync("./style.css", "utf8");

    // split it by lines
    var lines = contents.split(/[\r\n]/);

    function checkIfVersionLine(value, index, ar) {
        var myRegEx = /^[Vv]ersion:/;
        if ( myRegEx.test(value) ) {
            return true;
        }
        return false;
    }

    // apply the filter
    var versionLine = lines.filter(checkIfVersionLine);

    versionString = versionLine[0].replace(/^[Vv]ersion:/, '' ).trim();
    versionString = '-' + versionString.replace(/\./g,'-');

    return gulp.src('./')
        .pipe(exec('cd ./../; rm -rf' + theme[0].toUpperCase() + theme.slice(1) + '*.zip; cd ./build/; zip -r -X ./../' + theme[0].toUpperCase() + theme.slice(1) + '-Installer' + versionString +'.zip ./; cd ./../; rm -rf build'));

});

// usually there is a default task  for lazy people who just wanna type gulp
gulp.task('default', ['start'], function () {
    // silence
});


gulp.task('update-demo', function () {

	var run_exec = require('child_process').exec;

	gulp.src('./')
		.pipe(prompt.confirm( "This task will stash all your local changes without commiting them,\n Make sure you did all your commits and pushes to the main " + main_branch + " branch! \n Are you sure you want to continue?!? "))
		.pipe(prompt.prompt({
			type: 'list',
			name: 'demo_update',
			message: 'Which demo would you like to update?',
			choices: ['cancel', 'test.demos.pixelgrade.com/' + theme_name, 'demos.pixelgrade.com/' + theme_name]
		}, function(res){

			if ( res.demo_update === 'cancel' ) {
				console.log( 'No hard feelings!' );
				return false;
			}

			console.log('This task may ask for a github user / password or a ssh passphrase');

			if ( res.demo_update === 'test.demos.pixelgrade.com/' + theme_name ) {
				run_exec('git fetch; git checkout test; git pull origin ' + main_branch + '; git push origin test; git checkout ' + main_branch + ';', function (err, stdout, stderr) {
					// console.log(stdout);
					// console.log(stderr);
				});
				console.log( " ==== The master branch is up-to-date now. But is the CircleCi job to update the remote test.demo.pixelgrade.com" );
				return true;
			}

			if ( res.demo_update === 'demos.pixelgrade.com/' + theme_name ) {
				run_exec('git fetch; git checkout master; git pull origin test; git push origin master; git checkout ' + main_branch + ';', function (err, stdout, stderr) {
					console.log(stdout);
					console.log(stderr);
				});

				console.log( " ==== The master branch is up-to-date now. But is the CircleCi job to update the remote demo.pixelgrade.com" );
				return true;
			}
		}));
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
        '=== Watchers === \n' +
        'watch              Watches all js and scss files \n' +
        'styles-watch       Watch only styles\n' +
	    '=== CircleCI Scripts === \n' +
	    'update-demo       Creates a prompt command which allows you to update the demos \n';

    console.log($help);

});