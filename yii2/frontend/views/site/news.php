<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
$this->title = 'Новости';
use common\models\Post;
use common\models\Category;

$time = strtotime($post->date_time);
$myFormatForView = date("jS F Y h:i", strtotime("$post->date_time"));
?>

<div class="blog_w3ls" id="events">
        <div class="container-fluid">
            <h3 class="title-w3 mb-5 text-center font-weight-bold">События</h3>
            <div class="row mb-2">
				<?php if(!empty($posts)): ?>
				<?php foreach($posts as $post):
				$time = strtotime($post->date_time);
				$myFormatForView = date("j F Y h:i", $time);
				$cat = Category::find()->where(['id' => $post->id_category])->one();
				?>
					<div class="col-md-6">
					  <div class="card flex-md-row mb-4 box-shadow h-md-250">
						<div class="card-body d-flex flex-column align-items-start">
						  <strong class="d-inline-block mb-2 text-primary"><?=$cat->name?></strong>
						  <h3 class="mb-0">
							<a class="text-dark" href="<?=yii\helpers\Url::to(['site/view', 'id' => $post->id])?>"><?=$post->title?></a>
						  </h3>
						  <div class="mb-1 text-muted"><?=$myFormatForView?></div>
						  <div class="mb-1 text-muted">Просмотры: <?=$post->count_view?></div>
						  <p class="card-text mb-auto"><?=$post->little_text?></p>
						  <a class="service-btn mt-xl-5 mt-4 btn" href="<?=yii\helpers\Url::to(['site/view', 'id' => $post->id])?>">Читать далее<span class="fa fa-long-arrow-right ml-2"></span></a>
						</div>
						<img class="card-img-right flex-auto d-none d-md-block style='height:250px;'" src="<?=$post->image?>" alt="Card image cap">
					  </div>
					</div>			
				<?php endforeach; ?>
				<div class="mx-auto">
				<?= \yii\widgets\LinkPager::widget(['pagination' => $pages])?>
				</div>
				<?php endif; ?>
			</div>
		</div>
</div>

