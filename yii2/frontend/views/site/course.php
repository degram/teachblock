<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use lesha724\youtubewidget\Youtube;
$this->title = $single_course->name;
use common\models\UploadFile;
use common\models\UploadAudio;
use common\models\Lesson;
use yii\widgets\ActiveForm;
use common\models\UploadPract;

$lections = Lesson::find(['id_course' => $single_course])->select('lect')->distinct()->all();
?>
<div class="blog-masthead">
	<h3 class="title-w3 mb-5 text-center font-weight-bold"><?=$single_course->name?></h3>
    <div class="container-fluid">
		<div class="row">
			<!--<div class="flex-col-3">
				<div class="course-sidebar">
					<div class="block-tools">
						<div class="draggable-lect block-tool lect ui-draggable">
							<p>Лекционный материал</p>
						</div>
						<div class="draggable-video block-tool video ui-draggable">
							<p>Видео материалы</p>
						</div>
						<div class="draggable-audio block-tool audio ui-draggable">
							<p>Аудио материалы</p>
						</div>
						<div class="draggable-pract block-tool pract ui-draggable">
							<p>Практические задания</p>
						</div>
						
					</div>
				</div>
			</div>-->
				<div class="col-md-10 mx-auto">
					<div class="row lesson-main text-center droppable-lect">
						<div class="col-12 lessonBlock block-lect">
							<div class="row mx-auto ">
							<div class="col-md-12">
							<?php $form = ActiveForm::begin([
								'options' => ['enctype' => 'multipart/form-data'],
							]); ?>

								<?= $form->field($model, 'docFile')->fileInput()->label(false) ?>

								<button>Загрузить</button>

							<?php ActiveForm::end() ?>
							</div>
							</div>
							<div class="row mx-auto">
							<div class="col-md-12 uploadedfiles">
								<?php foreach($lections as $lection): $i++;
								if($i<5):?>
									<p>
									<a href="files/<?=$lection->lect?>"><?=$lection->lect?></a>
									</p>
								<?php endif; ?>  
								<?php endforeach; ?>
							</div>
							</div>
						</div>
						<div class=" row add-button-lect mx-auto">
							<img class="add-lect mx-auto" src="/images/add.png" alt="add-button" style="min-width: 1em; max-width: 3em; cursor: pointer;">
						</div>
					</div>
					
					<div class="row lesson-main text-center droppable-video">
						<div class="col-12 lessonBlock block-video">
						<div class="col-10 mx-auto">
						<?= Youtube::widget([
						'video'=>'https://www.youtube.com/watch?v=kV8z8wMVydc',
						/*
							or you can use
							'video'=>'CP2vruvuEQY',
						*/
						'iframeOptions'=>[ /*for container iframe*/
							'class'=>'youtube-video'
						],
						'divOptions'=>[ /*for container div*/
							'class'=>'youtube-video-div'
						],
						'height'=>390,
						'width'=>640,
						'playerVars'=>[
							/*https://developers.google.com/youtube/player_parameters?playerVersion=HTML5&hl=ru#playerapiid*/
							/*	Значения: 0, 1 или 2. Значение по умолчанию: 1. Этот параметр определяет, будут ли отображаться элементы управления проигрывателем. При встраивании IFrame с загрузкой проигрывателя Flash он также определяет, когда элементы управления отображаются в проигрывателе и когда загружается проигрыватель:*/
							'controls' => 1,
							/*Значения: 0 или 1. Значение по умолчанию: 0. Определяет, начинается ли воспроизведение исходного видео сразу после загрузки проигрывателя.*/
							'autoplay' => 0,
							/*Значения: 0 или 1. Значение по умолчанию: 1. При значении 0 проигрыватель перед началом воспроизведения не выводит информацию о видео, такую как название и автор видео.*/
							'showinfo' => 0,
							/*Значение: положительное целое число. Если этот параметр определен, то проигрыватель начинает воспроизведение видео с указанной секунды. Обратите внимание, что, как и для функции seekTo, проигрыватель начинает воспроизведение с ключевого кадра, ближайшего к указанному значению. Это означает, что в некоторых случаях воспроизведение начнется в момент, предшествующий заданному времени (обычно не более чем на 2 секунды).*/
							'start'   => 0,
							/*Значение: положительное целое число. Этот параметр определяет время, измеряемое в секундах от начала видео, когда проигрыватель должен остановить воспроизведение видео. Обратите внимание на то, что время измеряется с начала видео, а не со значения параметра start или startSeconds, который используется в YouTube Player API для загрузки видео или его добавления в очередь воспроизведения.*/
							'end' => 0,
							/*Значения: 0 или 1. Значение по умолчанию: 0. Если значение равно 1, то одиночный проигрыватель будет воспроизводить видео по кругу, в бесконечном цикле. Проигрыватель плейлистов (или пользовательский проигрыватель) воспроизводит по кругу содержимое плейлиста.*/
							'loop ' => 0,
							/*тот параметр позволяет использовать проигрыватель YouTube, в котором не отображается логотип YouTube. Установите значение 1, чтобы логотип YouTube не отображался на панели управления. Небольшая текстовая метка YouTube будет отображаться в правом верхнем углу при наведении курсора на проигрыватель во время паузы*/
							'modestbranding'=>  1,
							/*Значения: 0 или 1. Значение по умолчанию 1 отображает кнопку полноэкранного режима. Значение 0 скрывает кнопку полноэкранного режима.*/
							'fs'=>0,
							/*Значения: 0 или 1. Значение по умолчанию: 1. Этот параметр определяет, будут ли воспроизводиться похожие видео после завершения показа исходного видео.*/
							'rel'=>1,
							/*Значения: 0 или 1. Значение по умолчанию: 0. Значение 1 отключает клавиши управления проигрывателем. Предусмотрены следующие клавиши управления.
								Пробел: воспроизведение/пауза
								Стрелка влево: вернуться на 10% в текущем видео
								Стрелка вправо: перейти на 10% вперед в текущем видео
								Стрелка вверх: увеличить громкость
								Стрелка вниз: уменьшить громкость
							*/
							'disablekb'=>0
						],
						'events'=>[
							/*https://developers.google.com/youtube/iframe_api_reference?hl=ru*/
							'onReady'=> 'function (event){
										/*The API will call this function when the video player is ready*/
										event.target.playVideo();
							}',
						]
						]); ?>
						</div>
						</div>
						<div class=" add-button-video mx-auto">
							<img class="add-video" src="/images/add.png" alt="add-button" style="min-width: 1em; max-width: 3em; cursor: pointer;">
						</div>
					</div>
					
					<div class="row lesson-main text-center droppable-audio">
						<div class="col-12 lessonBlock block-audio">
							<div class="row mx-auto ">
							<div class="col-md-12">
							<?php $form = ActiveForm::begin([
								'options' => ['enctype' => 'multipart/form-data'],
							]); ?>

								<?= $form->field($audio, 'audioFile')->fileInput()->label(false) ?>

								<button>Загрузить</button>

							<?php ActiveForm::end() ?>
							</div>
							</div>
							<div class="row mx-auto">
							<div class="col-md-12 uploadedfiles">
								<?php foreach($lections as $lection): $i++;
								if($i<5):?>
									<p>
									<a href="files/<?=$lection->lect?>"><?=$lection->lect?></a>
									</p>
								<?php endif; ?>  
								<?php endforeach; ?>
							</div>
							</div>
						</div>
						<div class=" add-button-audio mx-auto">
							<img class="add-audio" src="/images/add.png" alt="add-button" style="min-width: 1em; max-width: 3em; cursor: pointer;">
						</div>
					</div>
					<div class="row lesson-main text-center droppable-pract">
						<div class="col-12 lessonBlock block-pract">
							<div class="row mx-auto ">
							<div class="col-md-12">
							<?php $form = ActiveForm::begin([
								'options' => ['enctype' => 'multipart/form-data'],
							]); ?>

								<?= $form->field($model, 'docFile')->fileInput()->label(false) ?>

								<button>Загрузить</button>

							<?php ActiveForm::end() ?>
							</div>
							</div>
							<div class="row mx-auto">
							<div class="col-md-12 uploadedfiles">
								<?php foreach($lections as $lection): $i++;
								if($i<5):?>
									<p>
									<a href="files/<?=$lection->lect?>"><?=$lection->lect?></a>
									</p>
								<?php endif; ?>  
								<?php endforeach; ?>
							</div>
							</div>
						</div>
						<div class=" add-button-pract mx-auto">
							<img class="add-pract" src="/images/add.png" alt="add-button" style="min-width: 1em; max-width: 3em; cursor: pointer;">
						</div>
					</div>
				</div>  
		</div><!-- /.row -->

    </div><!-- /.container -->
</div>