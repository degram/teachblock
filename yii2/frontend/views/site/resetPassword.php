<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Смена пароля';
?>
<div class="site-reset-password">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 mx-auto">
				<h1><?= Html::encode($this->title) ?></h1>

				<p>Введите новый пароль:</p>
				<?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

					<?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label('Пароль') ?>

					<div class="form-group">
						<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
					</div>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>
