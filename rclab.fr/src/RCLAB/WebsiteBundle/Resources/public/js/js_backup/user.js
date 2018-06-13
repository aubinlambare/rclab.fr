$(document).ready(function() {

    $.backstretch($(".user-body").attr('href'));
    $('#header-bar').on('shown.bs.collapse', function(){
        $.backstretch("resize");
    });
    $('#header-bar').on('hidden.bs.collapse', function(){
        $.backstretch("resize");
    });

    $('.alert').delay(4000).fadeOut(2000);

});