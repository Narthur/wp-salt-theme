jQuery( document ).ready(function($) {
    function adjustWrapperPaddingForFooter() {
        var footerHeight = $('#footer').outerHeight(true);
        $('#wrapper').css('padding-bottom',footerHeight + 'px');
    }

    function wrapMainNav() {
        var primaryNav = $('.primary-nav');
        var primaryNavItems = $('.primary-nav li');
        primaryNavItems.css('clear','none');
        var itemHeight = primaryNavItems.outerHeight(true);
        var navHeight = primaryNav.height();
        var numRows = navHeight / itemHeight;
        var numItems = primaryNavItems.length;
        var numItemsPerRow = Math.ceil(numItems / numRows);
        var selector = ".primary-nav li:nth-child("+numItemsPerRow+"n+1)";
        $(selector).css("clear", "both");
    }

    function adjustPage() {
        adjustWrapperPaddingForFooter();
        wrapMainNav();
    }

    $(window).resize(adjustPage);
    adjustPage();
});