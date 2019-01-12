<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class TestController extends Controller
{


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionIndex()
    {
         // return $this->renderContent('test');
         return $this->render('index');
    }
}
