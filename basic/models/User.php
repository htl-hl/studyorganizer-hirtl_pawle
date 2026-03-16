<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "User".
 *
 * @property int $U_ID
 * @property string $Username
 * @property string $Password
 * @property string $Role
 * @property string $authKey
 * @property string $accessToken
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return '{{%User}}';
    }

    public function rules()
    {
        return [
            [['Username', 'Password'], 'required'],
            [['Username', 'Password', 'Role', 'authKey', 'accessToken'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['U_ID' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['Username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->U_ID;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->Password);
    }
    
    /**
     * Mapping for lowercase username property expected by Yii2
     */
    public function getUsername()
    {
        return $this->Username;
    }

    /**
     * Mapping for lowercase username property expected by Yii2
     */
    public function setUsername($username)
    {
        $this->Username = $username;
    }
}
