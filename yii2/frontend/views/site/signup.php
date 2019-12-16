<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
?>
<div class="site-signup">
	<div class="container">
		<div class="row">	
			<div class="col-md-offset-3 col-md-6 text-center">
			<h1><?= Html::encode($this->title) ?></h1>
			<p>Пожалуйста, заполните все поля регистрации:</p>
			
				<?php $form = ActiveForm::begin([
				'id' => 'form-input-example',
				'options' => [
					'class' => 'form-horizontal col-lg-12',
					'enctype' => 'multipart/form-data'],
				]); 
				?>
					
					<?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Логин *') ?>
					
					<?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Имя *') ?>
					
					<?= $form->field($model, 'surname')->textInput(['autofocus' => true])->label('Фамилия *') ?>

					<?= $form->field($model, 'email')->label('Почта *') ?>

					<?= $form->field($model, 'password')->passwordInput()->label('Пароль *') ?>

					<div class="form-group">
						<?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
					</div>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>
