<?php
use yii\bootstrap\Html;
?>

<div class="container-fluid beer-container">
	<div class="col-sm-2">

		<?= Html::img($model['labels']['icon'], ['class' => 'beer-image']); ?>
	</div>
	<div class="col-sm-10">
		<strong><?= $model['name'] ?></strong>
		<p>
			<?php 
			$description = $model['description'];
			if(strlen($description) > 250) {
                $pos = strpos($description, ' ', 250);
			 $description = substr($description, 0, $pos)."...";
			}
            echo $description;
            ?>
		</p>
	</div>
</div>