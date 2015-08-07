<?php
use yii\helpers\Html;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->name) ?></title>
  <!-- FavIco -->
    <link rel="shortcut icon" href="<?= Yii::$app->urlManager->baseUrl; ?>img/favicon.ico" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

 <!-- 1)Head -->
    <div id="header">
        <div>
            <?= Html::a('Hot Urls', Yii::$app->homeUrl, ['class' => 'headerTitle']); ?>
            <span id="userBox">
                <?php
                    if (Yii::$app->user->isGuest === false) {
                        echo "User: <b>" . Yii::$app->user->identity->username . "</b> " .
                            Html::a('LogOut', ['/protect/logout'], ['class' => 'userLink']);
                    } else {
                        echo "Выполнить вход: " .
                            Html::a('LogIn', ['/protect/login'], ['class' => 'userLink LogIn']);
                    }
                ?>
            </span>
        </div>
    </div>

 <!-- 2)Content -->
    <div id="conteiner">
     <!-- 2.1)URLs -->
        <?= $content ?>
    </div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>