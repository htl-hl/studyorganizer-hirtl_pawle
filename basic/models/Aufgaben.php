<?php

namespace app\models;

use DateTime;
use Yii;

/**
 * This is the model class for table "Stundenplan.Aufgaben".
 *
 * @property int $Aufgaben_ID
 * @property string|null $Titel
 * @property string|null $Beschreibung
 * @property string|null $Faelligkeitsdatum
 * @property int|null $Erledigt
 * @property int $L_ID
 * @property string|null $F_Name
 * @property int $U_ID
 */
class Aufgaben extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Stundenplan.Aufgaben';
    }

    /**
     * @throws \Exception
     */
    public static function getTaskDueDateClass(Aufgaben $aufgabe): string
    {
        $now  = new DateTime();
        $dueDate = new DateTime($aufgabe->Faelligkeitsdatum);
        $diff = $now->diff($dueDate);
        //var_dump($aufgabe);

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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Titel', 'Beschreibung', 'Faelligkeitsdatum', 'Erledigt', 'F_Name'], 'default', 'value' => null],
            [['Faelligkeitsdatum'], 'safe'],
            [['Erledigt', 'L_ID', 'U_ID'], 'integer'],
            [['L_ID', 'U_ID'], 'required'],
            [['Titel', 'Beschreibung', 'F_Name'], 'string', 'max' => 255],
            [['L_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Lehrer::class, 'targetAttribute' => ['L_ID' => 'L_ID']],
            [['F_Name'], 'exist', 'skipOnError' => true, 'targetClass' => Faecher::class, 'targetAttribute' => ['F_Name' => 'F_Name']],
            [['U_ID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['U_ID' => 'U_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Aufgaben_ID' => Yii::t('app', 'Aufgaben ID'),
            'Titel' => Yii::t('app', 'Titel'),
            'Beschreibung' => Yii::t('app', 'Beschreibung'),
            'Faelligkeitsdatum' => Yii::t('app', 'Fälligkeitsdatum'),
            'Erledigt' => Yii::t('app', 'Erledigt'),
            'L_ID' => Yii::t('app', 'Lehrername'),
            'F_Name' => Yii::t('app', 'Fächername'),
            'U_ID' => Yii::t('app', 'U ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AufgabenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AufgabenQuery(get_called_class());
    }

    public static function sort(array $aufgaben): array
    {
        usort($aufgaben, function($a, $b) {
            $dateA = new DateTime($a->Faelligkeitsdatum);
            $dateB = new DateTime($b->Faelligkeitsdatum);

            if ($dateA == $dateB) {
                return 0;
            }
            return ($dateA < $dateB) ? -1 : 1;
        });

        return $aufgaben;
     }
}
