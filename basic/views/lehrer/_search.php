<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LehrerSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="lehrer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'L_ID') ?>

    <?= $form->field($model, 'Vorname') ?>

    <?= $form->field($model, 'Nachname') ?>

    <?= $form->field($model, 'Kuerzel') ?>

    <?= $form->field($model, 'Aktiv') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
