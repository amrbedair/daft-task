/**
 * search and result
 */
Vue.component('search-and-result', {
	props: ['loading', 'beers', 'form'],
	template: `
		<div class="container-fluid">
			<search @search="search" :form.sync="form" :loading="loading"></search>
			<result :beers="beers" :loading="loading"></result>
		</div>
	`,
	methods: {
		search: function() {
			this.$emit('search');
			return false;
		}
	}
});