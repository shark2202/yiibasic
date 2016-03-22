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

class HelloController extends Controller{

    public function actionWorld()
    {
        return "hello world!";
    }

    public function actionRf()
    {
        if(Yii::$app->request->isPost)
        {
            Yii::$app->response->statusCode = 500;
            print_r(Yii::$app->request->post());
            //sleep(3);
            //$this->refresh();
            return ;
        }
        else{
            $mode = (new Country)->findOne(array('code'=>'US'));
            $userModels = $mode->find()->all();
            $currentUserId = "US";
            return $this->render('HelloWorld',['model' => $mode,'userModels'=>$userModels,'currentUserId'=>$currentUserId]);
        }
    }

    public function actionGoback()
    {
        print_r(Yii::$app->request->post());
        //$this->goBack();
    }

    public function actionDbquery()
    {
        $primaryConnection = \Yii::$app->db;
        $primaryConnection->open();
        $command = $primaryConnection->createCommand("select * from country");//生成SQL语句了，可以处理复杂的sql语句
        $countries = $command->queryAll();var_dump($countries);//执行sql语句并且获取结果，结果是数组形式的
        echo $command->getSql();



        $command2= $primaryConnection->createCommand("select * from country")->query();//获取的是 object PDOStatement
        //var_dump($command2);
        foreach($command2 as $v)
        {
            var_dump($v);//迭代器读取信息
        }
        //var_dump($command2);

        $command3 = $primaryConnection->createCommand("select code from country");
        $countries_code = $command3->queryColumn();//获取的是单列的值
    }

    /**
     * 数据库支持事务操作
     */
    public function actionDbt()
    {
        $db = Yii::$app->getDb();//直接表明需要获取的对象  $db = Yii::$app->db;
        $transaction = $db->beginTransaction();//获取开启可事务的链接
        try{//在事务中运行
            $sql1 = "insert into country ";
            $commond1 = $db->createCommand()->execute();//只有修改才要有事务



        }catch (Exception $e){

        }


    }
}