<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\PaymentMethod;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class PaymentController extends Controller
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
            'query' => PaymentMethod::find(),
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
        $model = PaymentMethod::findOne($id);
		
        if ($model->load(Yii::$app->request->post()) and $model->save()) 
		{
            return $this->redirect(['payment/index']);
        }
        return $this->render('update',
			[
				'model'=>$model,
			]
		);
    }
	
    public function actionDelete($id)
    {
        $model = PaymentMethod::findOne($id);
		$model->delete();
        return $this->redirect(['payment/index']);
    }

    public function actionCreate()
    {
        $model = new PaymentMethod();
        if ($model->load(Yii::$app->request->post()) and $model->save()) 
		{
            return $this->redirect(['/payment/index']);
        } 
		else 
		{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
}
