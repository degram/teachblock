<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
	<div class="container-fluid">
		<div class="row">
			<div class=" text-center col-md-offset-3 col-md-6">

			<h1><?= Html::encode($this->title) ?></h1>

			<img src="/images/error.jpg" alt="error" class="img-fluid error">

			<p>
				Страница не найдена. Но вы всегда можете вернуться на главную.
			</p>
			<div class="error mx-auto">
			<?= Html::a('Главная', ['/site/index'], ['class'=>'btn_error']) ?> 
			</div>
			</div>
		</div>
	</div>
</div>
