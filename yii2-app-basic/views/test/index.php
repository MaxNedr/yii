<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

    </div>

    <div class="body-content">
        <p><?= yii\widgets\DetailView::widget(['model'=>$model]) ?></p>



        <a href="/test/insert" class="btn btn-danger"> добавить записи</a>
        <a href="/test/select" class="btn btn-danger"> Select</a>

    </div>
</div>
