<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;
use yii\grid\GridView;
use \common\models\Product;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="corres-form">
	

  
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
		<div class="panel panel-default">
		  <div class="panel-heading"><h3>Основные данные заказа</h3></div>
		  <div class="panel-body">
				<div class='col-md-12'>
					<div class='col-md-4'>
						<div class='col-md-12'>
							<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
						</div>
						<div class='col-md-12'>
							<?= $form->field($model, 'delivery_method')->dropDownList(['Доставка','Самовывоз']) ?>
						</div>
					</div>
					<div class='col-md-4'>
						<div class='col-md-12'>
							<?= $form->field($model, 'initials')->textInput(['maxlength' => true]) ?>
						</div>
						<div class='col-md-12'>
							<?= $form->field($model, 'payment_method')->dropDownList(['Предоплата онлайн','Безналичный расчет']) ?>
						</div>
					</div>
					<div class='col-md-4'>
						<div class='col-md-12'>
							<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
						</div>
						<div class='col-md-12'>
							<?= $form->field($model, 'status')->dropDownList($model_status_order->getStatusList_Array(),['prompt' => 'Выберите статус...']) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<?php if($dataProvider): ?>	
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Товары к заказу</h3></div>
				<div class="panel-body">
					<?=GridView::widget([
						'dataProvider' => $dataProvider,
						'tableOptions' => [
							'class' => 'table table-condensed',
							
						],
						'summary' => false,
						'columns' => [
							[
								'label' => 'Название товара',
								'value' => function($data)
								{
									$product = Product::getProductObject($data->id_product);
									return "<a href='/{$product->url}' target='_blank'>{$product->name}</a>";
								},
								'format' => 'raw',
							],
							[
								'label' => 'Количество',
								'value' => function($data)
								{
								return "<input type='number' style='text-align: center;' name='Amount[{$data->id}]' min='1' value='{$data->amount}'>";
								},
								'format' => 'raw',
							],
							'once_price',
							'price',
							[
							'label' => 'Управление',
							'value' => function($data) use ($id_order)
							{
								return "
									<a href='/backend/web/baskets/delete?id={$data->id}&id_order={$id_order}' class='btn btn-danger glyphicon glyphicon-remove' onClick='return confirm(\"Удалить товар из заказа?\") ? true : false;'></a>
								";
							},
							'format' => 'raw',
						],
						],
					]);?>
				</div>
			</div>
		<?php endif; ?>	
		<div class='col-md-12'>
			<div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
		</div>
    <?php ActiveForm::end(); ?>
</div>