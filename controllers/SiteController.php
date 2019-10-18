<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Test;
use app\models\Questions;
use app\models\Answers;
use app\models\ContactForm;
use app\models\Users;
use app\models\UserAnswers;
use yii\helpers\ArrayHelper;
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
     * @return string
     */
    public function actionIndex()
    {
        $model = new Test;
//        $model->getArray();
        $a = $model->getArray();
        return $this->render('index', ['a' => $a]);
    }

    public function actionCreate()
    {
        if(Yii::$app->request->post())
        {
            return $this->redirect(['site/createfull','test'=>$_POST['test']]);
        }
        $test= new Test;
        $tests= Test::find()->asArray()->all();
        return $this->render('CreateQuest',['tests'=>ArrayHelper::map($tests, 'id', 'Name'),'test'=>$test]);
    }

    public function actionCreatefull()
    {
        if(Yii::$app->request->post())
        {
            
        }
        $que= new Questions;
        $ques= Questions::find()->asArray()->all();
        return $this->render('createFull',['test'=>$_POST['test'],'que'=>$que,'ques'=>ArrayHelper::map($ques, 'id', 'Question')]);
    }

    public function actionUsers()
    {
//        $model = new Users;
//        $model->getArray();
        $a = Users::find()->asArray()->all();
        return $this->render('users', ['a' => $a]);
    }

    public function actionChangeuser(){
        $session = Yii::$app->session;
        $session->open();
        $_SESSION['user'] = $_GET['User'];
        return $this->redirect(['site/test', 'test' => $_GET['test'], 'Question' => $_GET['Question']]);
    }

    public function actionTest()
    {
        $questions = Questions::find()->where(['test_id' => $_GET['test']])->asArray()->all();
        $answers = array();
        foreach ($questions as $question){
            $a = Answers::find()->where(['questions_id' => $question['id']])->asArray()->all();
            $answers[]=$a;
        }
        $flag = UserAnswers::find()->where(['user_id' => $_SESSION['user'], 'questions_id' => [$questions[ $_GET['Question']]['id'] ]])->asArray()->one();
        if (YII::$app->request->isAjax){
            $que2 = Answers::find()->where(['id' => $_POST['ans']])->asArray()->one();
            $save = new UserAnswers;
            $save->user_id = $_POST['usr'];
            $save->questions_id = $_POST['que'];
            $save->answer_id = $_POST['ans'];
            $save->save(false);
            if ($que2['Correct'] == 1){
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                $c = true;
                return [$c,$_POST['ans']];
            }else{
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $c = false;
                return [$c,$_POST['ans']];
            }
            };

        return $this->render('test', ['questions' => $questions, 'answers' => $answers, 'flag' => $flag]);
    }

    public function actionFinnish()
    {
        if (empty($_SESSION['user'])) {
            return Yii::$app->response->redirect([ Url::to(['index']) ]);
        }
        $RightAnswers = 0;
        $UserAnswers = UserAnswers::find()->where(['user_id' => $_SESSION['user']])->asArray()->all();
//        print_r ($UserAnswers);
        foreach ($UserAnswers as $answer) {
//            print_r ($answer);
//            print_r ($answer['question_id']);
            $questions = Questions::find()->where(['id' => $answer['questions_id']])->asArray()->one();
            if ($questions['test_id'] == $_GET['test']) {
                $answers = Answers::find()->where(['id' => $answer['answer_id']])->asArray()->one();
                if ($answers['Correct'] == 1) {
                    $RightAnswers ++;
//                    echo $RightAnswers;
                }
            }
        }
//        echo $RightAnswers;
        $user = Users::find()->where(['id' => $_SESSION['user']])->asarray()->one();
        return $this->render('finnish', ['RightAnswers' => $RightAnswers, 'user' => $user]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
