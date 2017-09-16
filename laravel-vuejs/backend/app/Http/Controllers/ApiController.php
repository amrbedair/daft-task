<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller {
	
	public function getRandomBeer(Request $request) {
	    
	    // return response('{"type":"success","beer":{"id":"GUpvks","name":"Tume","nameDisplay":"Tume","description":"An old style dark lager. Brewed since 1960.\r\nSaku Tume is special dark brew with an excellent dark colouring and rich taste. For the preparation of Saku Tume, in addition to pilsner malt, Munich and caramel malt, as well as sugar. A long lager period ensures a balanced taste and fragrance bouquet for Saku Tume.","abv":"6.7","styleId":88,"isOrganic":"Y","labels":{"icon":"https:\/\/s3.amazonaws.com\/brewerydbapi\/beer\/GUpvks\/upload_OemBKY-icon.png","medium":"https:\/\/s3.amazonaws.com\/brewerydbapi\/beer\/GUpvks\/upload_OemBKY-medium.png","large":"https:\/\/s3.amazonaws.com\/brewerydbapi\/beer\/GUpvks\/upload_OemBKY-large.png"},"status":"verified","statusDisplay":"Verified","createDate":"2015-07-29 21:03:30","updateDate":"2015-12-18 04:28:09","style":{"id":88,"categoryId":7,"category":{"id":7,"name":"European-germanic Lager","createDate":"2012-03-21 20:06:46"},"name":"Traditional German-Style Bock","shortName":"Bock","description":"Traditional bocks are made with all malt and are strong, malty, medium- to full-bodied, bottom-fermented beers with moderate hop bitterness that should increase proportionately with the starting gravity. Malt character should be a balance of sweetness and toasted\/nut-like malt; not caramel. Hop flavor should be low and hop aroma should be very low. Bocks can range in color from deep copper to dark brown. Fruity esters should be minimal. Diacetyl should be absent.","ibuMin":"20","ibuMax":"30","abvMin":"6.3","abvMax":"7.5","srmMin":"20","srmMax":"30","ogMin":"1.066","fgMin":"1.018","fgMax":"1.024","createDate":"2012-03-21 20:06:46","updateDate":"2015-04-07 15:38:54"},"breweries":[{"id":"80ewUQ","name":"Saku \u00d5lletehas","nameShortDisplay":"Saku \u00d5lletehas","description":"The brewing traditions of Saku Brewery reach back to the beginning of the 19th century. Then the Saku estate was owned by count Karl Friedrich Rehbinder who built a distillery and a brewery on his estate. The brewery was first documented in October 1820. It is believed that the production of beer, for the purpose of sale to pubs and taverns begun during the autumn of that year. From the end of 19th century onward Saku has remained among the leading breweries in Estonia.\r\nIn 1991 joint venture Saku \u00d5lletehas was established. Since January 27, 1998 the shares of Saku Brewery were traded in the list on the Tallinn Stock Exchange. On September 20, 2008, the shares of Saku \u00d5lletehase AS were delisted from Tallinn Stock Exchange. Today 100% of the shares are owned by Carlsberg Breweries.\r\nThrough large investments, Saku Brewery has become the market leader on the Estonian beer market. According to market research by ACNielsen in March 2009, Saku Brewery held 38,7% of the local market share. The total sales of beer by Saku amounted to 59 million litres in 2007.\r\nBeverages of Saku Brewery are exported amongst other countries to Sweden (the only Estonian beer in the Systembolaget is Saku Kuld), Finland, Netherlands, England, Germany, Ireland and Canada. Saku\'s exports during the first five months of 2009 amounted to 3,12 million litres.","website":"http:\/\/www.saku.ee\/","established":"1820","isOrganic":"N","status":"verified","statusDisplay":"Verified","createDate":"2012-01-03 02:42:07","updateDate":"2015-12-22 14:56:47","isMassOwned":"N","brandClassification":"craft","locations":[{"id":"CgUpen","name":"Main Brewery","streetAddress":"Tallinna mnt.2","locality":"Saku","region":"Harjumaa","postalCode":"75501","phone":"+3726508400","website":"http:\/\/www.saku.ee\/","latitude":59.3014407,"longitude":24.6679157,"isPrimary":"Y","inPlanning":"N","isClosed":"N","openToPublic":"Y","locationType":"micro","locationTypeDisplay":"Micro Brewery","countryIsoCode":"EE","yearOpened":"1820","status":"verified","statusDisplay":"Verified","createDate":"2012-01-03 02:42:07","updateDate":"2014-07-23 19:11:34","country":{"isoCode":"EE","name":"ESTONIA","displayName":"Estonia","isoThree":"EST","numberCode":233,"createDate":"2012-01-03 02:41:33"}}]}]}}')->header('Content-Type', 'application/json');
	    
	    $app= App::getFacadeRoot();
        $breweryDbHelper = $app->make('breweryDbHelper');
        $beer = $breweryDbHelper->getRandomBeer();
        
		return [
		    'type' => 'success',
		    'beer' => $beer,
		];
	}
	
	public function search(Request $request) {
	    
	    $app= App::getFacadeRoot();
	    $breweryDbHelper = $app->make('breweryDbHelper');
	    $beers = $breweryDbHelper->search(
	        $request->input('term'),
	        $request->input('type'), 
	        $request->input('breweryId')
        );
	    return [
	        'type' => 'success',
	        'beers' => $beers,
	    ];
	}
	
	public function flushCache(Request $request) {
	    Cache::flush();
	    return [
	        'type' => 'success',
	        'message' => 'Cache flushed successfully',
	    ];
	}
	
}