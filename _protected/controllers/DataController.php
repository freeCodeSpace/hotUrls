<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Images;
use app\models\News;
use yii\helpers\Html;

/**
 * Отдельный вспомогательный класс для добавления данных.
 * Используется в случае демонстрационного удаления данных из БД.
 * Записывает в БД базовые демонстрационные ссылки (перед этим очищая таблицы).
 */
class DataController extends Controller
{
    /**
     * @var array с данными для таблицы News
     * синтаксическая запись такого вида: $arrNews = [ ['', ''], ['', ''] ]
     */
    private static $arrNews = [
        // (1)
        ['Греція погодилася на ключові вимоги кредиторів - Bloomberg',
        'http://www.eurointegration.com.ua/news/2015/07/10/7035770/'],
        // (2)
        ['Користувачі Facebook зможуть самі складати свою стрічку',
        'http://tsn.ua/nauka_it/koristuvachi-facebook-zmozhut-sami-skladati-svoyu-strichku-453396.html'],
        // (3)
        ['NASA набрало астронавтів для польотів на приватних космічних кораблях',
        'http://tsn.ua/nauka_it/nasa-nabralo-astronavtiv-dlya-polotiv-na-privatnih-kosmichnih-korablyah-453417.html'],
        // (4)
        ['Нацбанк сократил численность правления',
        'http://hronika.info/ekonomika/70225-nacbank-sokratil-chislennost-pravleniya.html'],
        // (5)
        ['Яндекс ищет специалистов для борьбы с Google',
        'http://itnovosti.org.ua/2015/07/internet/yandex-vs-google.html'],
        // (6)
        ['Анонсирован планшет Huawei T1 10',
        'http://itnovosti.org.ua/2015/06/soft/sistemy/android/huawei-t1-10.html'],
        // (7)
        ['Признанные красавицы последних 50 лет.',
        'http://hronika.info/fotoreportazhi/70227-priznannye-krasavicy-poslednih-50-let-foto.html'],
        // (8)
        ['Новак Джокович выиграл Уимблдон',
        'http://tvrain.ru/news/novak_dzhokovich_vyigral_uimbldon-390853/'],
        // (9)
        ['DS создает флагманскую модель',
        'http://news.infocar.ua/ds_sozdaet_flagmanskuyu_model_101343.html'],
        // (10)
        ['Школа будущего',
        'http://www.childbrand.ua/sitenews/4140.html'],
        // (11)
        ['Валидация компьютеризированных систем',
        'http://eizvestia.com/seminary/full/277-validaciya-kompyuterizirovannyh-sistem'],
        // (12)
        ['В Украине 28% жителей пользуются смартфонами',
        'http://delo.ua/tech/v-ukraine-28-zhitelej-polzujutsja-smartfonami-google-300145/'],
        // (13)
        ['Apple готовится к анонсу новой линейки iPod',
        'http://comments.ua/ht/519291-apple-gotovitsya-anonsu-novoy-lineyki.html'],
        // (14)
        ['Фото: как выглядит Сахара из космоса',
        'http://bit.ua/2015/07/sahara-desert-from-space/#followus'],
        // (15)
        ['HTC завершила второй квартал с убытком',
        'http://ageofcomp.info/soft/36541-htc-zavershila-vtoroj-kvartal-s-ubytkom.html'],
        // (16)
        ['Облачные пользователи Украины',
        'http://www.companion.ua/articles/content?id=298870'],
    ];
    /*
    Имеет вид:
    Array(
        [0] => Array(
                [0] => 'Греція погодилася на ключові вимоги кредиторів - Bloomberg'
                [1] => 'http://www.eurointegration.com.ua/news/2015/07/10/7035770/'
        )
        [1] => Array(
                [0] => 'Користувачі Facebook зможуть самі складати свою стрічку'
                [1] => 'http://tsn.ua/nauka_it/koristuvachi-facebook-zmozhut-sami-skladati-svoyu-strichku-453396.html'
            )
        ...
    )
    */

    /**
     * @var array с данными для таблицы Images
     */
    private static $arrImg = [
        ['https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcR16NebIohDu6RVvfdxOPMgtmd21W6CQw18fTK_dICNrUo1oyeFIA'],
        ['https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWyA3wrF-e4g0UFjsC83dv5RkWTW37quCu6Yl2-UwInRJLwxjT'],
        ['http://u0.s.progorodnn.ru/userfiles/picsquare/img-20150711133651-456.jpg']
    ];
    /*
    Имеет вид:
    Array(
        [0] => Array(
                [0] => 'https://encrypted-tbn2.gstatic...'
        )
        [1] => Array(
                [0] => 'https://encrypted-tbn0.gstatic.com/ima...'
            )
        ...
    )
    */

    /**
     * Метод очищает записи в таблицах Images и News
     * Заполняет таблицы начальным набором тестовых ссылок (Images и News) из массива.
     */
    public function actionAdd()
    {
        News::deleteAll(); // Выполняется удаление для предотвращения дублирования данных.
        // Множ. вставка данных для таблицы News
        $model = Yii::$app->db
            ->createCommand()
            ->batchInsert('news', ['title', 'url'], self::$arrNews)
            ->execute();
        // Множ. вставка данных для таблицы Images
        Images::deleteAll();
        $model = Yii::$app->db
            ->createCommand()
            ->batchInsert('images', ['url'], self::$arrImg)
            ->execute();
        // После выполнения, перенаправить на главную
        return $this->redirect(['/primary/index']);
        return;
    }

}