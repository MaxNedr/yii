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

        Yii::$app->db->createCommand()->batchInsert('task', [
            'title',
            'description',
            'creator_id',
            'updater_id',
            'created_at'
        ], [
            ['Test_title_1', 'description_1', 1, 1, time()],
            ['Test_title_2', 'description_2', 31, 2, time()],
            ['Test_title_3', 'description_3', 33, 3, time()],
            ['Test_title_4', 'description_4', 34, 4, time()],

        ])->execute();

        return $this->render('insert');
    }

    public function actionSelect()
    {
        $query = new Query();
        $newModel = $query->from('user')->where(['id' => 1])->one();
        $newModel_2 = $query->from('user')->where('id' > 1)->orderBy('username')->all();
        $newModel_3 = $query->from('user')->count();
        $newModel_4 = $query->select(['task.id', 'title', 'description', 'task.creator_id', 'user.id','username' ])->from('task')->innerJoin('user', 'task.creator_id'=='user.id')->all();

        return $this->render('select', [
            'model' => $newModel,
            'model_1' => $newModel_2,
            'model_2' => $newModel_3,
            'model_3' => $newModel_4,
        ]);
    }

}