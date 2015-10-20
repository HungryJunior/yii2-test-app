<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>
    <div class="jumbotron">
        <h2>Привет!</h2>
        <p class="lead">Чтобы зарегистрировать аккаунт - введи email,для получения ссылки.Если акк уже есть - кликни по "Войти"</p>
    </div>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'email')->label('') ?>

    <div class="form-group">
        <?= Html::submitButton('Получить ссылку', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>