<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = \Yii::t('app', 'Cash operations');
?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation'   => false,
    'enableClientValidation' => true,
    'validateOnSubmit'       => true
]); ?>

<?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'user_id')->dropDownList($users)->label(Yii::t('app', 'User')) ?>

<?= $form->field($model, 'is_debit')->dropDownList([
    0 => \Yii::t('app', 'Withdrawal'),
    1 => \Yii::t('app', 'Entry'),
])->label(Yii::t('app', 'Type')) ?>

<?= $form->field($model, 'comment')->textarea(); ?>


<div class="form-group">
    <?= Html::submitButton('Make', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>