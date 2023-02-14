$(function () {
    'use strict';

    $(document).on('click', '.show-details-btn', function (e){
        e.preventDefault();
        let styleId = $(this).attr('style-id');
        $('.face.front-' + styleId).css({
            'transform': 'perspective(500px) rotateY(180deg)'
        });
        $('.face.back-' + styleId).css({
            'transform': 'perspective(500px) rotateY(360deg)'
        });
    });
    $(document).on('click', '.hide-details-btn', function (){
        let styleId = $(this).attr('style-id');
        $('.face.front-' + styleId).css({
            'transform': 'perspective(500px) rotateY(0deg)'
        });
        $('.face.back-' + styleId).css({
            'transform': 'perspective(500px) rotateY(180deg)'
        });
    });
    $(document).on('click', '.btn-custom', function (e){
        e.preventDefault();
    });
});