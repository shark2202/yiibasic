<?php

namespace app\controllers;


use app\models\Country;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use yii\helpers\url;

class SiteController extends Controller
{
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = 'world')
    {
        //return $this->renderContent("ok".$message);
        return $this->render("say",['message'=>$message]);
    }

    public function actionForm()
    {
        $model = new EntryForm();

        if(Yii::$app->request->getIsPost())
        {
//            $model->name = 'Qiang';
//            $model->email = 'bad';
//            if($model->validate())
//            {
//                echo "ok";
//            }
//            else{
//                var_dump($model->getErrors());
//            }

            if($model->load(Yii::$app->request->post()) && $model->validate())
            {
                return $this->render('entry',['model'=>$model,'message'=>1]);
            }
        }
        else{
            return $this->render('entry', ['model' => $model,'message'=>0]);
        }
    }

    public function actionDb()
    {
        $countries = Country::find()->orderBy('name')->all();

        var_dump($countries->attributes);
        foreach($countries as $key=>$country)
        {
            echo $key,'#',$country->name,'<br/>';
        }

        $country_one = Country::findOne("US");

        $array = $country_one->attributes;
        var_dump($array);
        echo $country_one->name;

        $country_add = new Country();
        $country_add->code = "UN";
        $country_add->name = "联合国";
        $country_add->population = "12345";
//        $country_add->save();

        $country_update = new Country;
        $country_update->findOne("UN");
        $country_update->name = "联合王国111333";
//        $country_update->save();
    }

    public function actionDb2()
    {
        $countries = Country::find()->all();
        $data = ArrayHelper::toArray($countries,[
            'app\models\Country'=>[
                'code',
                'name',
                'population',
                'length'=>function($countries){
                    return strlen($countries->name);
                },
            ]
        ]);
        print_r($data);


        $result = ArrayHelper::index($data, function ($element) {
            return $element['code'];
        });
        print_r($result);
    }

    public function actionUrl123()
    {
//        namespace yii\helpers;
        $relativeHomeUrl = Url::home();
        $absoluteHomeUrl = Url::home(true);
        $httpsAbsoluteHomeUrl = Url::home('https');

        var_dump($relativeHomeUrl,$absoluteHomeUrl,$httpsAbsoluteHomeUrl);

        $url = Url::toRoute(['product/view', 'id' => 42]);
        echo $url;
        echo "<br/>####";
        $url = Url::toRoute(['product/view', 'id' => 42,'#'=>'anchor']);
        echo $url;

        // /index.php?r=site/index
        echo "#".Url::to(['site/index']).'#<br/>';

// /index.php?r=site/index&src=ref1#name
        echo Url::to(['site/index', 'src' => 'ref1', '#' => 'name']);

// /index.php?r=post/edit&id=100     assume the alias "@postEdit" is defined as "post/edit"
        echo Url::to(['@postEdit', 'id' => 100]);

// the currently requested URL
        echo Url::to();

// /images/logo.gif
        echo Url::to('@web/images/logo.gif');

// images/logo.gif
        echo Url::to('images/logo.gif');

// http://www.example.com/images/logo.gif
        echo Url::to('@web/images/logo.gif', true);

// https://www.example.com/images/logo.gif
        echo Url::to('@web/images/logo.gif', 'https');
    }

    public function actionHtml()
    {
        $model = new EntryForm();
        return $this->render('html',['user'=>$model]);
    }
}
