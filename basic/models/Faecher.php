<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Stundenplan.Faecher".
 *
 * @property string $F_Name
 */
class Faecher extends \yii\db\ActiveRecord
{


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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'F_Name' => Yii::t('app', 'F Name'),
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
