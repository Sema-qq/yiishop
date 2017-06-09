<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1>Заказ № <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверене, что хотите удалить заказ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_id',
            'update_id',
            'qty',
            'sum',
            [
                'attribute' => 'status',
                'value' => function($data)
                {
                    return !$data->status ? '<span class="text-success">Активен</span>' : '<span class="text-danger">Завершен</span>';
                },
                'format' => 'html',
            ],
//            'status',
            'name',
            'email:email',
            'phone',
            'addres',
        ],
    ]) ?>

    <?php $items = $model->orderItems;?>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Наименование</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item):?>
                <tr>
                    <td><a href="<?= Url::to(['/site/single', 'id'=>$item->product_id]); ?>"><?= $item->name;?></a></td>
                    <td><?= $item->qty_item;?></td>
                    <td><?= $item->price;?></td>
                    <td><?= $item->sum_item;?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
