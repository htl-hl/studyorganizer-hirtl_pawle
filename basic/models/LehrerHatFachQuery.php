<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LehrerHatFach]].
 *
 * @see LehrerHatFach
 */
class LehrerHatFachQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LehrerHatFach[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LehrerHatFach|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
