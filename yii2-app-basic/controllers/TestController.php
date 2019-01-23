<?php

namespace app\controllers;


use app\components\TestService;
use app\models\Product;
use Yii;
use yii\db\Query;
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
        return $this->render('index', ['model' => $model]);
    }


    public function actionInsert()
    {
        Yii::$app->db->createCommand()->insert('user', [
            'username' => 'test_1',
            'password_hash' => 'fdsdggs',
            'auth_key' => 'key_1',
            'creator_id' => 1,
            'updater_id' => 1,
            'created_at' => time()
        ])->execute();
        Yii::$app->db->createCommand()->insert('user', [
            'username' => 'test_2',
            'password_hash' => 'hash_2',
            'auth_key' => 'key_2',
            'creator_id' => 2,
            'updater_id' => 2,
            'created_at' => time()
        ])->execute();
        Yii::$app->db->createCommand()->insert('user', [
            'username' => 'test_3',
            'password_hash' => 'hash_3',
            'auth_key' => 'key_3',
            'creator_id' => 3,
            'updater_id' => 3,
            'created_at' => time()
        ])->execute();

        /*Yii::$app->db->createCommand()->batchInsert('user', [
            'username',
            'password_hash',
            'auth_key',
            'creator_id',
            'updater_id',
            'created_at'
        ], [
            ['Test_name_1', 'hash_1', 'key_1', 1, 1, time()],
            ['Test_name_2', 'hash_2', 'key_2', 2, 2, time()],
            ['Test_name_3', 'hash_3', 'key_3', 3, 3, time()],
            ['Test_name_4', 'hash_4', 'key_4', 4, 4, time()],

        ])->execute();*/
        return $this->renderContent('test_insert');
    }

    public function actionSelect()
    {
        $query = new Query();
        $newModel = $query->from('user')->where(['id' => 1])->one();
        $newModel_2 = $query->from('user')->where('id' > 1)->orderBy('username')->all();
        $newModel_3 = $query->from('user')->count();

        return $this->render('select', ['model' => $newModel,'model_1'=>$newModel_2,'model_2'=>$newModel_3]);
    }

}