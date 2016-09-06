/* RILOADR INIT */

function riloadrInit() {
    // Lazy loading for images with '.lazy' class
    var riloadrImages = new Riloadr({
        name : 'lazy',
        breakpoints: [
            {name: 'whatever' , minWidth: 1}
        ],
        defer: {
            mode: 'load'
        }
    });

    // Responsive Featured Image for single post page
    var riloadrSingle = new Riloadr({
        name : 'riloadr-single',
        breakpoints: [
            {name: 'small' , maxWidth: 400},
            {name: 'big'   , minWidth: 401}
        ],
        watchViewportWidth: "*"
    });
}