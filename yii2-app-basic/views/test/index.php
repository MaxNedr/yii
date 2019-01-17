<?php

/* @var $this yii\web\View */
/* @var $model app\models\Product*/

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

    </div>

    <div class="body-content">

        <p><?= $model->price ?></p>
        <p><?= $model->id ?></p>
        <p><?= $model->name ?></p>
        <p><?= yii\widgets\DetailView::widget(['model'=>$model]) ?></p>
        <p>Test</p>

    </div>
</div>
