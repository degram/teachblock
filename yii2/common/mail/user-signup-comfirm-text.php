<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \common\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/signup-confirm', 'token' => $user->email_confirm_token]);
?>
Доброго времени суток <?= $user->username ?>,

Перейдите по ссылке, чтоб подтвердить элетронную почту:

<?= $confirmLink ?>