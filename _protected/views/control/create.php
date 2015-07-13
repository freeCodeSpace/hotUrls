<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAssetAdm;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */

AppAssetAdm::register($this);
?>
<?= Html::a('Таблица news', ['/control/news'], ['class' => 'btn btn-default buttonFlo']); ?>
<?= Html::a('Таблица images', ['/control/images'], ['class' => 'btn btn-default buttonFlo']); ?>
<br><br>

  <!-- Форма Добавление News -->
    <?php $form = ActiveForm::begin([
        // 'id' => 'my-form', // указать id-формы (по умолч. с bootstrap id=w0)
        'options' => ['class' => 'mForm form1'], // указать класс формы
    ]) ?>
    <br>
    <span class="mFormText" style="color: green;">Добавление News:</span><br><br>

    <?= $form->field($news, 'title')->textarea([
        'class' => 'inputData inputDataTitle',
    ])->label($news->getAttributeLabel('title'), ['class' => 'mFormText']); // с заданием класса для label?>

    <?= $form->field($news, 'url')->textarea([
        'class' => 'inputData',
    ])->label($news->getAttributeLabel('url'), ['class' => 'mFormText']); // с заданием класса для label ?>


    <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    <br>
    <!-- Очистка News -->
    <?= Html::a('Очистить News', ['/control/clear-news'], ['class' => 'btn btn-danger clearButt']); ?>
    <?php ActiveForm::end(); ?>

  <!-- Форма Добавление Img -->
    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'mForm form2'],
    ]) ?>
    <br>
    <span class="mFormText" style="color: green;">Добавление Img:</span><br><br>

    <?= $form->field($images, 'url')->textarea([
        'class' => 'inputData',
    ])->label($images->getAttributeLabel('url'), ['class' => 'mFormText']); ?>

    <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    <br>
    <!-- Очистка Img -->
    <?= Html::a('Очистить Images', ['/control/clear-images'], ['class' => 'btn btn-danger clearButt']); ?>
    <?php ActiveForm::end(); ?>