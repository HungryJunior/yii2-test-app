<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
?>
<div class="site-login">
    <div class="col-lg-offset-5">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>


    <?php
    $form = ActiveForm::begin([
        'id'          => 'login-form',
        'options'     => ['class' => 'form-horizontal'],
        'fieldConfig' => [
                          'template'     => "<div class=\" col-lg-offset-2 col-lg-7\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                          'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'name') ?>
    <?= Html::submitButton('В кабинет..', ['class' => 'btn btn-lg btn-success col-lg-offset-4 col-lg-3', 'name' => 'login-button']) ?>


    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-10" style="color:#999;">
        Чтобы войти в кабинет - введи свой логин,в поле наверху.
        <a href = <?=\yii\helpers\Url::toRoute('site/index')?>/>Нет аккаунта?</a>

    </div>
    <div class="col-lg-offset-10" style="color:red;">
        <?=$error;?>
    </div>

</div>
