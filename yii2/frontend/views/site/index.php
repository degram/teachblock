<?php

/* @var $this yii\web\View */

$this->title = 'Teachblock';
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\bootstrap\ActiveForm;
use common\models\User;
use common\models\Course;
use common\models\Post;
?>

<?php
$stats_teach = 0;
$stats_finish = 0;
$stats_course = 0;
$i = 0;

$index_posts = Post::find()->where(['active'=>'1'])->orderBy(['count_view' => SORT_DESC])->all();
$stats_courses = Course::find()->where(['active'=>'1'])->all();
$users_teach = User::find()->where(['status'=>'10', 'role'=>'2'])->all();
$stats_finish_course = Course::find()->where(['active'=>'0'])->all();

foreach($users_teach as $user)
{
	$stats_teach++;
}
foreach($stats_courses as $course)
{
	$stats_course++;
}
foreach($stats_finish_course as $course)
{
	$stats_finish++;
}
?>

<!-- banner -->
    <div class="main-w3pvt mian-content-wthree text-center" id="home">
        <div class="container">
            <div class="style-banner mx-auto">
                <h3 class="text-wh font-weight-bold">Обучение становится <br>проще с <span>Teachblock</span> </h3> 
                <p class="mt-3 text-li" id="join">Присоединяйся сейчас!</p>
                <!-- form -->
                <div class="home-form-w3ls mt-5">
				
					<?php if (Yii::$app->user->isGuest): ?>
                    <form action="/signup" method="get">
                        <button type="submit" class="btn_apt btn first">Я учитель</button>
                        <button type="submit" class="btn_apt btn second">Я ученик</button>
                    </form>
					<?php else: ?>
					<form action="/" method="get">
                        <button type="submit" class="btn_apt btn first">Я учитель</button>
                        <button type="submit" class="btn_apt btn second">Я ученик</button>
                    </form>
					<?php endif;?>
                </div>
                <!-- //form -->
            </div>
        </div>
    </div>
    <!-- //banner -->

    <!-- banner bottom -->
    <section class="w3ls-bnrbtm py-5" id="about">
        <div class="container py-xl-5 py-lg-3">
            <h3 class="title-w3 mb-md-5 mb-sm-4 mb-2 text-center font-weight-bold">Что мы предлагаем</h3>
            <div class="row">
                <div class="col-lg-6 text-center">
                    <img src="images/light.jpg" alt="about" class="img-fluid mt-4" />
                </div>
                <div class="col-lg-6 pr-xl-5 mt-4">
                    <h3 class="title-sub mb-4">По-настоящему легкую систему управления курсами</h3>
                    <p class="sub-para pt-4 mt-4">- Теперь не нужно тратить много времени на поиски нужных функций</p>
                    <p class="sub-para pt-4 mt-4">- Невероятно быстрый процесс обучения</p>
					<p class="sub-para pt-4 mt-4">- Новая система работы облегчит необходимые задачи для учителей</p>
                    <p class="sub-para pt-4 mt-4">- "Умные" уведомления станут для вас отличным помощником в работе</p>
                </div>
            </div>
        </div>
    </section>
    <!-- //banner bottom -->

    <!-- services -->
    <div class="services py-5" id="what">
        <div class="container py-xl-5 py-lg-3">
            <h3 class="title-w3 mb-xl-5 mb-sm-4 mb-2 text-center text-wh font-weight-bold">Наши преимущества</h3>
            <div class="row w3pvtits-services-row text-center">
                <div class="col-lg-4 serv-w3mk mt-5">
                    <div class="w3pvtits-services-grids">
                        <span class="fa fa-leanpub ser-icon" aria-hidden="true"></span>
                        <h4 class="text-bl my-4">Активное обучение</h4>
                        <p class="text-left">Изучение нового материала является простым и понятным.</p>
                        <a class="service-btn mt-xl-5 mt-4 btn" href="#">Больше<span class="fa fa-long-arrow-right ml-2"></span></a>
                    </div>
                </div>
                <div class="col-lg-4 serv-w3mk mt-5">
                    <div class="w3pvtits-services-grids">
                        <span class="fa fa-graduation-cap ser-icon" aria-hidden="true"></span>
                        <h4 class="text-bl my-4">Планирование курсов</h4>
                        <p class="text-left">Утанавливайте собственные приоритеты важности заданий.</p>
                        <a class="service-btn mt-xl-5 mt-4 btn" href="#">Больше<span class="fa fa-long-arrow-right ml-2"></span></a>
                    </div>
                </div>
                <div class="col-lg-4 serv-w3mk mt-5">
                    <div class="w3pvtits-services-grids">
                        <span class="fa fa-users ser-icon" aria-hidden="true"></span>
                        <h4 class="text-bl my-4">Открытые достижения</h4>
                        <p class="text-left">Следите за своими успехами и делитесь ими на платформе.</p>
                        <a class="service-btn mt-xl-5 mt-4 btn" href="#">Больше<span class="fa fa-long-arrow-right ml-2"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //services -->

    <!-- courses -->
    <section class="branches py-5" id="courses">
        <div class="container py-xl-5 py-lg-3">
            <h3 class="title-w3 mb-5 text-center font-weight-bold">Популярные курсы</h3>
            <div class="row branches-position pt-lg-4">
				<?php foreach($stats_courses as $course): ?>
                <div class="col-lg-3 col-sm-6 place-w3">
                    <!-- branch-img -->
                    <div class="team-img" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), 
					url(../<?=$course->image?>) no-repeat center;">
                        <div class="team-content">
                            <h4 class="text-wh"><?=$course->name?></h4>
                            <p class="team-meta"><?=$course->little_text?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- //places -->

    <!-- stats section -->
    <div class="middlesection-w3pvt py-sm-5 pt-sm-0 pt-5 mt-5" id="stats">
        <div class="container py-xl-5 py-lg-3">
            <div class="offset-lg-4 offset-sm-3 left-build-wthree aboutright-w3pvtwthree">
                <h3 class="title-w3-2 title-w3 mb-md-5 mb-4 font-weight-bold">Наша статистика</h3>
                <div class="row">
                    <div class="col-4 w3layouts_stats_left w3_counter_grid">
                        <h4 class="counter"><?=$stats_teach?></h4>
                        <p class="para-text-w3ls text-li let">Учителей</p>
                    </div>
                    <div class="col-4 w3layouts_stats_left w3_counter_grid2">
                        <h4 class="counter"><?=$stats_course?></h4>
                        <p class="para-text-w3ls text-li let">Создано курсов</p>
                    </div>
                    <div class="col-4 w3layouts_stats_left w3_counter_grid1">
                        <h4 class="counter"><?=$stats_finish?></h4>
                        <p class="para-text-w3ls text-li let">Завершенные курсы</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="property-paper">
            <img src="images/rocket.png" alt="" class="img-fluid agents-w3" />
        </div>
    </div>
    <!-- //stats section -->

    <!-- events -->
    <section class="blog_w3ls py-5" id="events">
        <div class="container py-xl-5 py-lg-3">
            <h3 class="title-w3 mb-5 text-center font-weight-bold">Не пропустите события</h3>
            <div class="row mt-4">
                <!-- blog grid -->
                <div class="col-lg-4">
                    <div class="wthree-title mt-lg-5 pt-lg-3">
                        <h3 class="w3pvt-title text-bl">Популярные события</h3>
                        <p class="border-top pt-4 mt-4">
                            Новости, набравшие найбольшее колличество просмотров из категорий
                        </p>
                    </div>
                </div>
                <!-- //blog grid -->
                <!-- blog grid -->
				<?php 
				foreach($index_posts as $post): $i++;
				if($i<6):
				$user = User::find()->where(['id' => $post->id_user])->one();
				$time = strtotime($post->date_time);
				$myFormatForView = date("j F Y h:i", $time);
				?>
                <div class="col-lg-4 col-md-6 mt-lg-0 mt-5">
                    <div class="card">
                        <div class="card-header m-0">
                            <h5 class="blog-title card-title m-0">
                                <a href="<?=yii\helpers\Url::to(['site/view', 'id' => $post->id])?>"><?=$post->title?></a>
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="text-left"><?=$post->little_text?></p>
                            <a class="service-btn mt-xl-5 mt-4 btn" href="<?=yii\helpers\Url::to(['site/view', 'id' => $post->id])?>">Читать подробнее<span class="fa fa-long-arrow-right ml-2"></span></a>
                        </div>
                        <div class="card-footer blog_w3icon border-top pt-2 mt-3 d-flex justify-content-between">
                            <small class="text-bl">
                                <b>Автор: <?=$user->username?></b>
								<p class="fa fa-eye"> </p><b> <?=$post->count_view?> </b>
                            </small>					
                            <span><?=$myFormatForView?></span>
                        </div>
                    </div>
                </div>
				<?php endif; ?>
				<?php endforeach; ?>
                <!-- //blog grid -->
                
            </div>
        </div>
    </section>
    <!-- //events -->


    <!-- contact-->
    <section class="contact py-5" id="contact">
        <div class="container py-xl-5 py-lg-3">
            <h3 class="title-w3 mb-sm-5 mb-4 text-center text-wh font-weight-bold">Связь с нами</h3>
            <div class="contact_grid_right pt-4">
                <form action="#" method="post">
                    <div class="row contact_left_grid">
                        <div class="col-lg-6 con-left" data-aos="fade-up">
                            <div class="form-group">
                                <input class="form-control" type="text" name="Name" placeholder="Name" required="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="Email" placeholder="Email" required="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="Subject" placeholder="Subject" required="">
                            </div>
                        </div>
                        <div class="col-lg-6 con-right" data-aos="fade-up">
                            <div class="form-group">
                                <textarea id="textarea" placeholder="Message" required=""></textarea>
                            </div>
                            <div class="sub-honey">
                                <button class="form-control btn" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- //contact -->

    <!-- footer -->
    <footer class="py-5">
        <div class="container py-xl-4 py-lg-3">
            <div class="row footer-grids">
                <div class="col-lg-2 col-6 footer-grid">
                    <h3 class="mb-sm-4 mb-3">Навигация</h3>
                    <ul class="list-unstyled">
                        <li>
                            <a href="/">Главная</a>
                        </li>
                        <li>
                            <a href="#about">Помощь</a>
                        </li>
                        <li>
                            <a href="#what">Новости</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 footer-grid">
                    <h3 class="mb-sm-4 mb-3">Больше</h3>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#join">Присоединяйся</a>
                        </li>
                        <li>
                            <a href="#courses">Популярные курсы</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 footer-grid footer-contact mt-lg-0 mt-4">
                    <h3 class="mb-sm-4 mb-3">Контакты</h3>
                    <ul class="list-unstyled">
                        <li>
                            +038(0хх) хххх хххх
                        </li>
                        <li>
                            <a href="mailto:info@example.com">info@example.com</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 footer-grid text-lg-right">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#stats">Наша статистика</a>
                        </li>
						<?php if (Yii::$app->user->isGuest): ?>
                        <li>
                            <a href="<?=yii\helpers\Url::to(['site/login'])?>">Войти</a>
                        </li>
                        <li>
                            <a href="<?=yii\helpers\Url::to(['site/signup'])?>">Регистрация</a>
                        </li>
						<?php else: ?>
						<li>
                            <a href="<?=yii\helpers\Url::to(['/'])?>">Войти</a>
                        </li>
                        <li>
                            <a href="<?=yii\helpers\Url::to(['/'])?>">Регистрация</a>
                        </li>
						<?php endif;?>
                    </ul>
                </div>
                <div class="col-lg-4 footer-grid mt-lg-0 mt-4">
                    <div class="footer-logo">
                        <h2 class="text-lg-center text-center">
                            <a class="logo text-wh font-weight-bold" href="index.html">Teachblock</a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- //footer -->
    <!-- copyright -->
    <div class="copyright-w3ls py-4">
        <div class="container">
            <div class="row">
                <!-- copyright -->
                <p class="col-lg-8 copy-right-grids text-wh text-lg-left text-center mt-lg-2">© 2019 Teachblock. All
                    Rights Reserved 
                </p>
                <!-- //copyright -->
                <!-- social icons -->
                <div class="col-lg-4 w3social-icons text-lg-right text-center mt-lg-0 mt-3">
                    <ul>
                        <li>
                            <a href="#" class="rounded-circle">
                                <span class="fa fa-facebook-f"></span>
                            </a>
                        </li>
                        <li class="px-2">
                            <a href="#" class="rounded-circle">
                                <span class="fa fa-google-plus"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="rounded-circle">
                                <span class="fa fa-twitter"></span>
                            </a>
                        </li>
                        <li class="pl-2">
                            <a href="#" class="rounded-circle">
                                <span class="fa fa-dribbble"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- //social icons -->
            </div>
        </div>
    </div>
    <!-- //copyright -->
    <!-- move top icon -->
    <a href="#home" class="move-top text-center">
        <span class="fa fa-angle-double-up" aria-hidden="true"></span>
    </a>
