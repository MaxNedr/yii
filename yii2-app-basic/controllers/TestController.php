<?php
namespace app\controllers;



use app\components\TestService;
use app\models\Product;
use yii\web\Controller;


class TestController extends Controller
{

    public function actionIndex()
    {
//        $test = new TestService();
//        return $test->start();

//        return \Yii::$app->test->start();


        $model = new Product();
        $model->price = 100;
        $model->name = \Yii::$app->test->start();;
        $model->id = 2;
        $model->created_at = 221245337;
        _log($model);

        // return $this->renderContent('test');
        return $this->render('index',['model'=> $model]);
    }
}
