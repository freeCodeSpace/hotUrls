<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\AppAssetAdm;
use yii\helpers\Url;
AppAssetAdm::register($this);
?>

<?= Html::a('Добавление данных', ['/control/index'], ['class' => 'btn btn-default buttonFlo']); ?>
<?= Html::a('Таблица images', ['/control/images'], ['class' => 'btn btn-default buttonFlo']); ?>

<?php
if (empty($dataProvider->models)) { // Если нет данных
    $this->registerCss('
        #w0 { /* Добавим обтекание вокруг таблицы */
            clear: both;
            padding-top: 5px;
        }
    ');
}
?>
<div class="sport-news-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'emptyCell' => 'Управление:',
        'options' => ['class' => 'gridNews',],

        'columns' => [
            [ // учитывание пустого значения
                'attribute' => 'title',
                'label'=> 'Название новости:',
                'value' => function($data) {
                    // вернуть либо значение из БД (если оно есть, иначе прочерк)
                    return $data->title ? $data->title : '- // -';
                }
            ],
            [ // вывод данных обернутых в тег
                'attribute' => 'url',
                //'label'=> $data->url, // взять название из текущ. объекта
                'format'=>'raw', // для возможности использования далее тега
                'value' => function($data) {
                    return Html::a($data->url, $data->url, ['target' => '_blank', 'class' => 'gridUrlIn']);
                }
            ],
            [ // Конфигурация колонок update и delete
                'class' => 'yii\grid\ActionColumn', 
                'template' => '{update} &nbsp &nbsp {delete}',
                'controller' => 'control', // обозначение контроллера (тут он такой же)

                'buttons' => [ // индивидуальная конфигурация для кнопки update и delete
                    'update' => function ($url, $model) { // использ. для установки Controller/Action
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>'
                            , ['/control/news-update', 'id' => $model->news_id] // и передача id
                        );
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>'
                            , ['/control/news-delete', 'id' => $model->news_id],
                            [ 'data' => ['method' => 'post'], ]
                        );
                    },
                ],
            ],
        ],

        'pager' => [
            'firstPageLabel' => 'В начало', // Название для 1-й кнопки пагинации
            'lastPageLabel' => 'В конец', // Название для последней кнопки пагинации
        ],
    ]); ?>
</div>

    <?php
    // Сохраним текущую ссылку (вместе с позицией пагинации)
    Url::remember($_SERVER['REQUEST_URI']); // что бы потом вызывать (вернутся на то место пагинации после upDate)
    ?>