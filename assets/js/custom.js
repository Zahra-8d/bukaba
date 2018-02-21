
jQuery(document).ready(function() {

jQuery(".slicknav").click(function($e) {
	$e.preventDefault();
	jQuery(".main-nav").toggleClass("view");
});


jQuery(".down").click(function($e) {
      jQuery('html,body').animate({
        scrollTop:jQuery('#primary').offset().top}, 700);
}); 


});


