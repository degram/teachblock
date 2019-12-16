<?php 
use \backend\web\SearchProduct;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	<div class='col-md-8'>
		<?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'Поиск'])->label(false); ?>
	</div>
	<div class='col-md-4'>
		<?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
	</div>
<?php ActiveForm::end(); ?>