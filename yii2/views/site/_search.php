<?php

use app\models\forms\SearchForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\forms\SearchForm */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row search" style="margin: 10px -15px;">

    <?php $form = ActiveForm::begin([
    	'layout' => 'inline',
        'action' => ['search'],
        'method' => 'get',
        'options' => ['id' => 'frm-search', 'data-pjax' => 1],
    ]); ?>
    
    <?php echo $form->field($model, 'brewery_id')->hiddenInput()->label(false); ?>
    
    <div id="div-error" class="col-sm-12 no-padding" style="display: none;">
    	<span class="label label-danger">Invalid search query can not be empty, and only letters, numbers, hyphens and spaces are allowed</span>
    </div>
    
    <div class="col-sm-5 no-padding">
    	<div class="input-group">
        	<?= \yii\bootstrap\Html::activeInput('text', $model, 'term', ['class' => 'form-control', 'placeholder' => 'Search', 'style' => 'font-size: 18px; line-height: 1.8; height: 40px;']) ?>
    		<span class="input-group-addon" style="width: 1%;"><span class="glyphicon glyphicon-search"></span></span>
    	</div>
	</div>
    <div class="col-sm-3" style="padding: 10px 0 0 15px;">
        <?php echo Html::activeRadioList($model, 'type', [
        	SearchForm::TYPE_BEER => 'Beer',
        	SearchForm::TYPE_BREWERY => 'Brewery', 
        ]) ?>
    </div>
    <div class="col-sm-4">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary pull-right', 'disabled' => true]) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
