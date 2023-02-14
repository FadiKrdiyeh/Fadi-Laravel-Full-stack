$(function(){
    'use strict';

    $('.theme-box').on('click', function () {
        $('.theme-box').removeClass('active');
        $(this).addClass('active');
        window.localStorage.setItem("web-style-theme", $(this).attr("data-value"));
        window.localStorage.setItem("web-style-theme-name", $(this).attr("data-name"));
        $("link[href*='/themes/']").attr("href", window.localStorage.getItem("web-style-theme"));
    });
    let localThemeName = window.localStorage.getItem("web-style-theme-name");
    if (localThemeName) {
        // If There Is Color In Local Storage
        $('.' + localThemeName).addClass('active');
        // $("link[href*='/themes/']").attr("href", window.localStorage.getItem("web-style-theme"));
    }
});