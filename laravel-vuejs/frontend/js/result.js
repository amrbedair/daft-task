/**
 * result
 */
Vue.component('result', {
	props: [
	    'loading',
	    'beers',
	],
	created: function() {
		// console.log(this.beers);
	},
	template: `
		<div class="list-view row">
			<template v-if="!loading">
				<div class="summary">Showing {{beers.length}} items.</div>
				<template v-for="beer in beers">
					<div class="col-sm-12" style="padding: 0; margin-bottom: 20px;" data-key="0">
						<div class="container-fluid beer-container">
							<div class="col-sm-2">
								<img class="beer-image" :src="beer.labels.icon">
							</div>
							<div class="col-sm-10">
								<strong>{{beer.name}}</strong>
								<p>{{abbreviatedDescription(beer.description)}}</p>
							</div>
						</div>
					</div>
				</template>
			</template>
			<template v-else>
			    loading...
			</template>
		</div>
	`,
	methods: {
		abbreviatedDescription: function(description) {
			return description.split(/\s+/).slice(0, 40).join(" ");
		}
	}
});