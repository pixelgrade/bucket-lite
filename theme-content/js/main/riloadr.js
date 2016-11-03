/* RILOADR INIT */

var Riload = (function() {

    var initialized = false,
        riloadrImages,
        riloadrSingle;

    function init() {

        // Lazy loading for images with '.lazy' class
        riloadrImages = new Riloadr({
            name : 'lazy',
            breakpoints: [{
                name: 'whatever',
                minWidth: 1
            }],
            defer: {
                mode: 'load'
            }
        });

        // Responsive Featured Image for single post page
        riloadrSingle = new Riloadr({
            name : 'riloadr-single',
            breakpoints: [{
                name: 'small',
                maxWidth: 400
            }, {
                name: 'big',
                minWidth: 401
            }],
            watchViewportWidth: "*"
        });

        initialized = true;
    }

    function refresh() {
        if ( ! initialized ) {
            return;
        }
        riloadrImages.riload();
        riloadrSingle.riload();
    }

    return {
        init: init,
        refresh: refresh
    }

})();
