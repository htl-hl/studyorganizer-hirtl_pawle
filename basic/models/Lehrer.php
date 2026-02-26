<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Stundenplan.Lehrer".
 *
 * @property int $L_ID
 * @property string|null $Vorname
 * @property string|null $Nachname
 * @property string|null $Kuerzel
 * @property int|null $Status
 */
class Lehrer extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Stundenplan.Lehrer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Vorname', 'Nachname', 'Kuerzel', 'Status'], 'default', 'value' => null],
            [['Status'], 'integer'],
            [['Vorname', 'Nachname', 'Kuerzel'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'L_ID' => Yii::t('app', 'L ID'),
            'Vorname' => Yii::t('app', 'Vorname'),
            'Nachname' => Yii::t('app', 'Nachname'),
            'Kuerzel' => Yii::t('app', 'Kuerzel'),
            'Status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return StundenplanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StundenplanQuery(get_called_class());
    }

}
