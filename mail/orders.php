<?php
use yii\bootstrap\Modal;
use yii\helpers\Html; ?>


    <div class="table-responsive">
        <table style="width: 100%; border: 1px solid silver; border-collapse: collapse;">
            <thead>
            <tr style="background: #f9f9f9;">
                <th style="padding: 8px; border: 1px solid silver;">Наименование</th>
                <th style="padding: 8px; border: 1px solid silver;">Количество</th>
                <th style="padding: 8px; border: 1px solid silver;">Цена</th>
                <th style="padding: 8px; border: 1px solid silver;">Сумма</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($session['cart'] as $id => $item):?>
                <tr>
                    <td style="padding: 8px; border: 1px solid silver;"><?= $item['name']?></td>
                    <td style="padding: 8px; border: 1px solid silver;"><?= $item['qty']?></td>
                    <td style="padding: 8px; border: 1px solid silver;"><?= $item['price']?></td>
                    <td style="padding: 8px; border: 1px solid silver;"><?= $item['price']*$item['qty']?></td>
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


