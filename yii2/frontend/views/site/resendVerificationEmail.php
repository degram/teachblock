<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Отправить письмо с подтверждением';
?>
<div class="site-resend-verification-email">
    <div class="row">
        <div class="col-lg-5 mx-auto">
			<h1><?= Html::encode($this->title) ?></h1>

			<p>Введите вашу электронную почту. Ссылка на подтверждение появится в сообщении.</p>
            <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
