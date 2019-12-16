<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use common\models\UploadImage;
use common\models\Course;
$this->title = 'Добавление нового курса';
?>
<div class="site-login">
	<div class="container">
		<div class="row">
			<div class='col-md-12'>
				<div class='col-md-6'>
					<h1><?= Html::encode($this->title) ?></h1>
				
					<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
					<div class='col-md-12'>
					<?= $form->field($model, 'name')->textInput()->label('Название курса') ?>
					</div>
					<div class='col-md-12'>
					<?= $form->field($model, 'little_name')->textInput()->label('Краткое имя курса') ?>
					</div>
					<div class='col-md-12'>
					<?= $form->field($model, 'id_user')->dropDownList(
					\yii\helpers\ArrayHelper::map(common\models\User::find()->where(['role' => '2'])->all(), 'id', 'username'))->label('Создатель курса') 
					?>
					</div>
					<div class='col-md-12'>
					<?= $form->field($model, 'class')->textInput()->label('Номер группы/класса') ?>
					</div>
					<div class='col-md-6'>
						<?=$form->field($model, 'images')->fileInput()->label('Изображение') ?>
					</div>
					<div class='col-md-6'>
					<?= $form->field($model, 'active')->checkbox()->label('Показывать курс') ?>
					</div>
					<div class='col-md-12'>
					<?= $form->field($model, 'password')->passwordInput()->label('Пароль курса') ?>
					</div>
					<div class='col-md-12'>
					<?= $form->field($model, 'little_text')->textArea(['rows' => 4]) ?>
					</div>
					<div class="form-group">
						<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					</div>
				</div>
			</div>
		</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>
