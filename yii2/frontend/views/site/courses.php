<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
$this->title = 'Список курсов';
use common\models\Course;
use common\models\User;

$courses = Course::find()->where(['id_user' => Yii::$app->user->id])->all();
$user = User::find()->where(['id' => Yii::$app->user->id, 'role' => '2'])->one();
?>

<div class="courses-masthead">
    <div class="container-fluid">
      <h3 class="title-w3 mb-5 text-center font-weight-bold">Список курсов</h3>
	  <?php if(!empty($course_list)): ?>
	  <?php if(!empty($user)): ?>
	  <div class="row">
		<div class="col-md-3 col-md-offset-10">
			<div class="change-button" style="margin-bottom: 1em;">
				<?= Html::a('Добавить новый курс', ['/site/create'], ['class'=>'btn btn-primary']) ?> 
			</div>
		</div>
	  </div>
	  <?php endif; ?>
	  <?php endif; ?>
	  <div class="row">	  
        <div class="col-12">
			<table class="table table-hover table-striped table-course">
                <tbody>
				<?php if(!empty($course_list)): ?>
				<?php foreach($course_list as $course): 
				$user = User::find()->where(['id' => $course->id_user])->one();?>			
                    <tr onclick="window.location.href='<?=yii\helpers\Url::to(['site/course', 'id' => $course->id])?>'; return false">
                        <td>
							<div class="col-sm-4">
								<img src="<?=$course->image?>" alt="course1" class="course-img img-rounded">
								<div class="progress">
								  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" 
								  style="width: <?=$course->progress?>%" aria-valuenow="<?=$course->progress?>" 
								  aria-valuemin="0" aria-valuemax="100"><?=$course->progress?>%</div>
								</div>
							</div>
							<div class="col-sm-7 course-main">
								<h3 class="font-weight-bold"><?=$course->name?></h3>
								<p><?=$user->name?> <?=$user->surname?></p>
								<p><?=$course->little_text?></p>
							</div>
                        </td>
                    </tr>
                <?php endforeach; ?>
				<?php endif; ?>
            </table>
        </div>
		<div class="mx-auto text-center">
				<?= \yii\widgets\LinkPager::widget(['pagination' => $pages])?>
		</div>
		<?php if(empty($course_list)): ?>
		<div class=" text-center col-md-offset-3 col-md-6">	
			<img src="/images/question.jpg" alt="error" class="img-fluid">
			<p>Список курсов пуст. Добавьте нужные курсы для продолжения.</p>
			<?php if(!empty($user)): ?>
			<div class="error mx-auto">
			<?= Html::a('Создать курс', ['/site/create'], ['class'=>'btn_error']) ?> 
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
        </div><!-- /.blog-main -->
		
      </div><!-- /.row -->

    </div><!-- /.container -->

