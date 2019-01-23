<?php

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

    </div>

    <div class="body-content">

       <!-- <p><?/*= yii\widgets\DetailView::widget(['model' => $model]) */?></p>-->
        <p><?php \yii\helpers\VarDumper::dump($model) ?></p>
        <p><?php \yii\helpers\VarDumper::dump($model_1) ?></p>
        <p><?php \yii\helpers\VarDumper::dump($model_2) ?></p>

        <p>Test</p>


    </div>
</div>
