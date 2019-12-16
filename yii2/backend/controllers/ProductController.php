<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Product;
use common\models\Category;
use common\models\RelationsProductCategory;
use backend\models\SearchProduct;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class ProductController extends Controller
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
		$model = new SearchProduct();
		$query = Product::find();
		
		if($post = yii::$app->request->post('SearchProduct')) : 
			$query = $model->search($post['name']); 
			$model->name = $post['name'];
		endif;
		
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
				'dataProvider'=>$dataProvider,
				'model'=>$model
			]
		);
    }
	
    public function actionUpdate($id)
    {
        $model = Product::findOne($id);
		
        if($model->load(Yii::$app->request->post()) and $model->save()) 
		{
			$relations__list = Yii::$app->request->post('RelationsProductCategory');
			RelationsProductCategory::setRelationsProductCategory($id,$relations__list);
			
            return $this->redirect(['product/index']);
        }
        return $this->render('update',
			[
				'model'=>$model,
				'category_list'=>Category::getAllCategory_ListArray(),
				'category_list_active'=>RelationsProductCategory::getAllRelationsProduct($id),
			]
		);
    }
	
    public function actionDelete($id)
    {
        $model = Product::findOne($id);
		$model->delete();
        return $this->redirect(['product/index']);
    }

    public function actionCreate()
    {
        $model = new Product();
        if($model->load(Yii::$app->request->post()) and $model->save()) 
		{
			$relations__list = Yii::$app->request->post('RelationsProductCategory');
			RelationsProductCategory::setRelationsProductCategory($model->id,$relations__list);
            return $this->redirect(['product/index']);
        }
		else 
		{
            return $this->render('create', [
				'category_list'=>Category::getAllCategory_ListArray(),
                'model' => $model,
            ]);
        }
    }
}
