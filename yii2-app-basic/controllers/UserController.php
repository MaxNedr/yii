<?php

namespace app\controllers;

use app\models\Task;
use app\models\TaskUser;
use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }

    public function actionTest()
    {
        $newRecord = new User();
        $newRecord->setAttributes([
            'username' => 'new user name',
            'password_hash' => 'hash_pass',
            'auth_key' => 'keykey',
            'creator_id' => '1',
            'updater_id' => '1',
            'created_at' => time()

        ]);
        $newRecord->save();
        _log($newRecord);

        $sameUser = User::findOne(1);
        $newTask = new Task();
        $newTask->title = 'newTitle';
        $newTask->description = 'new Desc';
        $newTask->created_at = time();
        $newTask->link('creator', $sameUser);
        _log($newTask);

        $sameUser2 = User::findOne(2);
        $newTask2 = new Task();
        $newTask2->title = 'newTitle2';
        $newTask2->description = 'new Desc2';
        $newTask2->created_at = time();
        $newTask2->link('creator', $sameUser2);
        _log($newTask2);

        $sameUser3 = User::findOne(3);
        $newTask3 = new Task();
        $newTask3->title = 'newTitle3';
        $newTask3->description = 'new Desc3';
        $newTask3->created_at = time();
        $newTask3->link('creator', $sameUser3);
        _log($newTask3 );





        $model = User::find()->with(User::RELATION_CREATED_TASKS)->all();
        _log($model);

        $model1 = User::find()->joinWith(User::RELATION_CREATED_TASKS)->all();
        _log($model1);


        $sameUser4 = User::findOne(1);
        $tasks = Task::findAll([9, 10, 11]);
        foreach ($tasks as $task) {
            $sameUser4->link(User::RELATION_ACCESSED_TASKS, $task);
        }


        return $this->render('test', ['model' => []]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = User::SCENARIO_CREATE;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = User::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
