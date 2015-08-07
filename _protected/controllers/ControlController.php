<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\helpers\Url; // Для использования вызова сохраненной ранее ссылки
use yii\filters\AccessControl;
use app\models\Images;
use app\models\News;
use app\models\User;

class ControlController extends Controller
{

    /**
     * Метод выводит формы для заполнения
     * Метод сохраняет данные (таб. News и табл. Images) в БД (при успешной валидации)
     */
    public function actionIndex()
    {
        $news = new News();
        $images = new Images();
        // если модель заполнена данными из POST и сохранение данных (вместе с валидацией)
        // достаточно полное заполнение либо одной либо 2-й формы
        if ( ($news->load(Yii::$app->request->post()) && $news->save()) ||
             ($images->load(Yii::$app->request->post()) && $images->save())
            ) {
            return $this->redirect(['/control/index']); // вывести заполнить форму
        } else {
            return $this->render('create', [
                'news' => $news,
                'images' => $images
            ]);
        }
    }

    /*                           *\
        --- Управление News ---
    \*                           */
    /**
     * Метод управления ссылками новостей
     * Метод выводит список всех записей новостей с возможностью их редактирования, удаления
     * список состоит из 15ти полей на странице, если записей больше выводится пагинация.
     * при редактировании вызывается отдельная страница
     * (#возможное улучшение - мгновенное редактирование)
     */
    public function actionNews()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find(),
            'sort' => false, // отключить возможность сортировки в gridView
            'pagination' => [
                'defaultPageSize' => 15, // установить кол-во записей на стр.
              // Префикс размера стр. на странице в URL(если не установлен defaultPageSize)
                // 'pageSize' => 3, // тоже что и defaultPageSize но будет выводить префикса pageSizeParam
                // 'pageSizeParam' => 'size', // замена префикса per-page
            ],
        ]);
        return $this->render('news', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Метод реализует обновление данных по записи из таблицы news
     */
    public function actionNewsUpdate($id)
    {
        $model = $this->findNewsModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous()); // Возьмем URL который был запомнен ранее
        } else {
            return $this->render('newsUpdate', ['model' => $model,]);
        }
    }

    /**
     * Метод реализует удаление данных по записи из таблицы news
     */
    public function actionNewsDelete($id)
    {
        $msgClearNews = User::checkUser();
        if ( $msgClearNews === false ) { // проверка на права доступа на изменен. данных (доступ есть)
            $this->findNewsModel($id)->delete();
            return $this->redirect(Url::previous()); // Возьмем URL который был запомнен ранее
        }
        return $this->render('clear', [
            'msg' => $msgClearNews
        ]);
    }

    /**
     * Метод очищает все записи в таблице News
     * Перенаправляет на заполнение формы
     */
    public function actionClearNews()
    {
        $msgClearNews = User::checkUser();
        if ( $msgClearNews === false ) { // проверка на права доступа на изменен. данных (доступ есть)
            News::deleteAll(); // удалить данные в News
            $msgClearNews = "Данные в таблице News удалены"; // отправить сообщение об успешном удалении
        }
        return $this->render('clear', [
            'msg' => $msgClearNews
        ]);
    }

    /**
     * Метод находит запись в таблице News по id 
     * и возвращает данную запись (возвращает модель)
     * если ее нет, выводит сообщение об ошибке
     */
    protected function findNewsModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Данной записи не существует');
        }
    }

    /*                           *\
        --- Управление Images ---
    \*                           */
    /**
     * Метод управления ссылками картинок
     * Метод выводит список всех записей картинок с возможностью их редактирования, удаления
     * список состоит из 15ти полей на странице, если записей больше выводится пагинация.
     * при редактировании вызывается отдельная страница
     * (#возможное улучшение - мгновенное редактирование)
     */
    public function actionImages()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Images::find(),
            'sort' => false, // отключить возможность сортировки в gridView
            'pagination' => [
                'defaultPageSize' => 15, // установить кол-во записей на стр.
            ],
        ]);
        return $this->render('images', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Метод реализует обновление данных по записи из таблицы images
     */
    public function actionImagesUpdate($id)
    {
        $model = $this->findImagesModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous()); // Возьмем URL который был запомнен ранее
        } else {
            return $this->render('imagesUpdate', ['model' => $model,]);
        }
    }

    /**
     * Метод реализует удаление данных по записи из таблицы images
     */
    public function actionImagesDelete($id)
    {
        $msgClearImages = User::checkUser();
        if ( $msgClearImages === false ) { // проверка на права доступа на изменен. данных (доступ есть)
            $this->findImagesModel($id)->delete();
            return $this->redirect(Url::previous()); // Возьмем URL который был запомнен ранее
        }
        return $this->render('clear', [
            'msg' => $msgClearImages
        ]);
    }

    /**
     * Метод находит запись в таблице Images по id 
     * и возвращает данную запись (возвращает модель)
     * если ее нет, выводит сообщение об ошибке
     */
    protected function findImagesModel($id)
    {
        if (($model = Images::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Данной записи не существует');
        }
    }

    /**
     * Метод очищает все записи в таблице Images
     * Перенаправляет на заполнение формы
     */
    public function actionClearImages()
    {
        $msgClearImages = User::checkUser();
        if ( $msgClearImages === false ) { // проверка на права доступа на изменен. данных (доступ есть)
            Images::deleteAll();  // удалить данные в Images
            $msgClearImages = "Данные в таблице Images удалены"; // отправить сообщение об успешном удалении
        }
        return $this->render('clear', [
            'msg' => $msgClearImages
        ]);
    }

        public function behaviors()
        {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    // Распространяется для всех действий
                    'rules' => [
                        [
                            //'actions' => [''], закоментированно - Распространяется для всех действий
                            'allow' => true, // разрешить обращение
                            'roles' => ['@'], // залогиненым пользователям
                        ],
                    ],
                ],
            ];
        }

    }