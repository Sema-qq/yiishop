<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="container">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <p>Ваш заказ принят. Мы свяжемся с Вами в ближайшее время!</p>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <p>Форма заполнена не правильно! Заказ не принят.</p>
        </div>
    <?php endif; ?>

    <?php if (!empty($session['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($session['cart'] as $id => $item):?>
                    <tr>
                        <td><?= Html::img("@web/uploads/{$item['image']}", ['alt'=> $item['name'], 'height'=> 50])?></td>
                        <td><a href="<?= Url::toRoute(['site/single', 'id'=>$id]); ?>"><?= $item['name']?></a></td>
                        <td><?= $item['qty']?></td>
                        <td><?= $item['price']?></td>
                        <td><?= $item['price']*$item['qty']?></td>
                        <td><span data-id="<?= $id?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5">Итого:</td>
                    <td><?= $session['cart.qty']?></td>
                </tr>
                <tr>
                    <td colspan="5">На сумму:</td>
                    <td><?= $session['cart.sum']?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr/>
        <?php $form = ActiveForm::begin()?>
            <?= $form->field($model, 'name')->textInput(['value' => Yii::$app->user->identity->name])?>
            <?= $form->field($model, 'email')->textInput(['value' => Yii::$app->user->identity->email])?>
            <?= $form->field($model, 'phone')->textInput()?>
            <?= $form->field($model, 'addres')->textarea(['rows'=>6])?>
            <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end()?>
    <?php else: ?>
        <h3>Корзина пуста</h3>
    <?php endif; ?>
</div>
<br/>