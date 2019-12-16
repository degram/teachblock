<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\StatusOrder;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class StatusOrderController extends Controller
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
                        'actions' => ['index','update', 'delete','create'],
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
            'query' => StatusOrder::find(),
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
			]
		);
    }
	
    public function actionUpdate($id)
    {
        $model = StatusOrder::findOne($id);
		
        if ($model->load(Yii::$app->request->post()) and $model->save()) 
		{
            return $this->redirect(['status-order/index']);
        }
        return $this->render('update',
			[
				'model'=>$model,
			]
		);
    }
	
    public function actionDelete($id)
    {
        $model = StatusOrder::findOne($id);
		$model->delete();
        return $this->redirect(['status-order/index']);
    }

    public function actionCreate()
    {
        $model = new StatusOrder();
        if ($model->load(Yii::$app->request->post()) and $model->save()) 
		{
            return $this->redirect(['/status-order/index']);
        } 
		else 
		{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
}
