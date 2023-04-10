require('./bootstrap');
$(document).ready(function(){
    $('.profile').on('click',function(){
        $('.prof_details').css('top', '78px' );

    });
});
$(document).ready(function(){
    $('article').on('click',function(){
        $('.prof_details').css('top', '-500px' );

    });
});

