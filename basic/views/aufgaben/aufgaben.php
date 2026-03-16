<?php

use app\models\Aufgaben;
use yii\helpers\Html;

/** @var Aufgaben $aufgabe*/


?>

<div class="col aufgaben-card-col" id="aufgabe-<?= $aufgabe->Aufgaben_ID ?>" data-erledigt="<?= $aufgabe->Erledigt ?>">
    <!-- Added 'clickable-card' class and data attribute for ID -->
    <div class="card h-100 shadow-sm border-0 clickable-card <?= \app\models\Aufgaben::getTaskDueDateClass($aufgabe) ?> <?= $aufgabe->Erledigt ? 'task-done' : '' ?>" data-id="<?= $aufgabe->Aufgaben_ID ?>" style="cursor: pointer;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-light text-dark border"><?= Html::encode($aufgabe->F_Name) ?></span>
                <?php if ($aufgabe->Erledigt): ?>
                    <span class="badge bg-success status-badge">Erledigt</span>
                <?php else: ?>
                    <span class="badge bg-warning text-dark status-badge">Offen</span>
                <?php endif; ?>
            </div>

            <h5 class="card-title text-truncate" style="z-index: 10; position: relative;">
                <?= Html::a(
                    $aufgabe->Titel,
                    ['aufgaben/view', 'Aufgaben_ID' => $aufgabe->Aufgaben_ID],
                    ['class' => 'text-dark text-decoration-none task-link'] // Removed stretched-link
                ) ?>
            </h5>

            <p class="card-text text-muted small mb-3">
                <?= \yii\helpers\StringHelper::truncate(Html::encode($aufgabe->Beschreibung), 100) ?>
            </p>

            <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    <i class="bi bi-calendar-event me-1"></i>
                    Fällig: <?= Yii::$app->formatter->asDate($aufgabe->Faelligkeitsdatum, 'php:d.m.Y') ?>
                </small>

                <div class="form-check form-switch" style="pointer-events: none;"> <!-- Disable pointer events on switch so card click handles it -->
                    <input class="form-check-input task-erledigt-checkbox" type="checkbox" role="switch" id="erledigt-<?= $aufgabe->Aufgaben_ID ?>" <?= $aufgabe->Erledigt ? 'checked' : '' ?>>
                    <label class="form-check-label" for="erledigt-<?= $aufgabe->Aufgaben_ID ?>">Erledigt</label>
                </div>
            </div>
        </div>
    </div>
</div>



