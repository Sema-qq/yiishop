<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Загрузить фото', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Выбрать категорию', ['set-category', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'category_id',
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
            'brand',
            'image',
            'description:ntext',
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
        ],
    ]) ?>

</div>
