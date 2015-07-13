<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    
    Имя Контроллера: <span class="label label-success"><?= $this->context->uniqueId; ?></span>
    <br>
    Действие Контроллера: <span class="label label-success"><?= $this->context->action->id; ?></span>
    <br>

</div>
