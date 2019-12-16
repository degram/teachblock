<?php
use yii\grid\GridView;
echo GridView::widget([
    'dataProvider' => $id_order,
    'tableOptions' => [
        'class' => 'table table-condensed',
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id_order',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>