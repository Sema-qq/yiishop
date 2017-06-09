<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Обратная связь:';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center"><?= Html::encode($this->title) ?></h2>
                    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
                        <div class="alert alert-success">
                            Благодарим Вас за обращение к нам. Мы ответим Вам как можно скорее..
                        </div>
                    <?php else: ?>

                        <div class="alert alert-warning">
                                Если у вас есть деловые вопросы или другие вопросы, заполните форму, чтобы связаться с нами.
                            Спасибо.
                        </div>
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                        <div class="form-group col-md-6">
                            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Имя', 'value' => Yii::$app->user->identity->name])->label('Имя')?>
                        </div>
                        <div class="form-group col-md-6">
                            <?= $form->field($model, 'email')->textInput(['placeholder' => 'Электронная почта', 'value' => Yii::$app->user->identity->email])->label('Электронная почта')?>
                        </div>
                        <div class="form-group col-md-12">
                            <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Тема сообщения'])->label('Тема сообщения')?>
                        </div>
                        <div class="form-group col-md-12">
                            <?= $form->field($model, 'body')->textarea(['placeholder' => 'Сообщение', 'rows'=> 8])->label('Текст')?>
                        </div>
                        <div class="form-group col-md-12">
                            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                            ]) ?>
                        </div>
                        <div class="form-group col-md-12">
                            <?= Html::submitButton('Отправить', ['class' => 'btn btn-default', 'name' => 'login-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Контактная информация:</h2>
                    <address>
                        <p>E-Shopper Inc.</p>
                        <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                        <p>Newyork USA</p>
                        <p>Mobile: +2346 17 38 93</p>
                        <p>Fax: 1-714-252-0026</p>
                        <p>Email: info@e-shopper.com</p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Социальные сети:</h2>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-vk"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/#contact-page-->