<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Aufgaben $model */

$this->title = Yii::t('app', 'Aufgabe hinzufügen');
?>
<div class="aufgaben-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'faecherList' => $faecherList,
        'lehrerList' => $lehrerList,
    ]) ?>

</div>
