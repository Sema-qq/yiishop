<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Наименование') ?>

    <?= $form->field($model, 'code')->textInput()->label('Код товара') ?>

    <?= $form->field($model, 'price')->textInput()->label('Цена') ?>

    <?= $form->field($model, 'availability')->dropDownList([
        '0'=>'Нет',
        '1'=>'Да',
    ])->label('Наличие на складе') ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true])->label('Производитель') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Описание') ?>

    <?= $form->field($model, 'is_new')->dropDownList([
        '0'=>'Нет',
        '1'=>'Да',
    ])->label('Новый') ?>

    <?= $form->field($model, 'is_recommended')->dropDownList([
        '0'=>'Нет',
        '1'=>'Да',
    ])->label('Рекомендуемый') ?>

    <?= $form->field($model, 'status')->dropDownList([
        '1'=>'Отображается',
        '0'=>'Скрыт',
    ])->label('Статус') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
