<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use \yii\helpers\Url;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/i50011.png', ['style' => 'position: relative;bottom: 15px;']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
//            'class' => 'navbar-fixed-top',
            'id' => 'main-menu',
        ],
    ]);

    $nav = [
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' =>'Главная <span class="glyphicon glyphicon-home"></span>','url' => ['/site/index']],
            ['label' =>'Эл.курс', 'url' => ['/parse/xml']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
            ['label' => 'Войти', 'url' => ['/site/login']]

            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->login. ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
        'encodeLabels'=>false
    ];

    if (empty(Yii::$app->session->get('id'))){
        $nav['items'][2]=['label' => 'Регистрация', 'url' => ['/site/signup']];
    }else {
        $nav['items'][2]=['label' =>'Личный кабинет', 'url' => ['/personal/user']];
        $nav['items'][5]=$nav['items'][3];
        $nav['items'][3]= ['label' => 'Сообщения' . Html::tag('span', "_", ['class' => 'badge','id'=>"msg"]),'url' => ['/personal/messages']];
    }
    if (Yii::$app->session->get('id')=='4'){
        $nav['items'][6]=$nav['items'][5];
        $nav['items'][5]=['label' =>'Администрирование' . Html::tag('span', "_", ['class' => 'badge','id'=>"admin"]),'url' => ['/admin']];
    }
    echo Nav::widget($nav);
    NavBar::end();
    ?>

    <div class="container">
        <div class="row" style="min-height:800px;background: #fff;">
            <div class="col-lg-3" style="margin: 0 auto;">
                <ul style="text-align:center;font-size: 18px;list-style-type:none;">
                    <h3 style="text-align:center;margin-bottom: 30px;">Меню:</h3>
                    <li><a href="<?php echo Url::toRoute(["personal/user"]);?>">Персональные данные</a></li>
                    <li style="margin-top: 10px;"><a href="<?php echo Url::toRoute(["personal/payment"]);?>">Платежные реквизиты</a></li>
                    <li style="margin-top: 10px;"><a href="<?php echo Url::toRoute(["personal/propositions"]);?>">Мои объявления</a></li>
                    <li style="margin-top: 10px;"><a href="<?php echo Url::toRoute(["personal/messages"]);?>">Сообщения</a></li>
                </ul>
            </div>

            <?= $content ?>
            <div>
        </div>
    </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
