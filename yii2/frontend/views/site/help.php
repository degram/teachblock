<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
$this->title = 'Помощь';
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\captcha\Captcha;
?>
<div class="container-fluid">
	<h3 class="title-w3 mb-5 text-center font-weight-bold">FAQ - Часто Задаваемые Вопросы</h3>
	<div class="row">
		<div class="col-sm-12 col-md-3 col-lg-3">
			<nav class="navbar bg-light">

			  <!-- Links -->
			  <ul class="navbar-nav">
				<li class="nav-item">
				  <a class="nav-link" href="#">Создание сайта</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="#">Язык JavaScript</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="#">Изучение JavaScript</a>
				</li>
			  </ul>

		</div>
		<div class="col-sm-12 col-md-8 col-lg-8">
			<div class="main">
				<h2>Правда ли, что создавать сайты может каждый?</h2>
			  <div class="answer">
				<p>Конечно, правда! Единственное, что для этого нужно: большое желание, немного терпения и настойчивости!</p>
			  </div>
			  <h2>Может ли язык JavaScript сделать веб-страницы особенными?</h2>
			  <div class="answer">
				<p>Да, конечно, может! Из скучных статических страниц Ваши страницы превратятся в интерактивные и будут взаимодействовать с пользователем очень активно.</p>
			  </div>
			  <h2>Действительно ли так необходимо изучать JavaScript?</h2>
			  <div class="answer">
				<p>Если Вам хочется, чтобы Ваш веб-сайт отличался удобством, интерактивностью и пользователи с удовольствием проводили на нем время, то JavaScript будет как нельзя кстати!</p>
			  </div>
			</div>
			<div class="polls">
				<?php $form = ActiveForm::begin(['id' => 'contact-form', 'method' => 'POST', 'options' => ['enctype' => 'multipart/form-data']]); ?>
				
				<?= $form->field($model, 'name') ?>
				<?= $form->field($model, 'email') ?>
		   
				<?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
				<?= $form->field($model, 'reCaptcha', ['template' => '{input}'])->widget(
					\himiklab\yii2\recaptcha\ReCaptcha::className(), [
					'siteKey' => '6Ld_18AUAAAAAEqxaw3a258njKB7EHavOFqqCdF9',
					//['widgetOptions'=>['class'=>'pull-right']]
				]) ?>
				<div class="form-group">
					<?= Html::submitButton('Отправить сообщение', ['class' => 'btn btn-default btn-help', 'name' => 'contact-button']) ?>
				</div>
				
				<?php ActiveForm::end(); ?>
            </div> 
		</div>
	</div>
</div>

