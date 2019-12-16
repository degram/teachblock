<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Actions */

$this->title = 'Создание новости';
$this->params['breadcrumbs'][] = ['label' => 'Список акций', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corres-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
