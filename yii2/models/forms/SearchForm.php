<?php

namespace app\models\forms;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use app\helpers\BreweryDbHelper;

/**
 * ContactForm is the model behind the contact form.
 */
class SearchForm extends Model {
    
    const TYPE_BEER = 'beer';
    const TYPE_BREWERY = 'brewery';
    
    public $term;
    public $type = self::TYPE_BEER; // default value
    public $brewery_id;


    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['term', 'type'], 'required'],
            ['term', 'match', 'pattern' => '/^[a-zA-Z0-9\s\-]+$/', 'message' => 'Invalid Search Query; only letters, numbers, hyphens and spaces are allowed'],
            ['brewery_id', 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'term' => 'Search Query'
        ];
    }
    
    public function search($params) {
        
        $this->load($params);
        
        $bears = [];
        
        if($this->validate()) {
            /**  @var BreweryDbHelper $breweryDbHelper */
            $breweryDbHelper = \Yii::$container->get('breweryDbHelper');
            $bears = $breweryDbHelper->search($this->term, $this->type, $this->brewery_id, isset($params['page']) ? $params['page'] : 1);
        }
        
        return new ArrayDataProvider([
            'allModels' => $bears,
            'sort' => [
                'attributes' => ['id', 'username', 'email'],
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
    ]);
    }

}
