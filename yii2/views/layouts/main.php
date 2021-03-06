<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->name." - ".$this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<span class="glyphicon glyphicon-chevron-left"></span> Back',
        'brandUrl' => 'http://daft.nefya.com/',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    ?>
    <div class="navbar-header app-header">
    	<a href="<?= Url::to('@web')?>" style="text-decoration: none;"><?= Yii::$app->name ?></a>
    </div>
    <a type="button" class="btn btn-sm btn-default navbar-btn pull-right" href="<?= Url::toRoute('site/flush-cache') ?>">Flush Cache</a>
    <?php NavBar::end(); ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php 
    	foreach (['success', 'info', 'warning', 'danger'] as $key) {
      		if(!empty($msg = \Yii::$app->session->getFlash($key))) {
      			echo "
    			<div class='alert alert-$key alert-dismissible' role='alert'style='margin: 5px;'>
      				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      				$msg
      			</div>";
      		}
    	}
        ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; nefya.com <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
