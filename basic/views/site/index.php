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
            <?= $this->render('../aufgaben/aufgaben',
                    ['aufgabe' => $aufgabe,
                            ]) ?>
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
    
    var cardCol = $('#aufgabe-' + aufgabenId);
    var aufgabenContainer = $('#aufgaben-container');
    var badge = card.find('.status-badge');

    // Optimistic UI update: Apply changes immediately
    checkbox.prop('checked', isChecked);
    
    if (isChecked) {
        card.addClass('task-done');
        cardCol.attr('data-erledigt', '1');
        // Update badge
        badge.removeClass('bg-warning text-dark').addClass('bg-success').text('Erledigt');
    } else {
        card.removeClass('task-done');
        cardCol.attr('data-erledigt', '0');
        // Update badge
        badge.removeClass('bg-success').addClass('bg-warning text-dark').text('Offen');
    }
    
    // Sort visually immediately
    sortCards();

    var postData = {
        id: aufgabenId
    };
    postData['{$csrfParam}'] = '{$csrfToken}'; // Use dynamic CSRF parameter name

    $.ajax({
        url: '{$toggleUrl}',
        type: 'POST',
        data: postData,
        success: function(response) {
            if (!response.success) {
                // Revert changes on error
                alert('Fehler beim Aktualisieren: ' + (response.errors ? JSON.stringify(response.errors) : 'Unbekannter Fehler'));
                revertChanges();
            }
        },
        error: function(xhr, status, error) {
            // Revert changes on error
            alert('Serverfehler beim Aktualisieren: ' + error);
            revertChanges();
        }
    });
    
    function revertChanges() {
        checkbox.prop('checked', !isChecked);
        if (!isChecked) { // Reverting from checked to unchecked (was originally unchecked)
             card.removeClass('task-done');
             cardCol.attr('data-erledigt', '0');
             badge.removeClass('bg-success').addClass('bg-warning text-dark').text('Offen');
        } else { // Reverting from unchecked to checked (was originally checked)
             card.addClass('task-done');
             cardCol.attr('data-erledigt', '1');
             badge.removeClass('bg-warning text-dark').addClass('bg-success').text('Erledigt');
        }
        sortCards();
    }
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
