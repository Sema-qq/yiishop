<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'category_id',
//            'description:ntext',
            'code',
            'price',
            [
                'attribute' => 'availability',
                'value' => function($data)
                {
                    return !$data->availability ? 'Нет' : 'Да';
                },
                'format' => 'html',
            ],
            // 'brand',
            [
                'attribute' => 'is_new',
                'value' => function($data)
                {
                    return !$data->is_new ? 'Нет' : 'Да';
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'is_recommended',
                'value' => function($data)
                {
                    return !$data->is_recommended ? 'Нет' : 'Да';
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'status',
                'value' => function($data)
                {
                    return !$data->status ? 'Скрыт' : 'Отображается';
                },
                'format' => 'html',
            ],
            [
                'format' => 'html',
                'label' => 'Image',
                'value' => function ($data)
                {
                    return Html::img($data->getImage(),['width'=>100]);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
