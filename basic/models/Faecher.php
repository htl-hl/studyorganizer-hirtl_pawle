<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Stundenplan.Faecher".
 *
 * @property string $F_Name
 * @property Lehrer[] $lehrer
 */
class Faecher extends \yii\db\ActiveRecord
{
    public $selectedLehrerIds; // Property to hold selected teacher IDs from form

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Stundenplan.Faecher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['F_Name'], 'required'],
            [['F_Name'], 'string', 'max' => 255],
            [['F_Name'], 'unique'],
            [['selectedLehrerIds'], 'each', 'rule' => ['integer']], // Validate each ID as integer
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'F_Name' => Yii::t('app', 'F Name'),
            'selectedLehrerIds' => Yii::t('app', 'Lehrer'), // Label for the new field
        ];
    }

    /**
     * Get the teachers associated with this subject.
     *
     * @return ActiveQuery
     */
    public function getLehrer()
    {
        return $this->hasMany(Lehrer::class, ['L_ID' => 'LHF_L_ID'])
                    ->viaTable('Lehrer_hat_Fach', ['LHF_F_Name' => 'F_Name']);
    }

    /**
     * {@inheritdoc}
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // Save selected teachers to the junction table
        if (is_array($this->selectedLehrerIds)) {
            // Delete existing associations for this subject
            Yii::$app->db->createCommand()->delete('Lehrer_hat_Fach', ['LHF_F_Name' => $this->F_Name])->execute();

            // Insert new associations
            foreach ($this->selectedLehrerIds as $lehrerId) {
                Yii::$app->db->createCommand()->insert('Lehrer_hat_Fach', [
                    'LHF_F_Name' => $this->F_Name,
                    'LHF_L_ID' => $lehrerId,
                ])->execute();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function afterFind()
    {
        parent::afterFind();
        // Load associated teacher IDs into selectedLehrerIds for form pre-population
        $this->selectedLehrerIds = ArrayHelper::getColumn($this->getLehrer()->select('L_ID')->asArray()->all(), 'L_ID');
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
