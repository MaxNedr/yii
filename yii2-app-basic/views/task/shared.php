<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $dataProvider2 yii\data\ActiveDataProvider */

$this->title = 'Shared Tasks';
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

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{deleteAll} {view} {update} {delete}',
                'buttons' => array(
                    'deleteAll' => function ($url,\app\models\Task $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('remove');
                        return Html::a($icon, array('task-user/delete-all', 'taskId'=>$model->id),['data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],]);
                    }
                )
            ],
        ],
    ]); ?>


    <?php Pjax::end(); ?>
</div>
