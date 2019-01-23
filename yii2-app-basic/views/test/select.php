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

        <!-- <p><? /*= yii\widgets\DetailView::widget(['model' => $model]) */ ?></p>-->
        <p>Четвертое задание, вариант "а":</p>
        <p><?php \yii\helpers\VarDumper::dump($model) ?></p>
        <p>Четвертое задание, вариант "б":</p>
        <p><?php \yii\helpers\VarDumper::dump($model_1) ?></p>
        <p>Четвертое задание, вариант "в":</p>
        <p><?php \yii\helpers\VarDumper::dump($model_2) ?></p>
        <p>Дополнительное задание:</p>
        <p><?php \yii\helpers\VarDumper::dump($model_3) ?></p>


    </div>
</div>
