<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Доброго времени суток <?= $user->username ?>,

Перейдите по ссылке для сброса пароля:

<?= $resetLink ?>
