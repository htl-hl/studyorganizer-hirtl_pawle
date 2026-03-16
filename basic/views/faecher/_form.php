<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Faecher $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $dropdown */
?>

<div class="faecher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'F_Name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
       <label class="control-label"><?= $model->getAttributeLabel('selectedLehrerIds') ?></label>
        <?= Html::activeCheckboxList($model, 'selectedLehrerIds', $dropdown, [
            'item' => function ($index, $label, $name, $checked, $value) {
                // Customizing each checkbox for better layout
                $checkbox = Html::checkbox($name, $checked, ['value' => $value, 'id' => 'lehrer-' . $value]);
                return '<div class="checkbox">' . Html::label($checkbox . ' ' . $label, 'lehrer-' . $value) . '</div>';
            }
        ]) ?>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
