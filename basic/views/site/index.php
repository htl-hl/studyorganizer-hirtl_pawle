<?php

/** @var yii\web\View $this */
/** @var Aufgaben[] $aufgaben */


use yii\helpers\Html;
$this->title = 'Homepage';

function getTaskDueDateClass(DateTime $dueDate): string
{
    $now  = new DateTime();
    $diff = $now->diff($dueDate);

    if ($dueDate < $now) {
        return 'border-danger'; // überfällig
    }

    $daysLeft = (int) $diff->days;

    return match(true) {
        $daysLeft < 1  => 'border-danger',
        $daysLeft < 7  => 'border-warning',
        $daysLeft < 14 => 'border-primary',
        default        => '',
    };
}
?>
<div class="site-index">

    <div class="row">
        <div class="col-4 p-3">
            <div class="card" style="height: 100px;">
                <div class="card-body">
                    <a href="../aufgaben/create">
                        <svg xmlns="http://www.w3.org/2000/svg" height="75" width="75" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16" alignment="center">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <?php foreach ($aufgaben as $aufgabe): ?>
            <?php
            $dueDate  = new DateTime($aufgabe->Faelligkeitsdatum);
            $cssClass = getTaskDueDateClass($dueDate);
            ?>
            <div class="col-4 p-3">
                <div class="card <?= $cssClass ?> border-3  " style="height: 100px;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= Html::a(
                                    $aufgabe->Titel,
                                    ['aufgaben/view', 'Aufgaben_ID' => $aufgabe->Aufgaben_ID],
                                    ['class' => 'link-dark link-underline link-underline-opacity-0 link-underline-opacity-75-hover']
                            ) ?>
                        </h5>
                        <p class="card-text">
                            <?= Html::encode($aufgabe->Beschreibung) ?>
                            <br>
                            <strong>Fällig am:</strong> <?= Html::encode($aufgabe->Faelligkeitsdatum)?>
                        </p>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
