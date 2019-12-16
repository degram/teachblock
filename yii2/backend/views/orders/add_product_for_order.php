<?php
use yii\grid\GridView;
?>
<div class='container'>
<h4>Добавить товар к заказу №<?=$id_order?></h4>
	<div class='col-md-12'>
		<div class='col-md-3'>
			<a href='/backend/web/orders/update?id=<?=$id_order?>' class='btn btn-success'>Вернуться назад</a>
		</div>
		<div class='col-md-9'>
			<?=$this->render('_form_search',['model'=>$model]);?>
		</div>
	</div>
</div>
<?php if($dataProvider): ?>
	<?=GridView::widget([
		'dataProvider' => $dataProvider,
		'tableOptions' => [
			'class' => 'table table-condensed',
		],
		'summary'=>false,
		'columns' => [
			
			[
				'label' => 'Название товара',
				'value' => function($data)
				{
					return "<a href='/{$data->url}'>{$data->name}</a>";
				},
				'format' => 'raw',
			],
			[
				'label' => 'Изображение',
				'value' => function($data)
				{
					return "<img src='/frontend/web/uploads/items/{$data->image}' width='50px'>";
				},
				'format' => 'raw',
			],
			'price',
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
				'value' => function($data) use ($id_order)
				{
					return "
						<a href='/backend/web/baskets/add_product_basket?id={$data->id}&id_order={$id_order}' onClick='return confirm(\"Добавить товар [{$data->name}] к заказу №{$id_order}?\") ? true : false;' class='btn btn-danger glyphicon glyphicon-pushpin'></a>
					";
				},
				'format' => 'raw',
			],
		],
	]);
	?>
<?php else: ?>
	<?php if($post): ?>
		По результатам поиска ничего не найдено!
	<?php endif; ?>
<?php endif; ?>	