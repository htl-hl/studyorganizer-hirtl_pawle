<?php

use app\models\Lehrer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\LehrerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Lehrer');
$this->params['breadcrumbs'][] = $this->title;
$isAdmin = !Yii::$app->user->isGuest && Yii::$app->user->identity->Role == 'Admin';
?>
<div class="lehrer-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($isAdmin): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Lehrer erstellen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'L_ID',
            'Vorname',
            'Nachname',
            'Kuerzel',
            'Aktiv',
            [
                'class' => ActionColumn::class,
                'visible' => $isAdmin, // Spalte nur für Admins sichtbar
                'urlCreator' => function ($action, Lehrer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'L_ID' => $model->L_ID]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
