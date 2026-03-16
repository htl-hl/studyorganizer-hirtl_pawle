<?php

use app\models\Faecher;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\FaecherSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Fächer');
$isAdmin = !Yii::$app->user->isGuest && Yii::$app->user->identity->Role == 'Admin';
?>
<div class="faecher-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($isAdmin): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Fach erstellen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'F_Name',
            [
                'class' => ActionColumn::class,
                'visible' => $isAdmin, // Spalte nur für Admins sichtbar
                'urlCreator' => function ($action, Faecher $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'F_Name' => $model->F_Name]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
