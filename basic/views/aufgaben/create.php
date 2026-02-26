<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Aufgaben $model */

$this->title = Yii::t('app', 'Create Aufgaben');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aufgabens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aufgaben-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
