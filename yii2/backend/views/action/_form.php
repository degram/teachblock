<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;
use common\models\User;
use common\models\UploadImage;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="corres-form">
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
		<div class='col-md-12'>
			<div class='col-md-6'>
				<div class='col-md-12'>
					<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
				</div>
				<div class='col-md-12'>
				<?= $form->field($model, 'id_user')->dropDownList(
					\yii\helpers\ArrayHelper::map(common\models\User::find()->where(['role' => '2'])->all(), 'id', 'username')) 
				?>
				</div>
				<div class='col-md-12'>
				<?= $form->field($model, 'id_category')->dropDownList(
					\yii\helpers\ArrayHelper::map(common\models\Category::find()->all(), 'id', 'name')) 
				?>
				</div>
				<div class='col-md-4'>
				<?=$form->field($model, 'image', [
				'inputOptions'=>[
					'class'=>'upload-img mx-auto',
				]
				])->fileInput()->label(false) ?>
				</div>
				<div class='col-md-4'>
				<?= $form->field($model, 'active')->checkbox() ?>
				</div>
			</div>
		</div>
		<div class='col-md-12'>
			<label class="control-label">Краткий текст новости</label>
			<?php echo \mihaildev\ckeditor\CKEditor::widget(['model' => $model, 'attribute' => 'little_text', 'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions(['elfinder', 'path' => '/'], ['preset' => 'standart', 'allowedContent' => true, 'height' => '200px'])]); ?>
		</div>
		<div class='col-md-12'>
			<label class="control-label">Основная часть новости</label>
			<?php echo \mihaildev\ckeditor\CKEditor::widget(['model' => $model, 'attribute' => 'text', 'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions(['elfinder', 'path' => '/'], ['preset' => 'standart', 'allowedContent' => true, 'height' => '200px'])]); ?><p/>
		</div>
		<div class='col-md-12'>
			<div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
		</div>
    <?php ActiveForm::end(); ?>
</div>
