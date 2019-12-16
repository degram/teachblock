<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
    <a href="/user/index" class="btn btn-success">К списку пользователей</a>
<?php
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'username',
		'name',
		'surname',
		'role',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email',
        'status',
        'created_at',
        'updated_at',
    ],
]);

?>
