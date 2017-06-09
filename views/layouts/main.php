<?php

use app\assets\PublicAsset;
use app\models\Cart;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

PublicAsset::register($this);
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

<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +7 963 081 81 96</a></li>
                            <li><a href="/site/contact"><i class="fa fa-envelope"></i> truehueta@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-vk"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="/"><img src="/public/images/home/logo.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#" onclick="return getCart()"><i class="fa fa-shopping-cart"></i> Корзина
                                    (<span id="cart-count"><?= Cart::countItems(); ?></span>)
<!--                                    (--><?//= Cart::countItems(); ?><!--)-->
<!--                                        (--><?//= Yii::$app->session['cart.qty']; ?><!--)-->
                                </a></li>
                            <?php if (Yii::$app->user->isGuest):?>
                                <li><a href="/auth/signup"><i class="fa fa-user"></i> Регистрация</a></li>
                                <li><a href="/auth/login"><i class="fa fa-lock"></i> Вход</a></li>
                            <?php else:?>
                                <li><a href="/auth/cabinet"><i class="fa fa-user"></i> Аккаунт</a></li>
                                <li><a href="/auth/exit"><i class="fa fa-unlock"></i> Выйти(<?= Yii::$app->user->identity->name; ?>)</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/">Главная</a></li>
                            <li class="dropdown"><a href="#">Магазин<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="/site/catalog">Каталог товаров</a></li>
                                    <li><a href="/site/cart">Корзина</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Блог</a></li>
                            <li><a href="/site/about">О магазине</a></li>
                            <li><a href="/site/contact">Контакты</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->

</header><!--/header-->

<?= $content ?>

<footer id="footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2017</p>
                <p class="pull-right">Интернет магазин by Sema</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->




<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php
Modal::begin([
    'header'=> '<h2>Корзина</h2>',
    'id'=> 'cart',
    'size'=> 'modal-lg',
    'footer'=> '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
                    <a href="'.Url::to(['cart/checkout']).'" class="btn btn-success">Оформить заказ</a>
                    <button type="button" class="btn btn-info" onclick="clearCart()">Очистить корзину</button> '
]);
Modal::end();
?>
