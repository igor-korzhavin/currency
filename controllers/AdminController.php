<?php
namespace app\controllers;

use app\models\Contracts;
use app\models\Statuses;
use yii\db\Query;
use yii\web\Controller;
Use app\models\Sums;
Use app\models\Auctions;
Use app\models\Propositions;

class AdminController extends Controller
{
    static $models = ['Auctions' => 'auctions',
        'Contracts' => 'contracts',
        'Currency' => 'currency',
        'Exchange' => 'exchange',
        'Parse' => 'parse',
        'PaymentAccounts' => 'payment_accounts',
        'Propositions' => 'propositions',
        'Statuses' => 'statuses',
        'Sums' => 'sums',
        'User' => 'user'];

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionContract()
    {
        $sm="+3";
        $time=strtotime("now".$sm." hour");

        $data_auc = (new Query())->select(['contracts.id as id',
                                            'auctions.sum_to as sum_auc',
                                            'user.login as auc_login',
                                            'payment_accounts.account as ac_auc'])
            ->from('statuses')
            ->leftJoin('contracts', 'statuses.id_contract = contracts.id')
            ->leftJoin('auctions', 'contracts.id_auction = auctions.id')
            ->leftJoin('user', 'auctions.user_id = user.id')
            ->leftJoin('payment_accounts', 'contracts.au_id_pay_to = payment_accounts.id')
            ->where(['!=', 'statuses.date_from_auction', 0])
            ->andWhere(['!=', 'statuses.date_from_prop', 0])
            ->andWhere(['=', 'statuses.date_to_auction', 0])
            ->andWhere(['=', 'statuses.date_to_prop', 0])
            ->all();

        $data_prop = (new Query())->select(['contracts.id as id',
                                            'propositions.sum_from as sum_prop',
                                            'user.login as prop_login',
                                            'payment_accounts.account as ac_prop'])
            ->from('statuses')
            ->leftJoin('contracts', 'statuses.id_contract = contracts.id')
            ->leftJoin('propositions', 'contracts.id_prop = propositions.id')
            ->leftJoin('user', 'propositions.user_id = user.id')
            ->leftJoin('payment_accounts', 'contracts.prop_id_pay_to = payment_accounts.id')
            ->where(['!=', 'statuses.date_from_auction', 0])
            ->andWhere(['!=', 'statuses.date_from_prop', 0])
            ->andWhere(['=', 'statuses.date_to_auction', 0])
            ->andWhere(['=', 'statuses.date_to_prop', 0])
            ->all();

        if(!empty($_GET['id'])){

            $stat = Statuses::findOne(['id_contract' => $_GET['id']]);
            $stat->date_to_prop = date("y-m-d H:i:s",$time );
            $stat->date_to_auction =date("y-m-d H:i:s",$time );
            $stat->save();

            $contract = Contracts::findOne($_GET['id']);
            $id_au =$contract->id_auction;
            $id_prop=$contract->id_prop;
            $contract->status = '2';
            $contract->save();

            $au= Auctions::findOne($id_au);
            $sum1 =$au->sum_to;

            $prop = Propositions::findOne($id_prop);
            $sum2 =$prop->sum_from;
            $cur1 =$prop->currency_to;
            $cur2 =$prop->currency_from;

            $sum = new Sums();
            $sum->id_contract=$_GET['id'];
            $sum->sum_to = $sum1;
            $sum->currency =$cur1;
            $sum->save();

            $sum = new Sums();
            $sum->id_contract=$_GET['id'];
            $sum->sum_to = $sum2;
            $sum->currency =$cur2;
            $sum->save();

            $this->redirect('contract');
        }

        return $this->render('contract', ['data_auc' => $data_auc, 'data_prop' => $data_prop]);
    }

    public function actionData($model)
    {
        $records = call_user_func("app\\models\\$model::find")->all();
        //$is_nul = [null,[]];
        if (!$records) {
            return json_encode([
                '0'=>['Нет данных'],
                '1'=> [""]
            ]);
        }
        $result = [];
        foreach ($records as $rec){
            $record = [];
            foreach ($rec as $key => $value){
                $record[$key] = $value;
            }
            $result[] = $record;
            $keys     = array_keys($record);
        }
        return json_encode([$keys, $result]);
    }

    public function actionUpdate($model, $id, $key, $value)
    {
        $rec = call_user_func("app\\models\\$model::findOne",$id);
        $rec->$key = $value;
        $rec->save();
        return json_encode(["errorMessage" => false, "alert" => "Save successfully"]);
    }

    public function actionModels()
    {
        return json_encode(self::$models);
    }

    public function actionDelete($model, $id)
    {
        $rec = call_user_func("app\\models\\$model::findOne",$id);
        $rec->delete();
        return json_encode(["errorMessage" => false, "alert" => "Deleted successfully"]);
    }
}
