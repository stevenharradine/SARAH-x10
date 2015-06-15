require (['../../js/jquery-1.6.2.min'], function ($) {
	require({
		baseUrl: '../../js/'
	}, [
		"navigation",
		"add",
		"edit"
	], function( 
		nav,
		add,
		edit
	) {
		jQuery(".on a, .off a").click (function (event) {
			event.preventDefault();

			jQuery.ajax({
				url: jQuery (this).attr("href")
			});
		});
	});
});