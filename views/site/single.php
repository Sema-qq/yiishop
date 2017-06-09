<?php
use yii\helpers\Url;
?>
<section>
    <div class="container">
        <div class="row">
            <?= $this->render('/partials/sidebar', ['categories'=>$categories]);?>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="<?= $product->getImage();?>" alt="" style="height: 20em"/>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <img src="/public/images/product-details/new.jpg" class="newarrival" alt="" />
                                <h2><?= $product->name; ?></h2>
                                <p>Код товара: <?= $product->code;?></p>
                                <span>
                                            <span>US $<?= $product->price; ?></span>

                                            <a href="<?= Url::to(['cart/add', 'id'=>$product->id])?>" class="btn btn-default add-to-cart" data-id="<?= $product->id; ?>">
                        <i class="fa fa-shopping-cart"></i>В корзину</a>
                                        </span>
                                <p><b>Наличие:</b> На складе</p>
                                <p><b>Состояние:</b> Новое</p>
                                <p><b>Производитель:</b> <?= $product->brand; ?></p>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Описание товара</h5>
                            <p><?= $product->description; ?></p>
                        </div>
                    </div>
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>