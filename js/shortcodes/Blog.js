(function($){

	var NextPage = 2;
	var LoadMore = true;
	var LazyClicker, LazyScroller;

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
		var LazyResults = $('<div/>').load('?'+location.search+'&paged='+NextPage+' .lazy-wrapper > *', function() {

			NextPage ++;
			LoadMore = true;

			var LazyResultsChildren = LazyResults.find('> *');
			if( LazyResultsChildren.length ) {
				LazyResultsChildren.appendTo( $('.theme-blog .lazy-wrapper') );
				LazyResults.remove();
				if( loop && ScrolledIntoView( LazyScroller.get(0) ) ) {
					DoLazyLoad( loop );
				}
			} else {
				LazyResults.remove();
			}

		});

	}

	$(document).ajaxComplete(function(event, xhr, options) {
		if( xhr.status == 404 ) {
			LoadMore = false;
			if( LazyClicker.length ) LazyClicker.hide();
			if( LazyScroller.length ) LazyScroller.hide();
		}
	});

	$(document).on('ready', function() {

		LazyClicker = $('.theme-blog .lazy-loader-click');
		LazyScroller = $('.theme-blog .lazy-loader-scroll');

		// Load by Clicking...
		if( LazyClicker.length ) {
			LazyClicker.on('click', function() {
				if( LoadMore ) {
					DoLazyLoad();
				}
			});
		}

		// Load by Scrolling...
		if( LazyScroller.length ) {
			$(window).on('scroll resize', function() {
				if( LoadMore && ScrolledIntoView( LazyScroller.get(0) ) ) {
					DoLazyLoad( true );
				}
			}).trigger('scroll');

		}

	});

})(jQuery);