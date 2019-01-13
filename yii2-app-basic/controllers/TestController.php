<?php
namespace app\controllers;



use app\models\Product;
use yii\web\Controller;


class TestController extends Controller
{

    public function actionIndex()
    {
        $model = new Product();
        $model->price = 100;
        $model->name = 'Name';
        $model->id = 2;
        $model->category = 'main';


        // return $this->renderContent('test');
        return $this->render('index',['model'=> $model]);
    }
}
