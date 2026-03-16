<?php

/** @var yii\web\View $this */
/** @var app\models\Aufgaben[] $aufgaben */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Homepage';

// Sort tasks: undone first, then done tasks
usort($aufgaben, function($a, $b) {
    if ($a->Erledigt == $b->Erledigt) {
        return 0;
    }
    return $a->Erledigt ? 1 : -1;
});

?>
<div class="site-index">

    <div class="row row-cols-1 row-cols-md-3 g-4" id="aufgaben-container">
        
        <!-- Add New Task Card -->
        <div class="col">
            <a href="<?= Url::to(['aufgaben/create']) ?>" class="text-decoration-none">
                <div class="card add-card h-100 d-flex justify-content-center align-items-center" style="min-height: 200px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                    <span class="mt-2 fw-bold text-secondary">Neue Aufgabe</span>
                </div>
            </a>
        </div>

        <?php foreach ($aufgaben as $aufgabe): ?>
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
        <?php endforeach; ?>
    </div>
</div>

<?php
$toggleUrl = Url::to(['aufgaben/toggle-erledigt']);
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;

$js = <<<JS
$(document).on('click', '.clickable-card', function(e) {
    // Don't toggle if clicking on a link (e.g. title)
    if ($(e.target).closest('a').length) {
        return;
    }

    var card = $(this);
    var aufgabenId = card.data('id');
    var checkbox = card.find('.task-erledigt-checkbox');
    var isChecked = !checkbox.is(':checked'); // Toggle logic: current state is checkbox state, new state is opposite
    
    // Optimistic UI update
    checkbox.prop('checked', isChecked);
    
    var cardCol = $('#aufgabe-' + aufgabenId);
    var aufgabenContainer = $('#aufgaben-container');

    var postData = {
        id: aufgabenId
    };
    postData['{$csrfParam}'] = '{$csrfToken}'; // Use dynamic CSRF parameter name

    $.ajax({
        url: '{$toggleUrl}',
        type: 'POST',
        data: postData,
        success: function(response) {
            if (response.success) {
                if (isChecked) {
                    card.addClass('task-done');
                    cardCol.attr('data-erledigt', '1');
                    // Move to bottom
                    aufgabenContainer.append(cardCol);
                } else {
                    card.removeClass('task-done');
                    cardCol.attr('data-erledigt', '0');
                    // Move back up
                    var firstDoneCard = aufgabenContainer.find('.aufgaben-card-col[data-erledigt="1"]').first();
                    if (firstDoneCard.length) {
                        cardCol.insertBefore(firstDoneCard);
                    } else {
                        aufgabenContainer.find('.col').last().before(cardCol);
                    }
                }
                // Update badge text
                var badge = card.find('.status-badge');
                if (isChecked) {
                    badge.removeClass('bg-warning text-dark').addClass('bg-success').text('Erledigt');
                } else {
                    badge.removeClass('bg-success').addClass('bg-warning text-dark').text('Offen');
                }
                
                // Re-sort all cards visually
                sortCards();

            } else {
                alert('Fehler beim Aktualisieren: ' + (response.errors ? JSON.stringify(response.errors) : 'Unbekannter Fehler'));
                checkbox.prop('checked', !isChecked); // Revert checkbox state on error
            }
        },
        error: function() {
            alert('Serverfehler beim Aktualisieren.');
            checkbox.prop('checked', !isChecked); // Revert checkbox state on error
        }
    });
});

function sortCards() {
    var container = $('#aufgaben-container');
    var cards = container.children('.aufgaben-card-col').get();
    
    cards.sort(function(a, b) {
        var aDone = $(a).attr('data-erledigt') === '1';
        var bDone = $(b).attr('data-erledigt') === '1';
        
        if (aDone === bDone) return 0;
        return aDone ? 1 : -1;
    });
    
    var addCard = container.children('.col').first();
    $(cards).each(function(index, card) {
        $(card).insertAfter(addCard);
        addCard = $(card);
    });
}
JS;
$this->registerJs($js);
?>
