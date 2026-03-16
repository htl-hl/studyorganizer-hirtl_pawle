<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Aufgaben $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $faecherList */
/** @var array $lehrerList */
?>

<div class="aufgaben-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Titel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Beschreibung')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'F_Name')->dropDownList(
            $faecherList,
            [
                'prompt' => '-- Fach wählen --',
                'id' => 'fach-dropdown',
            ]
    ) ?>

    <?= $form->field($model, 'Faelligkeitsdatum')->textInput() ?>

    <?= $form->field($model, 'Erledigt')->checkbox() ?>

    <?= $form->field($model, 'L_ID')->dropDownList(
            $lehrerList,
            [
                    'prompt' => 'Wähle ein Fach',
                    'id' => 'lehrer-dropdown',
            ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$ajaxUrl = \yii\helpers\Url::to(['/aufgaben/get-lehrer-by-fach']);
$currentLehrerId = $model->L_ID ?? '';
$js = <<<JS
$('#fach-dropdown').on('change', function() {
    var fach = $(this).val();
    var lehrerDropdown = $('#lehrer-dropdown');

    if (!fach) {
        lehrerDropdown.html('<option value="">-- Zuerst Fach wählen --</option>');
        return;
    }

    $.get('$ajaxUrl', { fach: fach }, function(data) {
        var options = '<option value="">-- Lehrer wählen --</option>';
        $.each(data, function(id, name) {
            var selected = (id == '$currentLehrerId') ? ' selected' : '';
            options += '<option value="' + id + '"' + selected + '>' + name + '</option>';
        });
        lehrerDropdown.html(options);
    });
});

// Beim Bearbeiten: sofort Lehrer laden wenn Fach schon gesetzt
if ($$('#fach-dropdown').val()) {
    $('#fach-dropdown').trigger('change');
}
JS;
$this->registerJs($js);
?>
