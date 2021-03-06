<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Corres */

$this->title = 'Редактирование метода оплаты';
$this->params['breadcrumbs'][] = ['label' => 'Способ оплаты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corres-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'category_list' => $category_list,
        'category_list_active' => $category_list_active,
    ]) ?>

</div>
