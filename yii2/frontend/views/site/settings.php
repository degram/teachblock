<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Настройки';
use common\models\Course;
?>

<div class="tab-pane" id="edit">
	<div class="container py-xl-5 py-lg-3">
                    <h3 class="title-w3 mb-5 text-center font-weight-bold">Настройки профиля</h3>
                    <?php $form = ActiveForm::begin(); ?>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Должность</label>
                            <div class="col-lg-9">
                                <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Город</label>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $form->field($model, 'school')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
								<div class="form-group">
									<input type="reset" class="btn btn-secondary" value="Завершить">
									<?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-success']) ?>
								</div>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
</div>
