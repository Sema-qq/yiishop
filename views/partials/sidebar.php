<?php use yii\helpers\Url; ?>
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Каталог</h2>
        <div class="panel-group category-products">
            <?php foreach ($categories as $category):?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="<?= Url::toRoute(['site/category', 'id'=>$category->id])?>"
                                                   class="<?php if ($categoryId->category_id == $category->id) echo 'active'; ?>">
                                (<?= $category->getProductsCount();?>)  <?= $category->name; ?></a>
                        </h4>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>