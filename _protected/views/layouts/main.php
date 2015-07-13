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
    <link rel="shortcut icon" href="<?= Yii::$app->urlManager->baseUrl; ?>/Favicon.ico" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

 <!-- 1)Head -->
    <div id="logo">

     <!-- Блок выход пользователя из сайта -->
        <div id="userLogOut">
            <?php
                if (Yii::$app->user->isGuest === false) {
                    echo Html::a('LogOut', ['/protect/logout']);
                }
            ?>
        </div>

        <div id="lineLogo">
            <?= Html::a('News and URLs', Yii::$app->homeUrl, ['id' => 'lineLogoHref']); ?>
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