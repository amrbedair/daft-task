<?php

namespace app\controllers;

use app\helpers\BreweryDbHelper;
use Yii;
use yii\web\Controller;
use app\models\forms\SearchForm;
use yii\helpers\Url;

class SiteController extends Controller {
    
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    /**
     * default controller/action
     * site/index
     *
     * @return string
     */
    public function actionIndex() {
        
        /**
         * get the singleton instance of the helper using Yii's DI tool
         * @var BreweryDbHelper $breweryDbHelper
         */
        $breweryDbHelper = \Yii::$container->get('breweryDbHelper');
        $beer = $breweryDbHelper->getRandomBeer();
    
        $searchModel = new SearchForm();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'beer' => $beer,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Load the search result in a seperate action to enhance performance
     * @return string
     */
    public function actionSearch() {
        
        $searchModel = new SearchForm();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->renderPartial('_search_and_result', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionFlushCache() {
        \Yii::$app->cache->flush();
        \Yii::$app->session->setFlash('success', 'Cache flushed successfully');
        return $this->redirect(Url::to('@web'));
    }
}
