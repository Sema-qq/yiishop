<?php
use yii\bootstrap\Modal;
use yii\helpers\Url; ?>
<?php foreach ($products as $product):?>
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="<?= $product->getImage(); ?>" alt="" style="height: 15em"/>
                    <h2>$<?= $product->price; ?></h2>
                    <a href="<?= Url::toRoute(['site/single', 'id'=>$product->id]); ?>"><p><?= $product->name; ?></p></a>
                    <a href="<?= Url::to(['cart/add', 'id'=>$product->id])?>" class="btn btn-default add-to-cart" data-id="<?= $product->id; ?>">
                        <i class="fa fa-shopping-cart"></i>В корзину</a>
                </div>
                <?php if ($product->is_new):?>
                <img class="new" alt="new" src="/public/images/home/new.png">
                <?php endif;?>
            </div>
        </div>
    </div>
<?php endforeach; ?>


