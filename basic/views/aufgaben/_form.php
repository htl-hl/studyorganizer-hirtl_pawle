<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Aufgaben $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="aufgaben-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Titel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Beschreibung')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Faelligkeitsdatum')->textInput() ?>

    <?= $form->field($model, 'Erledigt')->textInput() ?>

    <?= $form->field($model, 'L_ID')->textInput() ?>

    <?= $form->field($model, 'F_Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'U_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
