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
                    <h2 class="title text-center"><?= $categoryName->name;?></h2>
                    <?= $this->render('/partials/center', ['products'=>$products]);?>

                </div><!--features_items-->
                <?= LinkPager::widget(['pagination'=>$pagination]);?>
            </div>
        </div>
    </div>
</section>