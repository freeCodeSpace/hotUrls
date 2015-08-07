<?php

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "images".
 *
 * @property integer $images_id
 * @property string $url
 */
class Images extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['url'], 'string', 'max' => 5000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'images_id' => 'Images ID',
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
