<?php
use yii\grid\GridView;
?>
<div class='container'>
<h4>Список товаров</h4>
<a href='/backend/web/category/create' class='btn btn-success'>Создать категорию</a>
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
				return "<a href='/backend/web/category/list_product?id_category={$data->id}'>{$data->name}</a>";
			},
			'format' => 'raw',
		],
		'sort',
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
					<a href='/backend/web/category/update?id={$data->id}' class='btn btn-info glyphicon glyphicon-pencil'></a>
					<a href='/backend/web/category/delete?id={$data->id}' class='btn btn-danger glyphicon glyphicon-remove' onClick='return confirm(\"Удалить товар?\") ? true : false;'></a>
				";
			},
			'format' => 'raw',
		],
    ],
]);
?>