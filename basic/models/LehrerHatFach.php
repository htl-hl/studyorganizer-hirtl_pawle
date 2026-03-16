<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Lehrer_hat_Fach".
 *
 * @property string $LHF_F_Name
 * @property int $LHF_L_ID
 *
 * @property Faecher $lHFFName
 * @property Lehrer $lHFL
 */
class LehrerHatFach extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Lehrer_hat_Fach';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LHF_F_Name', 'LHF_L_ID'], 'required'],
            [['LHF_L_ID'], 'integer'],
            [['LHF_F_Name'], 'string', 'max' => 255],
            [['LHF_F_Name', 'LHF_L_ID'], 'unique', 'targetAttribute' => ['LHF_F_Name', 'LHF_L_ID']],
            [['LHF_F_Name'], 'exist', 'skipOnError' => true, 'targetClass' => Faecher::class, 'targetAttribute' => ['LHF_F_Name' => 'F_Name']],
            [['LHF_L_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Lehrer::class, 'targetAttribute' => ['LHF_L_ID' => 'L_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LHF_F_Name' => Yii::t('app', 'Lhf F Name'),
            'LHF_L_ID' => Yii::t('app', 'Lhf L ID'),
        ];
    }

    /**
     * Gets query for [[LHFFName]].
     *
     * @return \yii\db\ActiveQuery|StundenplanQuery
     */
    public function getLHFFName()
    {
        return $this->hasOne(Faecher::class, ['F_Name' => 'LHF_F_Name']);
    }

    /**
     * Gets query for [[LHFL]].
     *
     * @return \yii\db\ActiveQuery|StundenplanQuery
     */
    public function getLHFL()
    {
        return $this->hasOne(Lehrer::class, ['L_ID' => 'LHF_L_ID']);
    }

    /**
     * {@inheritdoc}
     * @return LehrerHatFachQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LehrerHatFachQuery(get_called_class());
    }

}
