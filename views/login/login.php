<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-log-in"></i> Login
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'id'          => 'login-form',

            'fieldConfig' => [
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>
        
        <p class="clearfix">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary pull-right', 'name' => 'login-button']) ?>

        </p>
        <?php ActiveForm::end(); ?>
    </div>
</div>


