<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Aufgaben $model */

$this->title = Yii::t('app', 'Update Aufgaben: {name}', [
    'name' => $model->Aufgaben_ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aufgabens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Aufgaben_ID, 'url' => ['view', 'Aufgaben_ID' => $model->Aufgaben_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="aufgaben-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
