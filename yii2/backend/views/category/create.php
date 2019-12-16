<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Corres */

$this->title = 'Создания категории';
$this->params['breadcrumbs'][] = ['label' => 'Список категорий', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corres-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
