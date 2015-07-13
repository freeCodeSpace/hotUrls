<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
?>
<?= Html::a('Управление', ['/control/index'], ['class' => 'clearButtC goAdmin']); ?>
<br id="clearBoth">

<ul id="urlBox">
    <?php
    foreach ($news as $arr) {
        if ($arr['title'] === '') { // если пустое значение новости.
            $arr['title'] = 'сайт';
        }
        echo '<li>' . Html::a($arr['title'], $arr['url'], ['target' => '_blank', 'class' => 'newsUrl']) . "</li>";
    } ?>
</ul>

<?php
if (!empty($images)) { // если есть картинки, вывести панель
    echo '
        <br>
        <a id="panel_title" href="javascript:changePanel()">Картинки</a>
        <div id="panel">
    ';
    foreach ($images as $arr) {
        echo '<img src=" ' . $arr['url'] . ' "><br>';
    }
    echo '
        </div>
        <a id="panel_title2" href="javascript:changePanel()">▲</a>
    ';
    $this->registerJsFile(Yii::$app->homeUrl . 'js/jsPanel.js'); // с адресом от корня
}
?>

<!-- Очистка News и Images -->
<?php
/*
if ( !empty($news) || !empty($images) ) { // если есть новости либо картинки, вывести кнопку очистки
    echo '<br>' . '<span class="empt"></span>'; // блок разделитель
    echo Html::a('Просмотренно', ['/primary/clear-all'], ['class' => 'clearButtC']);
}
*/
?>