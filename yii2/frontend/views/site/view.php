<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\models\Post;
use common\models\Category;

$this->title = $post->title;

$cat = Category::find()->where(['id' => $post->id_category])->one();
$time = strtotime($post->date_time);
$myFormatForView = date("j F Y h:i", $time);
?>

<div class="news-text">
    <div class="container-fluid">
        <div class="row mb-2">
			<div class="col-md-12">
				<div class="card flex-md-row mb-4 box-shadow h-md-250">
					<div class="col-lg-4 pull-lg-8 text-center">
					<img class="img-post img-fluid" src="<?=$post->image?>" alt="Card image cap">
					</div>
					<div class="col-sm-7 post-main">
						<strong class="text-cat d-inline-block mb-2 text-primary"><?=$cat->name?></strong>
						<div class="mb-0 mt-1 text-muted"><?=$myFormatForView?> | <i class="fa fa-eye"></i> <?=$post->count_view?></div>
						<h3 class="news-title mb-4"><?=$post->title?></h3>
						<p><b class="card-text mb-auto"><?=$post->little_text?></b></p>
						<p class="card-text mb-auto"><?=$post->text?></p>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>
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