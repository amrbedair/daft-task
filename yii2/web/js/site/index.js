
$(function() {
	
	// console.log('doc-ready');
	
	var spinner = new Spinner();
	
	$("#pjax-bear-container").on('pjax:click', function() {
		// console.log('pjax-start');
		spinner.spin();
		$("#pjax-bear-container").append($(spinner.el));
	});
	
	$("#pjax-bear-container").on('pjax:complete', function() {
		// console.log('pjax-complete');
		spinner.stop();
		// clear search result
		$('div.list-view').empty();
	});
	
	$(document).on('click', '.lnk-more', function(e) {
		// console.log($(e.target).html());
		var $item = $(e.target);
		$("#searchform-term").val($item.html());
		$("#searchform-brewery_id").val($item.data('brewery-id'));
		$("input[name='SearchForm[type]'][value='brewery']").prop("checked", true);
		$("#frm-search").submit();
		// return false;
	});
	
	/* $(document).on('keyup', '#searchform-term', function(e) {
		var match = /^[a-zA-Z0-9\s\-]+$/.test($('#searchform-term').val());
		$("#frm-search button").prop('disabled', !match);
		if(!match) {
			$("#div-error").show();
		} else {
			$("#div-error").hide();
		}
	}); */
	
	// send brewery_id only in case of "more from a specific brewery"
	$(document).on('keyup', '#searchform-term', function(e) {
		$("#searchform-brewery_id").val('');
	});
	
	// send brewery_id only in case of "more from a specific brewery"
	$(document).on('click', '#frm-search button', function(e) {
		$("#searchform-brewery_id").val('');
	});
	
});