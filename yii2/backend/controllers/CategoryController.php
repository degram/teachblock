<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Category;
use common\models\Product;
use common\models\RelationsProductCategory;
use backend\models\SearchProduct;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * Site controller
 */
class CategoryController extends Controller
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
                        'actions' => ['index','update', 'view', 'delete','create','list_product'],
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
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }
	
    public function actionUpdate($id)
    {
        $model = Category::findOne($id);
        if ($model->load(Yii::$app->request->post()) and $model->save()) 
		{
            return $this->redirect(['category/index']);
        }
        return $this->render('update', ['model'=>$model]);
    }
	
	public function actionDelete($id)
    {
        $model = Category::findOne($id);
		$model->delete();
        return $this->redirect(['category/index']);
    }
	
	public function actionCreate()
    {
        $model = new Category();
        if ($model->load(Yii::$app->request->post())) 
		{
			if(!$model->save())
			{
				print_r($model->getErrors()); exit;
			}
            return $this->redirect(['/category/index']);
        } 
		else 
		{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionList_product($id_category)
    {
		$model = new SearchProduct();
		$model_category = Category::findOne($id_category);
		$query = Product::find();
		if($post = yii::$app->request->post('SearchProduct')) : 
			$query_id_product = $model->searchArray($post['name']); 
			$model->name = $post['name'];
			$model_relations_pc = ArrayHelper::map(RelationsProductCategory::find()->where(['id_category'=>$id_category,'id_product'=>$query_id_product])->asArray()->all(),'id_product','id_product');
		else:
			$model_relations_pc = ArrayHelper::map(RelationsProductCategory::find()->where(['id_category'=>$id_category])->asArray()->all(),'id_product','id_product');
		endif;
		
		
		$dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['id'=>$model_relations_pc]),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('list_product',
			[
				'dataProvider'=>$dataProvider,
				'model_category' => $model_category,
				'model' => $model,
			]
		);
    }
}
