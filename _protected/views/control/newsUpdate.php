<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAssetAdm;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */

AppAssetAdm::register($this);
?>
<?= Html::a('Добавление данных', ['/control/index'], ['class' => 'btn btn-default buttonFlo']); ?>
<?= Html::a('Таблица news', ['/control/news'], ['class' => 'btn btn-default buttonFlo']); ?>
<?= Html::a('Таблица images', ['/control/images'], ['class' => 'btn btn-default buttonFlo']); ?>
<br><br>

<!-- Форма Обновления News -->
<?php $form = ActiveForm::begin([
    'options' => ['class' => 'mForm formUpNews'], // указать класс формы
]) ?>
<br>
<span class="mFormText" style="color: green;">Редактирование News:</span><br><br>

<?= $form->field($model, 'title')->textarea([
    'class' => 'inputData inputDataTitle',
])->label($model->getAttributeLabel('title'), ['class' => 'mFormText']); // с заданием класса для label?>

<?= $form->field($model, 'url')->textarea([
    'class' => 'inputData',
])->label($model->getAttributeLabel('url'), ['class' => 'mFormText']); // с заданием класса для label ?>

<?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?= Html::a('Удалить', ['/control/news-delete', 'id' => $model->news_id], ['class' => 'btn btn-danger']); ?>
<br><br>
<?php ActiveForm::end(); ?>