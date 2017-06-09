<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<section>
    <div class="container">
        <div class="row">
            <?= $this->render('/partials/sidebar', ['categories'=>$categories]);?>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Новые товары</h2>
                    <?php foreach ($new as $product):?>
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

                </div><!--features_items-->
<!--                --><?//= LinkPager::widget(['pagination'=>$pagination]);?>



                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Рекомендуемые товары</h2>

                    <div class="cycle-slideshow"
                         data-cycle-fx=carousel
                         data-cycle-timeout=5000
                         data-cycle-carousel-visible=3
                         data-cycle-carousel-fluid=true
                         data-cycle-slides="div.item"
                         data-cycle-prev="#prev"
                         data-cycle-next="#next"
                    >
                        <?php foreach ($recomended as $product): ?>
                            <div class="item">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?= $product->getImage(); ?>" alt="" />
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
                        <a class="left recommended-item-control" id="prev" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i></a>
                        <a class="right recommended-item-control" id="next"  href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>



                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->render('/partials/modal');?>