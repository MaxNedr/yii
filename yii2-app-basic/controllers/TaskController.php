<?php

namespace app\controllers;

use app\models\TaskUser;
use app\models\User;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Yii;
use app\models\Task;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
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

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionMy()
    {

        /*$myQuery = TaskUser::find()->select('task_id')->where(['user_id' => 1]);

        $myMainQuery = Task::find()->where(['creator_id' => 1])->orWhere(['id'=> $myQuery]);

        $dataProvider2 = new ActiveDataProvider([
            'query'=>$myMainQuery
        ]);*/

        $dataProvider = new ActiveDataProvider([
            'query' => Task::find()->byCreator(Yii::$app->user->id),
        ]);

        return $this->render('my', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * * Lists all shared Tasks.
     * @return string
     */
    public function actionShared()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Task::find()->byCreator(Yii::$app->user->id)->innerJoinWith(Task::RELATION_TASK_USERS),
        ]);


        return $this->render('shared', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * * Lists all shared Tasks.
     * @return string
     */
    public function actionAccessed()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Task::find()->where(['<>', 'task.creator_id', Yii::$app->user->id])->andWhere(['user_id' => Yii::$app->user->id])->innerJoinWith(Task::RELATION_TASK_USERS)->innerJoinWith(Task::RELATION_USERS),
        ]);

        return $this->render('accessed', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Task::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        /*->innerJoinWith(User::RELATION_CREATED_TASKS)
        ->innerJoinWith(Task::RELATION_TASK_USERS)
        ->where(['task.creator_id' => Yii::$app->user->id])
        ->andWhere(['task.id'=>'task_user.task_id'])*/
        $sql = User::find()
            ->select('user_id')
            ->innerJoin('task_user', ['task_id' => $id])
            ->where(['user.id' => Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => User::find()
                ->select(['username', 'task_user.id'])
                ->innerJoinWith(User::RELATION_TASK_USERS)
                ->where(['user.id' => $sql])
                ->andWhere(['task_id' => $id])

        ]);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'The task is create successfully');
            return $this->redirect(['my']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->creator_id != Yii::$app->user->id) {
            throw new ForbiddenHttpException('Access is denied! You can only edit tasks that you have created!');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'The task is update successfully');
            return $this->redirect(['my']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->creator_id != Yii::$app->user->id) {
            throw new ForbiddenHttpException('Access is denied! Only created tasks can be deleted !');
        }

        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'The task is delete successfully');

        return $this->redirect(['my']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
