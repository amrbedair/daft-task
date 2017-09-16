// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.
var site = {};
site.utils = (function($) {
	
	// var _backend_url = 'http://localhost/daft/laravel-vuejs/backend/public/'; // local
	var _backend_url = 'http://daft.nefya.com/laravel-vuejs/backend/public/'; // prod
		
	return {
		bu: function(url) {
    		return _backend_url + url.replace(/^\/|\/$/g, '');
    	},
    	notify: function (message, type) {
        	$.notify({
        		// options
        		message: message,
        		icon: 'glyphicon glyphicon glyphicon-info-sign',
        		// title: 'Bootstrap notify',
        		// url: 'https://github.com/mouse0270/bootstrap-notify',
        		// target: '_blank'
        	},{
        		// settings
        		type: type,
        		allow_dismiss: true,
        		newest_on_top: true,
        		placement: {
        			from: "top",
        			align: "right"
        		},
        		mouse_over: 'pause',
        		offset: {x: 5, y: 65},
        		z_index: 1060,
        		onShow: function (e) {
        			$(this).find('[data-notify="dismiss"]').css({
        				right: '10px',
        				left: 'auto',
        				top: '15px',
        			});
        			$(this).find('[data-notify="icon"]').css({margin: '0 10px 0 0'});
        		},
        		template: '<div data-notify="container" class="col-xs-11 col-sm-4 alert alert-{0}" role="alert"><button type="button" aria-hidden="true" class="close" data-notify="dismiss">&times;</button><span data-notify="icon"></span> <span data-notify="title">{1}</span> <span data-notify="message">{2}</span><div class="progress" data-notify="progressbar"><div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div><a href="{3}" target="{4}" data-notify="url"></a></div>'
        	});
        }
	};
})(jQuery);