$(document).ready(function () {
    $('.fade-out').fadeOut(3000);
    // $(document).css()
});

$(function(){
    'use strict';

    let localThemeName = window.localStorage.getItem("web-style-theme-name");
    if (localThemeName) {
        // If There Is Color In Local Storage
        $("link[href*='/themes/']").attr("href", window.localStorage.getItem("web-style-theme"));
    }
});

window.onload = function () {
    "use strict";

    // Loading Elements
    // Hide Spinner...
    $(".loading-container .loader").fadeOut(2000, function () {
        // Show Page Scroll...
        // $("body").css("overflow-y", "auto");
        $("html").css("overflow-y", "auto");
        // Hide Loading Section...
        $(".loading-container").fadeOut(2000, function () {
            $(this).remove();
            // Remove Section...
        });
    });
}