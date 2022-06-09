 


		//----------------------fix nav on scroll----------------------//
		
		var $r = jQuery.noConflict();

	var stickyNavOffsetTop = $r('#pav-mainnav').offset().top;
	//console.log(stickyNavOffsetTop);
	var stickyNav = function(){
		var scrollTop = $r(window).scrollTop();
	
	if( scrollTop > stickyNavOffsetTop ){
			$r('#pav-mainnav').stop().addClass('fixNav');
		} else {
			$r('#pav-mainnav').stop().removeClass('fixNav');
		}
	};	
	// run our function on load
	stickyNav();
	
	// and run it again every time you scroll
	$r(window).scroll(function() {
		 stickyNav();
	});
//Same Height


	function setStableHeight(element) {

		var items = $(element);

			var biggestHeight = 0;

			items.each(function() {

				if( biggestHeight < $(this).height()) {
					biggestHeight = $(this).height();
				}
				
			});

			items.each(function() {

				$(this).css('height', biggestHeight + 'px');
			});
	}
 
	
//----------------------fix nav on scroll----------------------//