<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
    <a href="/backend/web/orders" class="btn btn-success">К списку заказов</a>
<?php
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id_order',
        'id_basket',
        'price',
        'quantity'
    ],
]);

?>
