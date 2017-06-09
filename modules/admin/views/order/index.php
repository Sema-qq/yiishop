<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>-->
<!--        --><?//= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
//             'status',
             'name',
             'email:email',
             'phone',
            // 'addres',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
