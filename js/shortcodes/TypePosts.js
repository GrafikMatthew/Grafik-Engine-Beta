(function($){

	var NextPage = 2;
	var LoadMore = true;
	var SingleClicker, SingleScroller;

	function ScrolledIntoView(elem) {

		var ThisWindow = $(window);
		var ThisElement = $(elem);
		var ViewTop = ThisWindow.scrollTop();
		var ViewBottom = ViewTop + ThisWindow.height();
		var ElementTop = ThisElement.offset().top;
		var ElementBottom = ElementTop + ThisElement.height();

		return ((ElementBottom <= ViewBottom) && (ElementTop >= ViewTop));

	}

	function DoLazyLoad( loop ) {

		if(!LoadMore) return;

		LoadMore = false;
		var SingleURL = '?'+( location.search.length ? location.search+'&' : '' )+'paged='+NextPage+' .single-wrapper > *:not(.empty-message)'
		console.log( SingleURL );
		var SingleResults = $('<div/>').load( SingleURL, function() {

			NextPage ++;
			LoadMore = true;

			var SingleResultsChildren = SingleResults.find('> *');
			if( SingleResultsChildren.length ) {
				SingleResultsChildren.appendTo( $('.theme-typeposts .single-wrapper') );
				SingleResults.remove();
				if( loop && ScrolledIntoView( SingleScroller.get(0) ) ) {
					DoLazyLoad( loop );
				}
			} else {
				SingleResults.remove();
			}

		});

	}

	$(document).ajaxComplete(function(event, xhr, options) {
		if( xhr.status == 404 ) {
			LoadMore = false;
			if( SingleClicker.length ) SingleClicker.hide();
			if( SingleScroller.length ) SingleScroller.hide();
		}
	});

	$(document).on('ready', function() {

		SingleClicker = $('.theme-typeposts .single-click-loader');
		SingleScroller = $('.theme-typeposts .single-scroll-loader');

		// Load by Clicking...
		if( SingleClicker.length ) {
			SingleClicker.on('click', function() {
				if( LoadMore ) {
					DoLazyLoad();
				}
			});
		}

		// Load by Scrolling...
		if( SingleScroller.length ) {
			$(window).on('scroll resize', function() {
				if( LoadMore && ScrolledIntoView( SingleScroller.get(0) ) ) {
					DoLazyLoad( true );
				}
			}).trigger('scroll');

		}

	});

})(jQuery);