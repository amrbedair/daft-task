<?php 
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
?>
<div class="container-fluid beer-container">
	<div class="col-sm-3">
		<strong><?= $beer['name'] ?></strong>
		<?= Html::img($beer['labels']['medium'], ['class' => 'beer-image']); ?>
		<?php if(isset($beer['breweries'])) : ?>
		<strong>Breweries:</strong>
		<?php 
            $breweries = [];
		    foreach ($beer['breweries'] as $brewery) { $breweries[] = $brewery['name']; }
		    echo implode(', ', $breweries);
        ?>
        <?php endif; ?>
	</div>
	<div class="col-sm-6">
		<?= $beer['description'] ?>
	</div>
	<div class="col-sm-3">
		
		<?= Html::a('Another Beer', Url::to(['site/index']), ['class' => 'btn btn-lg btn-primary btn-block']); ?>
		
		<?php if(isset($beer['breweries'])) : ?>
		<div class="btn-group" style="margin-top: 15px; width: 100%">
  			<button type="button" class="btn btn-lg btn-primary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    			More From <span class="caret"></span>
  			</button>
  			<ul class="dropdown-menu dropdown-menu-right">
    			<?php foreach ($beer['breweries'] as $brewery) : ?>
    			<li><a href="#" class="lnk-more" data-brewery-id="<?= $brewery['id'] ?>"><?= $brewery['name'] ?></a></li>
    			<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		
	</div>
	<?php if(false) : ?>
	<div class="col-sm-12">
		<pre><?php echo VarDumper::dump($beer); ?></pre>
	</div>
	<?php endif; ?>
</div>