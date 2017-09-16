<?php
use yii\widgets\Pjax;
use yii\widgets\ListView;
?>

<?php Pjax::begin(['id' => 'pjax-bear-list', 'enablePushState' => false, 'timeout' => 30000]); ?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
	'itemView' => '_beer_item',
	'options' => ['class' => 'list-view row'],
	'itemOptions' => ['class' => 'col-sm-12', 'style' => 'padding: 0; margin-bottom: 20px;'],
]) ?>
<?php Pjax::end(); ?>