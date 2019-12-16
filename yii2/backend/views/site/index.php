<?php
use yii\helpers\Html;
$this->title = 'Панель администратора';
use backend\models\AuthAssignment;
?>

<div class="container-cont">
	<div class="alert alert-success"><strong>Добро пожаловать в Панель администратора</strong></div>
	<div class="jumbotron">
		<div class="row" style="text-align:center;">
			<div class="col-xs-12">
				<div class="col-xs-2">
					<?= Html::a(Html::img('images/menu/check-list.png') . '<div>Таблица пользователей</div>', ['/user/index'], ['class' => 'block_menu']) ?>
				</div>
				<div class="col-xs-2">
					<?= Html::a(Html::img('images/menu/documento.png') . '<div>Добавить новость</div>', ['/action/index'], ['class' => 'block_menu']) ?>
				</div>
				<div class="col-xs-2">
					<?= Html::a(Html::img('images/menu/carpeta.png') . '<div>Редактирование курсов</div>', ['/category/index'], ['class' => 'block_menu']) ?>
				</div>
			</div>
		</div>
	</div>
</div>
