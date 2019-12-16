<?php
use yii\helpers\Html;
use common\models\Notification;
use frontend\components\Notifications;
use frontend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\User_data;
 
AppAsset::register($this);
$stats_notif = 0;
$notif = Notification::find()->where(['id_user' => '1', 'active' => 1])->all();
foreach($notif as $user_notif)
{
	$stats_notif++;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
	<?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/ico', 'href' => '/images/favicon.ico']);?>
</head> 
<body>
<?php $this->beginBody() ?>

	<?php
		
		NavBar::begin([
			'options' => [
				'class' => 'nav navbar-fixed-top navbar-default navbar-expand-md',
			],
			'brandLabel' => Html::img('/images/logo.png', ['alt' => Yii::$app->name]),
			'brandUrl' => Yii::$app->homeUrl,
		]);
		if (Yii::$app->user->isGuest) {
		$menuItems[] = ['label' => 'Главная', 'url' => ['/site/index']];
        $menuItems[] = ['label' => 'Новости', 'url' => ['/site/news']];
        $menuItems[] = ['label' => 'Помощь', 'url' => ['/site/help']];
        $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
		} 
		else {
			$menuItems[] = ['label' => 'Мои курсы', 'url' => ['/site/courses']];
			$menuItems[] = ['label' => 'Новости', 'url' => ['/site/news']];
			$menuItems[] = ['label' => 'Помощь', 'url' => ['/site/help']];
			$menuItems[] = ['label' =>  Html::img($user_data->image) . Yii::$app->user->identity->username, 'items' => [
				['label' => 'Мой аккаунт', 'url' => ['/site/account']],
				['label' => 'Настройки', 'url' => ['/site/settings']],
			],
			'encode' => false
			];
			$menuItems[] = ['label' => Html::img('images/bell.png'). '<b>' .$stats_notif . '</b>','encode' => false];
			
			$menuItems[] = '<li>'
				. Html::beginForm(['/site/logout'], 'post')
				. Html::submitButton('Выйти', ['class' => 'btn btn-link logout'])
				. Html::endForm()
				. '</li>';
		}
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav ml-auto'],
			'items' => $menuItems
		]);
		NavBar::end();
	?>
	<div class="container">
    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
    <?= Alert::widget() ?>
	</div>
    <?= $content ?>
    
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>