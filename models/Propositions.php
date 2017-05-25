<?php
namespace app\models;

use yii\db\ActiveRecord;

class Propositions extends ActiveRecord
{
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getAuctions()
    {
        return $this->hasMany(Auctions::className(), ['id_prop' => 'id']);
    }

    public function rules()
    {
        return [
            [['currency_from','currency_to','rate','sum_from','sum_to'],'required','message'=>'Поле обязательно'],
            [['rate','sum_from'],'double'],
            [['description'],'trim']
        ];
    }
}