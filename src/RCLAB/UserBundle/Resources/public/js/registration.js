
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    $.backstretch($(".registration-body").attr('href'));
    $('#header-bar').on('shown.bs.collapse', function(){
    	$.backstretch("resize");
    });
    $('#header-bar').on('hidden.bs.collapse', function(){
    	$.backstretch("resize");
    });
    
    /*
        Form validation
    */
    $('[type="text"], [type="password"], [type="email"], textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $('.registration-form').on('submit', function(e) {
    	
    	$(this).find('[type="text"], [type="password"], [type="email"], textarea').each(function(){
    		if( $(this).val() === "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    });
});
