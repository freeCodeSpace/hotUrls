<?php

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "news".
 *
 * @property integer $news_id
 * @property string $title
 * @property string $url
 */
class News extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['url'], 'string', 'max' => 5000],
            [['title'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'title' => 'Новость:',
            'url' => 'Url:',
        ];
    }

    /**
     * Проверка условия до выполнения валидации.
     * Сообщение об ошибке, будет выведенно в соотв. файле view.
     * Проверка на допустимое имя пользователя.
     * Тестовая заглушка (имитация ролей)
     */
    public function beforeValidate() {
        $msgError = User::checkUser();
        if ( $msgError != false ) { // проверка на права доступа на изменен. данных (доступа нет есть)
            $this->addError('accessErrorMsg', $msgError);
            return false; // остановить дальнейшую валидацию
        }
        // если условие выше пропущено, вызвать стандартную обработку
        return parent::beforeValidate();
    }

}