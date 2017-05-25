<?php
namespace app\models;

use yii\db\ActiveRecord;

class Auctions extends ActiveRecord{

    const STATUS_ACTIVE = 6;

    public function getPropositions()
    {
        return $this->hasOne(Propositions::className(), ['id' => 'id_prop']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function rules()
    {
        return [
            [['rate', 'sum_to'],'required','message'=>'Поле обязательно'],
            [['comment'],'trim']
        ];
    }

}