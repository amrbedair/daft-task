/**
 * search
 */
Vue.component('search', {
	props: ['loading', 'form'],
	template: `
		<div class="row search" style="margin: 10px -15px;">
			<form id="frm-search">
			
				<input type="hidden" v-model="form.breweryId">
			    
				<div class="col-sm-5 no-padding">
					<div class="form-group field-searchform-term required" :class="{'has-error': !form.valid}">
						<input type="text" class="form-control" aria-required="true" v-model="form.term">
						<p class="help-block help-block-error" v-if="!form.valid">{{error}}</p>
					</div>
				</div>
				
				<div class="col-sm-3" style="padding: 10px 0 0 15px;">
			    	<div>
			    		<label><input type="radio" value="beer" v-model="form.type"> Beer</label>
			    		<label><input type="radio" value="brewery" v-model="form.type"> Brewery</label>
			    	</div>
			    </div>
			    
				<div class="col-sm-4">
				    <button type="button" class="btn btn-primary pull-right" @click="submit" :disabled="loading">Search</button>
				</div>
				
			</form>
		</div>
	`,
	computed: {
		// valid: function() {
			// return this.form.term.trim() != '' && /^[a-zA-Z0-9\s\-]+$/.test(this.form.term);
		// },
		error: function() {
			if(this.form.term.trim() == '') {
				return 'Search Query cannot be blank.';
			} else {
				return 'Invalid Search Query; only letters, numbers, hyphens and spaces are allowed.'
			}
		}
	},
	methods: {
		submit: function(e) {
			if(!this.form.valid) return;
			this.form.breweryId = '';
			this.$emit('search');
			return false;
		}
	}
});