<?php
use yii\grid\GridView;
?>
<div class='container'>
<h4>Список товаров</h4>
	<div class='col-md-12'>
		<div class='col-md-3'>
			<a href='/backend/web/product/create' class='btn btn-success'>Создать товар</a>
		</div>
		<div class='col-md-9'>
			<?=$this->render('_form_search',['model'=>$model]);?>
		</div>
	</div>
</div>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-condensed',
    ],
    'columns' => [
        
		[
			'label' => 'Название товара',
			'value' => function($data)
			{
				return "<a href='/product/{$data->url}' target='_blank'>{$data->name}</a>";
			},
			'format' => 'raw',
		],
		'price',
		[
			'label' => 'Изображение',
			'value' => function($data)
			{
				return "<img src='/frontend/web/uploads/items/{$data->image}' width='50px'>";
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
					<a href='/backend/web/product/update?id={$data->id}' class='btn btn-info glyphicon glyphicon-pencil'></a>
					<a href='/backend/web/product/delete?id={$data->id}' class='btn btn-danger glyphicon glyphicon-remove' onClick='return confirm(\"Удалить товар?\") ? true : false;'></a>
				";
			},
			'format' => 'raw',
		],
    ],
]);
?>