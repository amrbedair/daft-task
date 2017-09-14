<?php

namespace tests\models;

use app\models\forms\SearchForm;
use app\helpers\BreweryDbHelper;

class SearchFormTest extends \Codeception\Test\Unit {
    
    private $model;
    
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testSearchEmptyQuery() {
        
        /** @var SearchForm $model */
        $this->model = new SearchForm();
        $dataProvider = $this->model->search(['SearchForm' =>['term' => '']]);
        expect_that($dataProvider->totalCount == 0);
    }
    
    public function testSearchInvalidQuery() {
    
        /** @var SearchForm $model */
        $this->model = new SearchForm();
        $dataProvider = $this->model->search(['SearchForm' =>['term' => '_#_#_']]);
        expect_that($dataProvider->totalCount == 0);
    }
    
    public function testSearchValidQuery() {
        
        /** @var SearchForm $model */
        $this->model = new SearchForm();
        $dataProvider = $this->model->search(['SearchForm' =>['term' => 'Afterimage']]);
        expect_that($dataProvider->totalCount > 0);
    }
    
    public function testSearchBrewery() {
    
        /**
         * @var BreweryDbHelper $breweryDbHelper
         */
        
        $brewery = false;
        while(!$brewery) {
            $breweryDbHelper = \Yii::$container->get('breweryDbHelper');
            $beer = $breweryDbHelper->getRandomBeer();
            if( !isset($beer['breweries']) ||
                !is_array($beer['breweries']) ||
                empty($beer['breweries']) ) continue;
            
            $brewery = $beer['breweries'][0];
        }
        
        /** @var SearchForm $model */
        $this->model = new SearchForm();
        $dataProvider = $this->model->search([
            'SearchForm' =>[
                'type' => SearchForm::TYPE_BREWERY,
                'brewery_id' => $brewery['id'],
                'term' => $brewery['name'],
            ]
        ]);
        
        // must at least has one result
        expect_that($dataProvider->totalCount > 0);
        
        // all items must have the same brewery
        // test sample of (max) three random items
        $breweryId = $brewery['id'];
        $testedIds = [];
        for ($i = 0; $i < $dataProvider->totalCount; $i++) {
            
            $beers = $dataProvider->allModels;
            $beer = $beers[array_rand($beers)];
            
            if(in_array($beer['id'], $testedIds)) continue;
            
            $testedIds[] = $beer['id'];
            
            $bdb = new \Pintlabs_Service_Brewerydb(\Yii::$app->params['BREWERY_DB_API_KEY']);
            $bdb->setFormat('php');
            
            $result = $bdb->request('beer/'.$beer['id'], ['withBreweries' => 'Y'], 'GET');
            
            expect($result['data']);
            
            $beer = $result['data'];
            
            expect($beer['breweries']);
            
            $breweries = $beer['breweries'];
            
            $breweryIds = [];
            foreach ($breweries as $brewery) {
                $breweryIds[] = $brewery['id'];
            }
            
            expect_that(in_array($breweryId, $breweryIds));
            
            if(count($testedIds) == 3) break;
        }
    }
}
