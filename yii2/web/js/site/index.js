
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
		// search with empty query "clear"
		search('');
	});
	
	$(document).on('click', '.lnk-more', function(e) {
		// console.log($(e.target).html());
		search($(e.target).html(), 'brewery', $(e.target).data('brewery-id'));
		// return false;
	});
	
	$(document).on('keyup', '#searchform-term', function(e) {
		var match = /^[a-zA-Z0-9\s\-]+$/.test($('#searchform-term').val());
		$("#frm-search button").prop('disabled', !match);
		if(!match) {
			$("#div-error").show();
		} else {
			$("#div-error").hide();
		}
	});
	
	function search(term, type='beer', breweryId='') {
		$("#searchform-term").val(term);
		$("#searchform-brewery_id").val(breweryId);
		$("input[name='SearchForm[type]'][value='"+type+"']").prop("checked", true);
		$("#frm-search").submit();
	}
});