<?php
use yii\bootstrap\Modal;
use yii\helpers\Url; ?>
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