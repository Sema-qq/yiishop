<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Редактирование данных:';
$this->params['breadcrumbs'][] = $this->title;
?>
<section>
    <div id="contact-page" class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                    <div class="signup-form"><!--sign up form-->
                        <h2><?= Html::encode($this->title) ?></h2>
                        <p>Здесь Вы можете изменить имя пользователя и пароль:</p>
                        <?php $form = ActiveForm::begin([]); ?>
                        <div class="form-group">
                            <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'value' => Yii::$app->user->identity->name])->label('Имя:') ?>

                            <?= $form->field($model, 'password')->passwordInput()->label('Пароль:') ?>

                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-default', 'name' => 'login-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div><!--/sign up form-->

                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>