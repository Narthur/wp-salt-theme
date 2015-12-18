jQuery( document ).ready(function($) {
    function adjustWrapperPaddingForFooter() {
        var footerHeight = $('#footer').outerHeight(true);
        $('#wrapper').css('padding-bottom',footerHeight + 'px');
    }
    $(window).resize(adjustWrapperPaddingForFooter);
    adjustWrapperPaddingForFooter();
});