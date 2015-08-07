<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $email
 * @property string $auth_key
 * @property integer $created_at
 * @property integer $updated_at (!) тут он не используется (для reset-psw)
 * @property string $password write-only password
 */

/*
    Эта модель используется как для Входа так и для регистрации пользователя.
*/
class User extends ActiveRecord implements IdentityInterface
{

    // Значение административного статуса пользователя в БД.
    private static $adminStatus = 'master'; 

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(), // для работы с установкой даты созд. записи
        ];
    }

    /**
     * данный метод используется для получения записи по пользователю (по id из БД)
     * после того, как осуществлен вход, можно будет получить, например имя пользователя
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" не реализовано.');
    }

    /**
     * Находит пользователя согласно полученному username
     * @param string $username
     * @return static|null (возвращает объект с массивом с данными о пользователе)
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * вернуть первичный ключ в виде массива (метод из AR)
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Возвращает ключ который может быть использован для проверки
     * правильности переданного удостоверяеющего ID пользователя.
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Валидирует пароль. Вызывается в LoginForm (в правилах rules()).
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     * Перед записью в базу для каждого пользователя нужно генерировать хэш пароля
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     * Перед записью в базу для каждого пользователя нужно генерировать дополнительный ключ автоматической аутентификации
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Проверка на допустимое статус пользователя.
     * Может ли пользователь изменять данные в БД
     * Вызывается напрямую из:
     *   model: News->beforeValidate, Images->beforeValidate; control
     *   Controller: Control->ClearNews, ClearImages, NewsDelete, ImagesDelete
     * Тестовая заглушка (имитация ролей)
     */
    public function checkUser() {
        $userName = Yii::$app->user->identity->username;
        $status = User::findByUsername($userName)->status;
        if ( $status != self::$adminStatus ) {
            return 'Данная учетная запись: ' .$userName. ' не позволяет работать с данными в БД.';
        }
        return false;
    }

}