<?php
use yii\grid\GridView;
use \common\models\Product;
use \common\models\StatusOrder;
?>
<div class='container'>
<h3>Список заказов</h3>
</div>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-condensed',
    ],
	'summary'=>false,
    'columns' => [
		'initials',
		[
			'label' => 'Номер телефона',
			'value' => function($data)
			{
				return $data->phone;
			},
			'format' => 'raw',
		],
		'full_price',
		[
			'label' => 'Время доставки',
			'value' => function($data)
			{
				return date('d-m-Y H:i',$data->delivery_date);
			},
			'format' => 'raw',
		],
		[
			'label' => 'Способ доставки',
			'value' => function($data)
			{
				$delivery_methods = ['Доставка','Самовывоз'];
				return $delivery_methods[$data->delivery_method];
			},
			'format' => 'raw',
		],
		[
			'label' => 'Статус',
			'value' => function($data)
			{
				return StatusOrder::getNameStatus($data->status);
			},
			'format' => 'raw',
		],
		[
			'label' => 'Управление',
			'value' => function($data)
			{
				return "
					<a href='/backend/web/orders/update?id={$data->id}' class='btn btn-info glyphicon glyphicon-pencil'></a>
					<a href='/backend/web/orders/delete?id={$data->id}' class='btn btn-danger glyphicon glyphicon-remove' onClick='return confirm(\"Удалить заказ?\") ? true : false;'></a>
				";
			},
			'format' => 'raw',
		],
    ],
]);
?>