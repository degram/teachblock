<?php
use yii\grid\GridView;
?>
<div class='container'>
<h4>Способ оплаты</h4>
<a href='/backend/web/payment/create' class='btn btn-success'>Создать</a>
</div>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-condensed',
    ],
    'columns' => [
		[
			'label' => 'Название',
			'value' => function($data)
			{
				return $data->name;
			},
			'format' => 'raw',
		],
		[
			'label' => 'Активность',
			'value' => function($data)
			{
				$active = ['Не активно','Активно'];
				if($data->active==0)
				{
					return "<span class='label label-danger'>Не активно</span>";
				}
				if($data->active==1)
				{
					return "<span class='label label-success'>Активно</span>";
				}
			},
			'format' => 'raw',
		],
		[
			'label' => 'Управление',
			'value' => function($data)
			{
				return "
					<a href='/backend/web/payment/update?id={$data->id}' class='btn btn-info glyphicon glyphicon-pencil'></a>
					<a href='/backend/web/payment/delete?id={$data->id}' class='btn btn-danger glyphicon glyphicon-remove' onClick='return confirm(\"Удалить метод оплаты?\") ? true : false;'></a>
				";
			},
			'format' => 'raw',
		],
    ],
]);
?>