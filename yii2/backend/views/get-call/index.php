<?php
use yii\grid\GridView;
?>
<div class='container'>
<h3>Заказ звонка</h3>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-condensed',
    ],
    'columns' => [
        
		'name',
		'phone',
		[
			'label' => 'Время заказа',
			'value' => function($data)
			{
				return date('d-m-Y H:i',$data->time_get_call);
			},
		],
    ],
]);
?>