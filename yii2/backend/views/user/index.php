<?php
use yii\grid\GridView;
echo GridView::widget([
    'dataProvider' => $username,
    'tableOptions' => [
        'class' => 'table table-condensed',
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'username',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>