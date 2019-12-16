<?php
use yii\grid\GridView;
use common\models\Post;
?>
<div class='container'>
<h4>Список новостей</h4>
	<div class='col-md-12'>
		<div class='col-md-3'>
			<a href='/action/create' class='btn btn-success'>Создать новость</a>
		</div>
	</div>
</div>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-condensed',
    ],
    'columns' => [

		'id',
		[
			'label' => 'Изображение',
			'value' => function($post)
			{
				return "<img src='/{$post->image}' width='80px'>";
			},
			'format' => 'raw',
		],
		[
			'label' => 'Активность',
			'value' => function($post)
			{
				$active = ['Не активно','Активно'];
				if($post->active==0)
				{
					return "<span class='label label-danger'>Не активно</span>";
				}
				if($post->active==1)
				{
					return "<span class='label label-success'>Активно</span>";
				}
			},
			'format' => 'raw',
		],
		[
			'label' => 'Управление',
			'value' => function($post)
			{
				return "
					<a href='/action/update?id={$post->id}' class='btn btn-info glyphicon glyphicon-pencil'></a>
					<a href='/action/delete?id={$post->id}' class='btn btn-danger glyphicon glyphicon-remove' onClick='return confirm(\"Удалить акцию?\") ? true : false;'></a>
				";
			},
			'format' => 'raw',
		],
    ],
]);
?>