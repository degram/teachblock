<?php
namespace backend\controllers;

use common\models\Actions;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Product;
use common\models\Category;
use common\models\RelationsProductCategory;
use backend\models\SearchProduct;
use yii\data\ActiveDataProvider;
use common\models\Post;
use common\models\UploadImage;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class ActionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index','update', 'view', 'delete','create'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$query = Post::find();
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index',
			[
				'dataProvider'=>$dataProvider
			]
		);
    }
	
    public function actionUpdate($id)
    {
        $model = Post::findOne($id);
		
        if($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			return $this->redirect(['action/index']);
        }
        return $this->render('update',
			[
				'model' => $model,
			]
		);
    }
	
    public function actionDelete($id)
    {
        $model = Post::findOne($id);
		$model->delete();
        return $this->redirect(['action/index']);
    }

    public function actionCreate()
    {
        $model = new Post();
		
		
        if($model->load(Yii::$app->request->post())) 
		{
			$model->save();
            return $this->redirect(['action/index']);
        }
		else 
		{
            return $this->render('create', ['model' => $model]);
        }
    }
}
