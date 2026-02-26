<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StundenplanAufgaben]].
 *
 * @see StundenplanAufgaben
 */
class StundenplanAufgabenQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StundenplanAufgaben[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StundenplanAufgaben|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
