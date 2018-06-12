$(document).ready(function() {

    $.backstretch($(".actu-body").attr('href'));
    $('#header-bar').on('shown.bs.collapse', function(){
        $.backstretch("resize");
    });
    $('#header-bar').on('hidden.bs.collapse', function(){
        $.backstretch("resize");
    });

    $('.alert').delay(4000).fadeOut(2000);
});

function onlyEvent(){
    $(".card-news").css("display", "none");
    $(".card-event").css("display", "block");
}

function onlyNews(){
    $(".card-news").css("display", "block");
    $(".card-event").css("display", "none");
}

function notOnlyOne(){
    $(".card-news").css("display", "block");
    $(".card-event").css("display", "block");
}