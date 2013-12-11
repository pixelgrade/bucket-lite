//accordion on single product
(function($) {
    
    var allPanels = $('.pix-accordion > li > .panel__entry-content');

    $('.pix-accordion > li > a').click(function() {
        allPanels.slideUp();
        $(this).parent().find('.panel__entry-content').slideDown();
        return false;
    });

})(jQuery);