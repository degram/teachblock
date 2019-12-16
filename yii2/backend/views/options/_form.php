<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="corres-form">
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
		<div class='col-md-12'>
			<div class='col-md-6'>
				<div class='col-md-12'>
					<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
				</div>
				<div class='col-md-4'>
					<?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
				</div>
				<div class='col-md-4'>
					<?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
				</div>
				<div class='col-md-4'>
				<?= $form->field($model, 'active')->checkbox() ?>
			</div>
			</div>
			<div class='col-md-6'>
				<div class='col-md-8'>
					<?=$this->render('_get_category',['category_list'=>$category_list,'model'=>$model,'category_list_active'=>$category_list_active]);?>
				</div>
			</div>
		</div>
		<div class='col-md-12'>
			<div class='col-md-3'>
				<?= $form->field($model, 'image_file')->fileInput([]) ?>
			</div>
		</div>
		<div class='col-md-12'>
			<label class="control-label">Описание товара</label>
			<?php echo \mihaildev\ckeditor\CKEditor::widget(['model' => $model, 'attribute' => 'description', 'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions(['elfinder', 'path' => '/'], ['preset' => 'standart', 'allowedContent' => true, 'height' => '200px'])]); ?>
		</div>
		<div class='col-md-12'>
			<label class="control-label">Состав</label>
			<?php echo \mihaildev\ckeditor\CKEditor::widget(['model' => $model, 'attribute' => 'consist', 'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions(['elfinder', 'path' => '/'], ['preset' => 'standart', 'allowedContent' => true, 'height' => '200px'])]); ?><p/>
		</div>
		<div class='col-md-12'>
			<div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
		</div>
    <?php ActiveForm::end(); ?>
</div>
