<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Faecher]].
 *
 * @see Faecher
 */
class StundenplanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Faecher[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Faecher|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
