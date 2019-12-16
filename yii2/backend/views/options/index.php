<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>
<div class='container'>
	<h4>Основные настройки сайта</h4>
	<div class="corres-form">
		<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
			<div class='col-md-12'>
				<div class='col-md-3'>
					<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
				</div>
				<div class='col-md-5'>
					<?= $form->field($model, 'time_work')->textInput(['maxlength' => true]) ?>
				</div>
				<div class='col-md-4'>
					<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
				</div>
			</div>
			<div class='col-md-12'>
				<div class='col-md-4'>
					<?= $form->field($model, 'promo')->textInput(['maxlength' => true]) ?>
				</div>
				
				<div class='col-md-4'>
					<?= $form->field($model, 'cor_1')->textInput(['maxlength' => true]) ?>
				</div>
				<div class='col-md-4'>
					<?= $form->field($model, 'cor_2')->textInput(['maxlength' => true]) ?>
				</div>
			</div>
			<div class='col-md-12'>
				<div class='col-md-3'>
					<?= $form->field($model, 'image_file')->fileInput([]) ?>
				</div>
			</div>
			
			<div class='col-md-12'>
				<div class='col-md-12'>
					<?php if($model->image_header!=''): ?>
						<img width="100%" src="/frontend/web/site/<?=$model->image_header?>">
					<?php endif; ?>
				</div>
			</div>
			
			<div class='col-md-12'>
				<div class='col-md-3'>
					<?= $form->field($model, 'image_file_logo')->fileInput([]) ?>
				</div>
			</div>
			
			<div class='col-md-12'>
				<div class='col-md-10'>
					<?php if($model->image_logo!=''): ?>
						<img width="80px" src="/frontend/web/site/<?=$model->image_logo?>">
					<?php endif; ?>
				</div>
			</div>
				
			<div class='col-md-12'>
				<label class="control-label">Основная информация на изображении</label>
				<?php echo \mihaildev\ckeditor\CKEditor::widget(['model' => $model, 'attribute' => 'promo_text', 'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions(['elfinder', 'path' => '/'], ['preset' => 'standart', 'allowedContent' => true, 'height' => '200px'])]); ?>
			</div>
			<div class='col-md-12'>
				<label class="control-label">Информация в нижнем блоке сайта</label>
				<?php echo \mihaildev\ckeditor\CKEditor::widget(['model' => $model, 'attribute' => 'footer_cript', 'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions(['elfinder', 'path' => '/'], ['preset' => 'standart', 'allowedContent' => true, 'height' => '200px'])]); ?><p/>
			</div>
			<div class='col-md-12'>
				<div class="form-group">
					<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>
