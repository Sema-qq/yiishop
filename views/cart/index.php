<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\Modal;
use yii\helpers\Html;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<section>
        <div class="container">
            <div class="row">
<!--                --><?//= $this->render('/partials/sidebar', ['categories'=>$categories]);?>

                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <h2 class="title text-center"><?= Html::encode($this->title) ?></h2>


                        <?php if (!empty($session['cart'])): ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Фото</th>
                                        <th>Наименование</th>
                                        <th>Количество</th>
                                        <th>Цена</th>
                                        <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($session['cart'] as $id => $item):?>
                                        <tr>
                                            <td><?= Html::img("@web/uploads/{$item['image']}", ['alt'=> $item['name'], 'height'=> 50])?></td>
                                            <td><?= $item['name']?></td>
                                            <td><?= $item['qty']?></td>
                                            <td><?= $item['price']?></td>
                                            <td><span class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="4">Итого:</td>
                                        <td><?= $session['cart.qty']?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">На сумму:</td>
                                        <td><?= $session['cart.sum']?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <h3>Корзина пуста</h3>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

