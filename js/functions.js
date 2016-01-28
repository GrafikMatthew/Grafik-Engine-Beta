console.log("GrafikTheme >> functions.js loaded!");

(function($) {

	// Is jQuery defined?
	if(typeof $ == undefined) {
		console.log("jQuery not defined, quitting!");
		return;
	}

	$( document ).on( "ready", function() {

		console.log("document.ready()");

		// Toggle-able Elements
		$('.showable').each(function(){var __this=$(this);__this.on("click",function(e){e.stopPropagation();}).hide().parent().css({"cursor":"pointer"}).on("click",function(){__this.toggle();});});
		$('.hideable').each(function(){var __this=$(this);__this.on("click",function(e){e.stopPropagation();}).show().parent().css({"cursor":"pointer"}).on("click",function(){__this.toggle();});});

	} );

} )( jQuery );