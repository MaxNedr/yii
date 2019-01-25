<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskUser */

$this->title = 'Create Task User';
$this->params['breadcrumbs'][] = ['label' => 'Task Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
