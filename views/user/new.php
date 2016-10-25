<?php
use yii\widgets\ActiveForm;
use app\models\Article;
use yii\helpers\Html;

$this->title = \Yii::t('app', 'Create new report');
?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation'   => false,
    'enableClientValidation' => true,
    'validateOnSubmit'       => true
]); ?>

<?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'article')->dropDownList(Article::getCatalog())->label(Yii::t('app', 'Article')) ?>


    <div class="form-group">
        <?= Html::submitButton(\Yii::t('app', 'Create new report'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>