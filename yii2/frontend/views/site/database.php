<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
$this->title = 'database';
use common\models\Course;
?>

<?php
$courses = Course::find()->where(['active'=>'1'])->one();
foreach($courses as $course)
{
	echo "<div>$course->name</div>";
}
?>

