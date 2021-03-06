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
<?= Html::a('Таблица images', ['/control/images'], ['class' => 'btn btn-default buttonFlo']); ?>
<?= Html::a('Таблица news', ['/control/news'], ['class' => 'btn btn-default buttonFlo']); ?>
<br><br>

<!-- Форма Обновления News -->
<?php $form = ActiveForm::begin([
    'options' => ['class' => 'mForm formUpNews'], // указать класс формы
]) ?>
<br>
<span class="mFormText" style="color: green;">Редактирование Images:</span><br><br>

<?= $form->field($model, 'url')->textarea([
    'class' => 'inputData',
])->label($model->getAttributeLabel('url'), ['class' => 'mFormText']); // с заданием класса для label ?>

<?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?= Html::a('Удалить', ['/control/images-delete', 'id' => $model->images_id], ['class' => 'btn btn-danger']); ?>
<br><br>
<?php ActiveForm::end(); ?>

<br>
<img src="<?= $model->url; ?>">

<br><b>
<?php
// Если есть, вывести ошибку о возможности изменения
// данных (для данного пользователя) используется в beforeValidate (в модели).
if (!empty($model->errors)) {
    echo $model->errors['accessErrorMsg'][0];
} ?>
</b>