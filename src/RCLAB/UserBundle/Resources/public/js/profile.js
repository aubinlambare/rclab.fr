jQuery(document).ready(function() {

    /*
        Fullscreen background
    */
    $.backstretch($(".profile-body").attr('href'));
    $('#header-bar').on('shown.bs.collapse', function(){
        $.backstretch("resize");
    });
    $('#header-bar').on('hidden.bs.collapse', function(){
        $.backstretch("resize");
    });
});