<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $dataProvider2 yii\data\ActiveDataProvider */

$this->title = 'Accessed Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'title',
            'description:ntext',
            'creator_id',
            [
                'label'=>'username',
                'content'=> function( $model){
                    $user = \app\models\User::findOne(['id' => $model->creator_id]);
                    return $user->username;
                }
            ],
            'created_at:datetime'



        ],
    ]); ?>


    <?php Pjax::end(); ?>
</div>
