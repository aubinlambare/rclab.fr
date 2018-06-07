$(document).ready(function() {

    $.backstretch($(".index-body").attr('href'));
    $('#header-bar').on('shown.bs.collapse', function(){
        $.backstretch("resize");
    });
    $('#header-bar').on('hidden.bs.collapse', function(){
        $.backstretch("resize");
    });

    $('.item').eq(0).addClass('active');
    $('.focusNumber').eq(0).addClass('active');
    $('.alert').delay(4000).fadeOut(2000);

    function LastWeek(day) {
        day = day - 7;
        return day;
    }
    function NewtWeek(day) {
        day = day + 7;
        return day;
    }
});
