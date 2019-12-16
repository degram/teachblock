<?php
use yii\helpers\Html;
?>
<?php if (isset($category_list)): ?>
    <ul class='list_category'>
        <?php foreach ($category_list as $id => $name): ?>
            <li>
			<?php if(@array_key_exists($id,$category_list_active)): ?>
				<?= Html::checkbox("RelationsProductCategory[$id]", 1).' '.$name; ?>
			<?php else: ?>
				<?= Html::checkbox("RelationsProductCategory[$id]", 0).' '.$name; ?>
			<?php endif; ?>
			</li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>