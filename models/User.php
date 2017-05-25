<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public function setPassword($password)
    {
        $this->password = sha1($password);
    }

    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    //=============================================
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {
    }

    public function getPropositions()
    {
        return $this->hasMany(Propositions::className(), ['user_id' => 'id']);
    }

    public function getPayment_accounts()
    {
        return $this->hasMany(Payment_accounts::className(), ['user_id' => 'id']);
    }

    public function getAcounts()
    {
        return $this->hasMany(Acounts::className(), ['user_id' => 'id']);
    }
}