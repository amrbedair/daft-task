<?php

use yii\widgets\Pjax;
use app\assets\AppAsset;

/* @var $this yii\web\View */

$this->title = "Home";

$this->registerJsFile('@web/js/site/index.js', ['depends' => [AppAsset::className()]]);

?>
<div class="container-fluid no-padding">
	
	<div class="col-sm-12 no-padding">
		<?php Pjax::begin(['id' => 'pjax-bear-container', 'enablePushState' => false, 'timeout' => 30000]); ?>
		<?php echo $this->render('_beer', ['beer' => $beer]); ?>
		<?php Pjax::end(); ?>
	</div>
	
	<div class="col-sm-12 no-padding">
		<div class="container-fluid">
		<?php echo $this->render('_search_and_result', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]); ?>
		</div>
	</div>
	
</div>
