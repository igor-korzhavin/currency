<?php
namespace app\models;

use yii\db\ActiveRecord;

class Contracts extends ActiveRecord{

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['AU'] = ['au_id_pay_from', 'au_id_pay_to'];
        $scenarios['PROP'] = ['prop_id_pay_from', 'prop_id_pay_to'];
        return $scenarios;
    }

    public function rules()
    {
          return [
              [['au_id_pay_from', 'au_id_pay_to'],'required','message' => 'Укажите кошелек', 'on' => 'AU'],
              [['prop_id_pay_from', 'prop_id_pay_to'],'required', 'message' => 'Укажите кошелек','on' => 'PROP' ]
          ];
    }
}

