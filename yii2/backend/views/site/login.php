<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-3 col-md-6 mx-auto text-center">
	
				<h1><?= Html::encode($this->title) ?></h1>

				<p>Заполните все поля для входа:</p>

				<?php $form = ActiveForm::begin([
				'id' => 'form-input-example',
				'options' => [
					'class' => 'form-vertical col-lg-12',
					'enctype' => 'multipart/form-data'],
				]); 
				?>

				<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

				<?= $form->field($model, 'password')->passwordInput() ?>

				<?= $form->field($model, 'rememberMe')->checkbox() ?>

				<div class="form-group">
					<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
				</div>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
    </div>
</div>
