

/**
 * app root
 */
var app = new Vue({
  el: '#app',
  data: {
	beer: null,
	beers: [],
	loading: false,
	form: {term: '', breweryId: '', type: 'beer', valid: false}
  },
  watch: {
	  'form.term': function(val) {
		  this.form.valid = this.validate(val);
	  }
  },
  created: function () {
	  this.getAnotherBeer();
  },
  methods: {
	  flushCache: function (e) {
		  $.get(site.utils.bu('api/flush-cache'), function(result) {
			  site.utils.notify(result.message, result.type)
		  });
		  return false;
	  },
	  getAnotherBeer: function() {
		  this.beer = null;
		  var that = this;
		  $.get(site.utils.bu('api/random-beer'), function(result) {
			  if(result.type == 'success') {
				  that.beer = result.beer;
			  } else {
				  site.utils.notify(result.message, result.type)
			  }
		  });
	  },
	  search: function() {
		  this.beers = [];
		  // if(!this.form.valid) return; // search is fired before watch!
		  if(!this.validate(this.form.term)) return;
		  var that = this;
		  that.loading = true;
		  $.get(site.utils.bu('api/search'), that.form, function(result) {
			  if(result.type == 'success') {
				  that.beers = result.beers;
				  that.loading = false;
			  } else {
				  site.utils.notify(result.message, result.type)
			  }
		  });
		  return;
	  },
	  validate: function(q) {
		  return q.trim() != '' && /^[a-zA-Z0-9\s\-]+$/.test(q);
	  }
  }
});
