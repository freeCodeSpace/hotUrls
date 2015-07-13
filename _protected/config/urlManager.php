<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        // Правило для обработки пагинации ($_GET['page']) для images и news
        '<controller>/<action:(images|news)>/<page:\d+>' => '<controller>/<action>', // будет иметь вид control/images/1
         // Правило для обработки id
        '<controller>/<action:(news-update|news-delete|images-update|images-delete)>/<id:\d+>' => '<controller>/<action>',
    ],
];
