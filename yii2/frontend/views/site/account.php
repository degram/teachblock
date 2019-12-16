<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\models\UploadImage;
use yii\widgets\ActiveForm;
use common\models\User;
use common\models\Course;
use common\models\User_data;
$this->title = 'Мой аккаунт';

$courses = Course::find()->where(['active'=>'1'])->all();
$user_data = User_data::find()->where(['id_user'=>Yii::$app->user->id])->one();
$user = User::find()->where(['id'=>Yii::$app->user->id])->one();

$count_course = 0;
$user_course = Course::find()->where(['id_user'=>Yii::$app->user->id])->all();

foreach($user_course as $course)
{
	$count_course++;
}
?>

<div class="container py-lg-3">
	<h3 class="title-w3 mb-5 text-center font-weight-bold">Мой аккаунт</h3>
    <div class="row m-y-2">
		<div class="col-lg-4 pull-lg-8 text-center">	
			<?php if($user_data->image): ?>
				<img src="<?=$user_data->image?>" class="img-fluid mx-auto img-circle" id="account-img" alt="avatar">
			<?php endif; ?>

            <label class="custom-file">
				<?php $form = ActiveForm::begin([
				'options' => [
					'class' => 'form-upload-img',
				]
				]) ?>
				<?=$form->field($model, 'image', [
				'inputOptions'=>[
					'class'=>'upload-img mx-auto',
				]
				])->fileInput()->label(false) ?>
				<button>Обновить</button>
				<?php ActiveForm::end() ?>
            </label>
        </div>
        <div class="col-lg-8 push-lg-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Профиль</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Сообщения</a>
                </li>
            </ul>
            <div class="tab-content p-b-3">
                <div class="tab-pane active" id="profile">
                    <h4 class="m-y-2"><?=$user->username?></h4>
					<h4 class="m-y-2"><?=$user->name?> <?=$user->surname?></h4>
                    <div class="row">
                        <div class="col-md-6">
							<h5>Город</h5>
							<p> <?=$user_data->city?></p>
                            <h5>Учебное заведение</h5>
                            <p><?=$user_data->school?></p>
							<h5>Должность</h5>
                            <p><?=$user_data->position?></p>
                            <h5>Созданные курсы</h5>
							
							<?php if(!empty($courses)): ?>
							<?php foreach($courses as $course): ?>
								<p>
									<?=$course->name?>
								</p>
							<?php endforeach; ?>
							<?php endif; ?>  
                        </div>
                        <div class="col-md-6">
                            <hr>
                            <span class="tag tag-primary"><i class="fa fa-user"></i> <strong>700 </strong> Подписчиков </span>
                            <span class="tag tag-success"><i class="fa fa-cog"></i> <strong><?=$count_course?></strong> Активных курса </span>
                            <span class="tag tag-danger"><i class="fa fa-eye"></i> <strong>250 </strong> Просмотров </span>
                        </div>
                        <div class="col-md-12">
                            <h4 class="m-t-2"><span class="fa fa-clock-o ion-clock pull-xs-right"></span> Достижения</h4>
                            <table class="table table-hover table-striped">
                                <tbody>                                    
                                    <tr>
                                        <td>
                                            <strong>Цель намечена</strong> проверить 50 заданий в <strong>`Информатика 10 кл.`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Трудоголик</strong> провести 100 часов в <strong>`Математика 11 кл.`</strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Нет времени</strong> проверить 10 тестов за 20 минут в <strong>`Информатика 10 кл.`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>"Информатика 9 кл.</strong> курс был успешно завершен.
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="messages">
                    <h4 class="m-y-2">Сообщения &amp; Уведомления</h4>
                    <div class="alert alert-info alert-dismissable">
                        <a class="panel-close close" data-dismiss="alert">×</a> <strong>1 час назад</strong> Розин А. завершил "Тест 1" и отправил на проверку <strong>в "Информатика 10 кл."</strong>
                    </div>
                    <table class="table table-hover table-striped">
                        <tbody>                                    
                            <tr>
                                <td>
                                   <span class="pull-xs-right font-weight-bold">3 часа назад</span> задание было успешно загружено <strong>в "Математика 11 кл."</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="pull-xs-right font-weight-bold">Вчера</span> время для выполнения "Тест" окончено. Все результаты сохранены.
                                </td>
                            </tr>
                        </tbody> 
                    </table>
                </div>                
            </div>
        </div>
    </div>
</div>
<hr>