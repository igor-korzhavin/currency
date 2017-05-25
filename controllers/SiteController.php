<?php
namespace app\controllers;

use app\models\Currency;
use yii\db\Query;
use app\models\Auctions;
use app\models\Login;
use app\models\PropForm;
use app\models\Propositions;
use app\models\Signup;
use app\models\Parse;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\Contracts;
use app\components\MyWidget;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

use app\models\Payment_accounts;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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

    /**
     * @inheritdoc
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
     * @return string
     */

    public function actionIndex()
    {
        $model = new Propositions();
        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->user_id = Yii::$app->session->get('id');
            $model->save();
            return $this->goHome();
        }
        $currency = Currency::find()->all();
        $propositions = Propositions::find()->orderBy(['id'=>SORT_DESC])->with('user')->where(['status'=>'0'])->all();

        return $this->render('index',['propositions'=>$propositions,'model'=>$model,'currency'=>$currency]);
    }

    public function actionCountContr()
    {
        $data = (new Query())->select(['user.login', 'COUNT(c.id) as counts'])
            ->from('user')
            ->leftJoin('propositions as prop', 'prop.user_id = user.id')
            ->leftJoin('contracts as c', 'prop.id = c.id_prop')
            ->groupBy('user.login')
            ->having(['>', 'COUNT(c.id)', 0])
            ->where(['=', 'c.status', '2'])
            ->all();

        return  json_encode($data);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
       if(!Yii::$app->user->isGuest){
           return $this->goHome();
       }
        $login_model = new Login();
        if (Yii::$app->request->post('Login')){
            $login_model->attributes = Yii::$app->request->post('Login');
            if ($login_model->validate()){
                Yii::$app->user->login($login_model->getUser());
                $_SESSION['id'] = $login_model->getUser()->id;
                $_SESSION['login'] = $login_model->getUser()->login;
                return $this->goHome();
            }
        }
        return $this->render('login',['login_model'=>$login_model]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest){
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionRate()
    {
        if (Yii::$app->request->isAjax){

            $from= Yii::$app->request->post('from');
            $to  = Yii::$app->request->post('to');

            if (!empty($from)and !empty($to)){
                $rate = Parse::find()->select('rate_out')->where("currency_from = '{$from}' AND currency_to = '{$to}'")->asArray()->one();
                $result = $rate['rate_out'];
                return $result;
            }
        }
    }

    public function actionCash()
    {
        return $this->render('cash');
    }

    public function actionSignup()
    {
        $model = new Signup();
        if (isset($_POST['Signup'])){
           $model->attributes=Yii::$app->request->post('Signup');
           if($model->validate() && $model->signup()){
               return $this->redirect(['login']);
           }
        }
        return $this->render('signup',['model'=>$model]);
    }
}
