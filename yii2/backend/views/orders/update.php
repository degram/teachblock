<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Corres */

$this->title = "Редактирование заказа №{$model->id} [{$model->full_price} руб.]";
$this->params['breadcrumbs'][] = ['label' => 'Список заказов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<a href="/backend/web/orders/add_product_for_order?id_order=<?=$model->id?>" class='btn btn-success'>Добавить товар к заказу</a>
<div class="corres-update">
    <h2><?= Html::encode($this->title) ?></h2>
    <?= $this->render('_form', [
        'id_order' => $id_order,
        'model' => $model,
        'model_status_order' => $model_status_order,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
