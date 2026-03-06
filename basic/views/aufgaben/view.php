<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Aufgaben $model */

$this->title = $model->Aufgaben_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aufgabens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="aufgaben-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'Aufgaben_ID' => $model->Aufgaben_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'Aufgaben_ID' => $model->Aufgaben_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Aufgaben_ID',
            'Titel',
            'Beschreibung',
            'Faelligkeitsdatum',
            'Erledigt',
            'L_ID',
            'F_Name',
            'U_ID',
        ],
    ]) ?>

</div>
