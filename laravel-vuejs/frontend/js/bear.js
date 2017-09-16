/**
 * beer
 */
Vue.component('beer', {
	props: ['beer', 'form'],
	template: `
		<div class="container-fluid beer-container">
			<template v-if="beer">
			<div class="col-sm-3">
				<strong>{{beer.name}}</strong>
				<img :src="beer.labels.medium" class="beer-image" />
				<template v-if="beer.hasOwnProperty('breweries')">
					<strong>Breweries:</strong>
					<template v-for="brewery in beer.breweries">{{brewery.name}}</template>
		        </template>
		    </div>
		    <div class="col-sm-6">
		    	{{beer.description}}
		    </div>
		    <div class="col-sm-3">
		
			    <a class="btn btn-lg btn-primary btn-block" @click="getAnotherBeer">Another Beer</a>
			
			    <template v-if="beer.hasOwnProperty('breweries')">
					<div class="btn-group" style="margin-top: 15px; width: 100%">
			  			<button type="button" class="btn btn-lg btn-primary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    			More From <span class="caret pull-right" style="margin-top: 10px;"></span>
			  			</button>
			  			<ul class="dropdown-menu dropdown-menu-right">
			    			<li v-for="brewery in beer.breweries"><a href="#" class="lnk-more" :data-brewery-id="brewery.id" @click="moreFrom(brewery)">{{brewery.name}}</a></li>
						</ul>
					</div>
				</template>
			</div>
			</template>
			<template v-else>
			    loading...
			</template>
		</div>
	`,
	methods: {
		getAnotherBeer: function() {
			this.$emit('get-another-beer');
		},
		moreFrom: function(brewery) {
			
			this.form.term = brewery.name
			this.form.breweryId = brewery.id;
			this.form.type = 'brewery';
			
			this.$emit('search');
			
			return false;
		}
	}
});