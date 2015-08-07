<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAssetAdm;

AppAssetAdm::register($this);
?>


    <h3 style="margin-bottom: 20px;">Выполните вход:</h3>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-5 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-5 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox() ?>

    <div class="form-group" style="margin-left: 300px;">
        <h4>Для теста: </h4>
        <b>Имя: </b> nick<br>
        <b>psw: </b> 123456<br><br>
    </div>
    <b>(!) Изменение данных не доступно (!)</b><br> для данной гостевой учетной записи.<br><br>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

