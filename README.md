# Distilled SCH - Technical Assessment
Simple application that requires accessing BreweryDB getting a random beer, fetching beers from the same brewery, and a simple search form that searches in the BreweryDB using rhe given query string and target type

Here I am going to implement this with some technologies I feel you maybe interested in

## Yii
This implementation utilized the great Yii framework [version 2.x], it is a regular web application that does not has the new separation between backend and frontend, although I tried to do the best practices using ajax, caching, and partial renders when required to enhance performance as much as possible

**To run this app simply do**
* copy the directory yii2 into your servers docroot
* run the command composer install
* open url to http://localhost/yii2/web

**To run tests [unit, and functional]; simply**
* run the command
```
vendor/bin/codecept run
```
while you are inside the directory yii2

**Note:**
* Yii is an MVC framework so it should be familiar, navigating the code should be easy, as you can see directory names are self explanatory, controllers for application controllers, views for views, and tests for test  
* Yii uses Codeception for testing that uses PHPUnit for unit testing
* The "Back" link will always lead to my test server as it is hard coded 

## Laravel + Vue.js

## Vue.js