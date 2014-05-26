var shell = require('shelljs');

module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            options: {
                separator: ';'
            },
            core: {
                src: [
                    'redux3/assets/js/vendor/cookie.js',
                    'redux3/assets/js/vendor/qtip/jquery.qtip.js',
                    'redux3/assets/js/vendor/jquery.typewatch.js',
                    'redux3/assets/js/vendor/spinner_custom.js',
                    'redux3/assets/js/vendor/jquery.alphanum.js',
                    'redux3/assets/js/vendor/select2.sortable.js',
                    'redux3/assets/js/vendor/minicolors/jquery.minicolors.js',
                    'redux3/inc/fields/**/*.js',
                    'redux3/extensions/**/*.js',
                    'redux3/assets/js/redux.js'
                ],
                dest: 'redux3/assets/js/redux.min.js'
            },
            vendor: {
                src: [
                    'redux3/assets/js/vendor/cookie.js',
                    'redux3/assets/js/vendor/qtip/jquery.qtip.js',
                    'redux3/assets/js/vendor/jquery.typewatch.js',
                    'redux3/assets/js/vendor/spinner_custom.js',
                    'redux3/assets/js/vendor/jquery.alphanum.js',
                    'redux3/assets/js/vendor/select2.sortable.js'
                ],
                dest: 'redux3/assets/js/vendor.min.js'
            }
        }
    });

//    grunt.loadNpmTasks('grunt-contrib-uglify');
//    grunt.loadNpmTasks('grunt-contrib-jshint');
//    grunt.loadNpmTasks('grunt-contrib-qunit');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
//    grunt.loadNpmTasks('grunt-phpdocumentor');
//    grunt.loadNpmTasks('grunt-gh-pages');
    grunt.loadNpmTasks("grunt-phplint");
    grunt.loadNpmTasks('grunt-contrib-less');
//    grunt.loadNpmTasks('grunt-po2mo');

//    grunt.registerTask('langUpdate', "Update languages", function() {
//        shell.exec('tx pull -a --minimum-perc=25');
//        shell.exec('grunt po2mo');
//        shell.exec('rm -f redux3/languages/*.po');
//        shell.exec('php bin/makepot/gen.php');
//    });

    // Default task(s).
    grunt.registerTask('default', ['concat:core', 'concat:vendor']);
    grunt.registerTask('travis', ['lintPHP']);

    // this would be run by typing "grunt test" on the command line
//    grunt.registerTask('testJS', ['jshint', 'concat:core', 'concat:vendor']);

    grunt.registerTask('watchUI', ['watch:ui']);
    grunt.registerTask('watchPHP', ['watch:php', 'phplint:core', 'phplint:plugin']);

    grunt.registerTask("lintPHP", ["phplint:plugin", "phplint:core"]);
//    grunt.registerTask("compileCSS", ["less:production", "less:development", "less:extensions"]);
    grunt.registerTask('compileJS', [ 'concat:core', 'concat:vendor']);
//    grunt.registerTask('compileTestJS', ['jshint', 'concat:core', 'concat:vendor']);

};
