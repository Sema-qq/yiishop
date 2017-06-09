<section>
    <div class="container">
        <div class="row">

            <h3>Кабинет пользователя</h3>

            <h4>Привет, <?= Yii::$app->user->identity->name; ?>!</h4>
            <ul>
                <li><a href="/auth/edit">Редактировать данные</a></li>
                <!--<li><a href="/cabinet/history">Список покупок</a></li>-->
            </ul>
            <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
            <div class="alert alert-success">
                Ваши данные успешно отредактированы.
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>