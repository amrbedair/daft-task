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
    	// 'layout' => 'inline',
    	'validateOnType' => true,
        'action' => ['search'],
        'method' => 'get',
        'options' => ['id' => 'frm-search', 'data-pjax' => 1],
    ]); ?>
    
    <?php echo $form->field($model, 'brewery_id')->hiddenInput()->label(false); ?>
    
    <?php if(!empty($model->term) && $model->hasErrors()) : ?>
    <div id="div-error" class="col-sm-12 no-padding">
    	<?php echo $form->errorSummary([$model]); ?>
    </div>
    <?php endif; ?>
    
    <div id="div-error" class="col-sm-12 no-padding" style="display: none;">
    	<span class="label label-danger">Invalid search query can not be empty, and only letters, numbers, hyphens and spaces are allowed</span>
    </div>
    
    <div class="col-sm-5 no-padding">
    	<?php echo $form->field($model, 'term', [])->textInput([])->label(false); ?>
	</div>
    <div class="col-sm-3" style="padding: 10px 0 0 15px;">
        <?php echo Html::activeRadioList($model, 'type', [
        	SearchForm::TYPE_BEER => 'Beer',
        	SearchForm::TYPE_BREWERY => 'Brewery', 
        ]) ?>
    </div>
    <div class="col-sm-4">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
