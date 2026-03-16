<?php

/** @var yii\web\View $this */
/** @var app\models\Aufgaben[] $aufgaben */

use yii\helpers\Html;
$this->title = 'Homepage';

?>
<div class="site-index">

    <div class="row">
        <div class="col-4 p-3">
                    <a href="../aufgaben/create">
                        <svg xmlns="http://www.w3.org/2000/svg" height="75" width="75" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16" alignment="center">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                    </a>
        </div>
        <?php foreach ($aufgaben as $aufgabe): ?>
            <div class="col-4 p-3">
                <div class="card border border-3 <?= \app\models\Aufgaben::getTaskDueDateClass($aufgabe) ?> " style="height: 150px;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= Html::a(
                                    $aufgabe->Titel,
                                    ['aufgaben/view', 'Aufgaben_ID' => $aufgabe->Aufgaben_ID],
                                    ['class' => 'link-dark link-underline link-underline-opacity-0 link-underline-opacity-75-hover']
                            ) ?>
                        </h5>
                        <p class="card-text">
                            <?= Html::encode($aufgabe->F_Name) ?>
                            <br>
                            <?= Html::encode($aufgabe->Beschreibung) ?>
                            <br>
                            <strong>Fällig am:</strong> <?= Yii::$app->formatter->asDate($aufgabe->Faelligkeitsdatum, 'php:d.m.Y') ?>
                        </p>
                        <div class="card-footer">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Erledigt
                            </label>
                        </div>
                    </div>


                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
