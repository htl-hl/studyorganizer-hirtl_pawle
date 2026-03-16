<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Lehrer $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $faecherList */
/** @var array $selectedFaecher */
?>

<div class="lehrer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Vorname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nachname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kuerzel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Aktiv')->checkbox() ?>

    <?= HTML::label('Fächer', 'faecher-select', ['class' => 'control-label']) ?>
    <?= HTML::listBox('selectedFaecher', $selectedFaecher, $faecherList, [
            'id' => 'selectdFaecher',
        'class' => 'form-control',
        'multiple' => true,
        'size' => 6,
    ]) ?>

    <div class="form-group mt-4">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
