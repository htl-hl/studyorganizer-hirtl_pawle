<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AufgabenSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="aufgaben-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'Aufgaben_ID') ?>

    <?= $form->field($model, 'Titel') ?>

    <?= $form->field($model, 'Beschreibung') ?>

    <?= $form->field($model, 'Faelligkeitsdatum') ?>

    <?= $form->field($model, 'Erledigt') ?>

    <?php // echo $form->field($model, 'L_ID') ?>

    <?php // echo $form->field($model, 'F_Name') ?>

    <?php // echo $form->field($model, 'U_ID') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
