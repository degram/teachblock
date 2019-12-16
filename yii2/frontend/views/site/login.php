<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Вход';
?>
<div class="site-login">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-3 col-md-6  text-center">
			
			<h1><?= Html::encode($this->title) ?></h1>

			<p>Заполните все поля для входа:</p>
			
				<?php $form = ActiveForm::begin([
				'id' => 'form-input-example',
				'options' => [
					'class' => 'form-vertical col-lg-12',
					'enctype' => 'multipart/form-data'],
				]); 
				?>

					<?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Логин')  ?>

					<?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

					<?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>

					<div style="color:#555;margin:1.5em 0">
						Если вы забыли текущий пароль у вас есть возможность <?= Html::a('сбросить его', ['site/request-password-reset']) ?>.
						<br>
						Необходимо новое подтверждение почты? <?= Html::a('Отправить', ['site/resend-verification-email']) ?>
					</div>

					<div class="form-group">
						<?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
					</div>

				<?php ActiveForm::end(); ?>
			</div>
			<div class="col_md-offset-2 col-md-2">
					<a href="<?=yii\helpers\Url::to(['/backend/views/site/index'])?> class="btn btn-success btn-lg">Перейти в панель администратора</a>
			</div>
		</div>
	</div>
</div>
