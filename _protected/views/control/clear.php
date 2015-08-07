<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAssetAdm;

AppAssetAdm::register($this);
?>

<?= Html::a('Добавление данных', ['/control/index'], ['class' => 'btn btn-default buttonFlo']); ?>
<?= Html::a('Таблица news', ['/control/news'], ['class' => 'btn btn-default buttonFlo']); ?>
<?= Html::a('Таблица images', ['/control/images'], ['class' => 'btn btn-default buttonFlo']); ?>

<br id="clearBoth">
<?php
echo "<br><b>" . $msg . "</b>";
?>