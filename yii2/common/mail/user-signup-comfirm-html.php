<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \common\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/signup-confirm', 'token' => $user->email_confirm_token]);
?>
<div class="verify-email">
    <p>Доброго времени суток <?= Html::encode($user->username) ?>,</p>

    <p>Перейдите по ссылке, чтоб подтвердить элетронную почту:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>
