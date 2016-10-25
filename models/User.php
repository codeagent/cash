<?php

namespace app\models;

use yii\db\ActiveRecord;


/**
 * Class User
 * @package app\models
 * @property int 	$id
 * @property string 	$login
 * @property string 	$access_token
 * @property string	$password_hash
 * @property float $balance
 * @property int is_admin
 * @property int	created_at
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public $password;

    public static function tableName()
    {
        return 'users';
    }

    public function behaviors()
    {
        return [
            [
                'class'			            => 'yii\behaviors\TimestampBehavior',
                'updatedAtAttribute'	 => false
            ]
        ];
    }

    /**
     * Hash user password
     */
    public function hashPassword($attribute)
    {
        $this->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        throw new NotSupportedException('"getAuthKey" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException('"validateAuthKey" is not implemented.');
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
}
