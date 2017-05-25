<?php
namespace app\models;

use yii\db\ActiveRecord;

class PaymentAccounts extends ActiveRecord {

    public static function tableName()
    {
        return 'payment_accounts';
    }

    public function rules()
    {
        return[
            [['account'], 'required', 'message' => 'Необходимо указать кошелек'],
        ];
    }
}