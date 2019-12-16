<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\helpers\Url;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\UploadImage;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Post;
use common\models\Course;
use common\models\User_data;
use common\services\auth\SignupService;
use yii\web\UploadedFile;
use common\models\Notification;
use common\models\UploadAudio;
use common\models\UploadFile;
use common\models\UploadPract;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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
	
	/*public function behaviors()
	{
    return [
        'access' => [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => false,
                    'roles' => ['?'],
                    'denyCallback' => function($rule, $action) {
                        return $this->redirect(Url::toRoute(['/site/index']));
                    }
                ],
                [
                    'actions' => [],
                    'allow' => true,
                    'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            /** @var User $user *//*
                            $user = Yii::$app->user->getIdentity();
                            return $user->isAdmin() || $user->isManager() || $user->isUser();
                        }
                ],
            ],
        ],
    ];
	}*/
	
	

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        
        return $this->render('index');
    }
	
	public function actionNews()
    {
		$query = Post::find()->where(['active'=>'1']);
		$pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 4, 'pageSizeParam' => false, 'forcePageParam' => false]);
		$posts = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('news', compact('posts', 'pages'));
    }
	
	public function actionView($id)
	{
		$id = \Yii::$app->request->get('id');
		$post = Post::findOne($id);
		$post->processCountViewPost();  
		if(empty($post)) throw new \yii\web\HttpException(404, 'Такой страницы не существует');
		return $this->render('view', compact('post'), [
            'model' => $post,            
        ]);
	}
	
	public function actionHelp()
    {
		$model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        } else {
            return $this->render('help', [
                'model' => $model,
            ]);
        }
    }
	public function actionAccount()
    {
		$model = new UploadImage();
		
		if(Yii::$app->request->isPost){
			$model->image = UploadedFile::getInstance($model, 'image');
			$model->upload();
			return $this->render('account', ['model' => $model]);

		}
        return $this->render('account', ['model' => $model]);
    }
	
	public function actionCreate()
    {
        $model = new Course();
 
        if($model->load(Yii::$app->request->post())) 
		{	
			$model->images = UploadedFile::getInstance($model, 'images');
			$model->save();
			$model->upload();
            return $this->redirect(['site/courses']);
        }
		
        return $this->render('create', ['model' => $model]);
    }
	
	
	public function actionSettings()
    {
		$model = new User_data;
		
        if($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			return $this->redirect(['site/account']);
        }
        return $this->render('settings',
			[
				'model' => $model,
			]
		);
    }
	
	public function actionCourses()
    {
		$query = Course::find()->where(['active'=>'1', 'id_user'=>Yii::$app->user->id]);
		$pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 5, 'pageSizeParam' => false, 'forcePageParam' => false]);
		$course_list = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('courses', compact('course_list', 'pages'));
    }
	
	public function actionCourse($id)
    {
		$model = new UploadFile();
		$audio = new UploadAudio();
		$pract = new UploadPract();
		$id = \Yii::$app->request->get('id');
		$single_course = Course::findOne($id);
		if(empty($single_course)) throw new \yii\web\HttpException(404, 'Такой страницы не существует');
		if(Yii::$app->request->isPost){
			$model->docFile = UploadedFile::getInstance($model, 'docFile');
			$model->upload();
			return $this->render('course', ['model' => $model, 'audio' => $audio, 'pract' => $pract]);
		}
		if(Yii::$app->request->isPost){
			$audio->audioFile = UploadedFile::getInstance($audio, 'audioFile');
			$audio->upload();
			return $this->render('course', ['model' => $model, 'audio' => $audio, 'pract' => $pract]);
		}
		if(Yii::$app->request->isPost){
			$pract->docFilePract = UploadedFile::getInstance($pract, 'docFilePract');
			$pract->upload();
			return $this->render('course', ['model' => $model, 'audio' => $audio, 'pract' => $pract]);
		}
		
        return $this->render('course', ['model' => $model, 'audio' => $audio, 'pract' => $pract], compact('single_course'));
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
		if ($form->load(Yii::$app->request->post())) {
			try{
				if($form->login()){
					return $this->goBack();
				}
			} catch (\DomainException $e){
				Yii::$app->session->setFlash('error', $e->getMessage());
			return $this->goHome();
			}
		}

		return $this->render('login', [
			'model' => $form,
		]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $form = new SignupForm();
		if ($form->load(Yii::$app->request->post()) && $form->validate()) {
        $signupService = new SignupService();

        try{
            $user = $signupService->signup($form);
            Yii::$app->session->setFlash('success', 'Подтвердите вашу почту для регистрации.');
            $signupService->sentEmailConfirm($user);
            return $this->redirect('signup');
        } catch (\RuntimeException $e){
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
		}

		return $this->render('signup', [
        'model' => $form,
		]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте свою электронную почту для продолжения.');

                return $this->redirect('request-password-reset');
            } else {
                Yii::$app->session->setFlash('error', 'К сожалению, мы не можем сбросить пароль для указанного адреса электронной почты.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен.');

            return $this->redirect('login');
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
	 
    public function actionSignupConfirm($token)
{
		$signupService = new SignupService();

		try{
			$signupService->confirmation($token);
			Yii::$app->session->setFlash('success', 'Вы успешно подтвердили свою регистрацию.');
		} catch (\Exception $e){
			Yii::$app->errorHandler->logException($e);
			Yii::$app->session->setFlash('error', $e->getMessage());
		}

		return $this->goHome();
	}

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'роверьте свою электронную почту для продолжения.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'К сожалению, мы не можем сбросить пароль для указанного адреса электронной почты.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
