<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'name' => 'Ссылки и Картинки', // 1) Установить имя app
    'defaultRoute' => 'primary/index', // 2) Установить default controller
    'id' => 'basic1',
    'language'=>'ru', // Опция так же изм. язык сообщений об ошибках при заполн. форм
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '123',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            // редирект для действия по умолчанию (вместо site/login)
            'loginUrl' => ['/protect/login'],
            // редирект после успешной авторизации ( мешает работе $this->redirect(Url::previous()) )
            //'returnUrl' => ['/control/index'],
        ],
        'errorHandler' => [
            'errorAction' => 'primary/error', // 3) Установить default controller errorAction
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => require(__DIR__ . '/urlManager.php'), // 4) Включить ЧПУ
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    // $config['bootstrap'][] = 'debug';
    // $config['modules']['debug'] = 'yii\debug\Module';

    // $config['bootstrap'][] = 'gii';
    // $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
