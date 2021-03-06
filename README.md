# Distilled SCH - Technical Assessment
Simple application that requires accessing BreweryDB getting a random beer, fetching beers from the same brewery, and a simple search form that searches in the BreweryDB using rhe given query string and target type

Here I am going to implement this with some technologies I feel you maybe interested in

See working [demo](http://daft.nefya.com/)

## Running
The easiest way to run this demo locally is to:
* clone this repo
* cd inside your local copy 
* run the command docker-compose build "for sure you have to have docker installed"
* run the command docker-compose up
* open http://localhost:1984/ in your browser

## Yii
This implementation utilizes the great Yii framework [version 2.x], it is a regular web application that does not has the new separation between backend and frontend, although I tried to do the best practices using ajax, caching, and partial rendering when required to enhance performance as much as possible

**To run this app simply do**
* copy the directory yii2 into your servers docroot
* run the command composer install
* open url to http://localhost/yii2/web - this may differ based on your deployment

**To run tests [unit, and functional]; simply**
* run the command
```
vendor/bin/codecept run
```
while you are inside the directory yii2

**Note:**
* Search by type="brewery" is searching for breweries, then returns all beers from those breweries
* Yii is an MVC framework so it should be familiar, navigating the code should be easy, as you can see directory names are self explanatory, controllers for application controllers, views for views, and tests for test  
* Yii uses Codeception for testing that uses PHPUnit for unit testing
* Application is caching styles, and breweries' beers for 24 hours to enhance performance trying to minimize API hits, so I added a button to flush the cache if required
* The "Back" link will always lead to my test server as it is hard coded 

## Laravel + Vue.js
Here I seperated the app into two parts; frontend and backend, frintend is written using Vue.js, backend is written by Lumen - the micro-framework version of Laravel

**To run this app simply do**
* copy the direcory laravel-vuejs into your servers docroot
* cd app_directory/backend
* run "composer install"
* open the file frontend/js/plugins.js
* go line 28, config the backend url based on your server config. - you maybe using vhost
* open url to http://localhost/laravel-vuejs/frontend/ - this may differ based on your deployment

**Note:**
* Application is caching styles, and breweries' beers for 24 hours to enhance performance trying to minimize API hits, so I added a button to flush the cache if required
* The "Back" link will always lead to my test server as it is hard coded

## Vue.js
[sorry no time for this]

### Notes
* System needs some UI enhancements like for e.g. dimming the beer div while loading the new random one, same for the search result, also disabling the buttons while waiting for the ajax response, but all these are minor and simple touches