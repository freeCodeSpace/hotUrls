<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Images;
use app\models\News;
use yii\web\NotFoundHttpException; // для реализаций обработки ошибок (при выполн. запроса)

class PrimaryController extends Controller
{
    /**
     * Метод находит данные из таблиц News и Images в БД 
     * передает найденные данные ввиде массивов в вид вывода на экран
     */
    public function actionIndex()
    {
        // 1) Получим названия и ссылки новостей
        $news = News::find() // найти в модели
            ->asArray() // получить как массив
            ->orderBy(['news_id' => SORT_DESC]) // отсортировать по id, в обратном порядке
            ->all(); // получить все записи ввиде массива
        // 2) Получим ссылки на картинки
        $images = Images::find()
            ->asArray()
            ->orderBy(['images_id' => SORT_DESC])
            ->all();
        return $this->render('index', ['news' => $news, 'images' => $images,]); // выведет все записи
    }

    /**
     * Метод очищает все записи в таблице Img и News
     * Перенаправляет на главную страницу
     */
/*
    public function actionClearAll()
    {
        Images::deleteAll();
        News::deleteAll();
        return $this->redirect(['/primary/index']);
    }
*/
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}