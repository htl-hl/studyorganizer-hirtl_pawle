<?php

use app\models\Aufgaben;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\AufgabenSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Aufgabens');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aufgaben-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Aufgaben'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Aufgaben_ID',
            'Titel',
            'Beschreibung',
            'Faelligkeitsdatum',
            'Erledigt',
            //'L_ID',
            //'F_Name',
            //'U_ID',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Aufgaben $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Aufgaben_ID' => $model->Aufgaben_ID]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
