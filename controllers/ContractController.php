<?php
namespace app\controllers;
error_reporting( E_ERROR );

use yii\helpers\ArrayHelper;
use app\models\PaymentAccounts;
use app\models\Currency;
use app\models\Auctions;
use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Contracts;

class ContractController extends Controller{

    public function actionIndex($id){

        if ($user_id = Yii::$app->session->get('id')) {

            $auctions = Auctions::find()->where(['id' => $id])->one();
            $prop = $auctions->propositions;
            $au_id =$auctions->id;
            $user_id_prop = $prop->user_id;
            $user_id_au = $auctions->user_id;

            if (!$flag_au = ($auctions->user_id == $user_id)){

                $all_about_account = Currency::find()
                                                ->where(['name' => $prop->currency_from])
                                                ->one();
            } else {
                $all_about_account = Currency::find()
                                                ->where(['name' => $prop->currency_to])
                                                ->one();
            }

            $perep_type_account = Currency::find()
                ->where(['id' => $all_about_account["parrent_id"]])
                ->one();
            $type_account =$perep_type_account["name"];

            if ($type_account == 'WM'){
                $action ='../../webmoney/pay';
            }
            elseif ($type_account == 'Yandex'){
                $action ='../../yandexmoney/pay';
            }
            elseif ($type_account == 'Privat24'){
                $action ='../../privat/pay';
            }
            else {
                $action ='../../contract/error';
            }

            $contract = Contracts::find()->where(['id_auction' => $id])->one() ? Contracts::find()->where(['id_auction' => $id])->one() : new Contracts();

            $contract->scenario = $flag_au ? 'AU' : 'PROP';

            if ($contract->load(Yii::$app->request->post())) {

                if ($user_id_prop == yii::$app->session->get('id')) {
                    $contract->status = 1;
                }
                $contract->id_prop = $prop->id;
                $contract->id_auction = $auctions->id;

                $contract->save();
                $this->redirect("$action");
            }

            $pay_ac1 = PaymentAccounts::find()->where(['user_id' => $user_id, 'type_account' => $prop->currency_from])->all();
            $pay_ac2 = PaymentAccounts::find()->where(['user_id' => $user_id, 'type_account' => $prop->currency_to])->all();

            $payment_accounts_drob1 = ArrayHelper::map($pay_ac1, 'id', 'account');
            $payment_accounts_drob2 = ArrayHelper::map($pay_ac2, 'id', 'account');

            $user_prop = User::find()->where(['id' => $user_id_prop])->one();
            $user_au = User::find()->where(['id' => $user_id_au])->one();

            $pay_accc = new PaymentAccounts();
            $type_acc =$prop->currency_from;
            $type_acc2=$prop->currency_to;

            $add_acc=Yii::$app->request->post('PaymentAccounts');

            if (!$flag_au = ($auctions->user_id == $user_id)){
                $kosh1_prop =$prop->currency_from;
                $kosh2_prop =$prop->currency_to;
            } else {
                $kosh1_prop = $prop->currency_to;
                $kosh2_prop = $prop->currency_from;
            }

            if (!$flag_au = ($auctions->user_id == $user_id)){

                $new_account = new PaymentAccounts();
                if(!empty($add_acc['account']) && $new_account->validate()) {

                    $new_account->user_id = Yii::$app->session->get('id');
                    $new_account->account = $add_acc['account'];
                    $new_account->type_account = (Yii::$app->request->post('new_acctype'));
                    $new_account->save();
                }
                elseif (!empty($add_acc['account'])){

                    $new_account->user_id = Yii::$app->session->get('id');
                    $new_account->account = $add_acc['account'];
                    $new_account->type_account = (Yii::$app->request->post('new_acctype'));
                    $new_account->save();
                }
            }

            if ($flag_au = ($auctions->user_id == $user_id))
                $new_account = new PaymentAccounts();{
                if(!empty($add_acc['account']) && $new_account->validate()) {

                    $new_account->user_id = Yii::$app->session->get('id');
                    $new_account->account = $add_acc['account'];
                    $new_account->type_account = (Yii::$app->request->post('new_acctype'));
                    $new_account->save();

                    $this->refresh();
                }
                elseif (!empty($add_acc['account'])){

                    $new_account->user_id = Yii::$app->session->get('id');
                    $new_account->account = $add_acc['account'];
                    $new_account->type_account = (Yii::$app->request->post('new_acctype'));
                    $new_account->save();
                    $this->refresh();
                }
            }

            $session = Yii::$app->session;
            $session['au_id'] =$au_id;
            $session['contract_id'] =$contract->id;
            $session['au_user_id'] =$auctions->user_id;

            if ($flag_au){
                $session['summ'] = round($auctions->sum_to,2);
                $session['currency'] =$prop->currency_to;

            } else{
                $session['summ'] = round($prop->sum_from,2);
                $session['currency'] =$prop->currency_from;
            }
            $session['type_pay'] =$kosh1_prop;

            return $this->render('index', compact(['contract', 'user_id', 'auctions', 'payment_accounts_drob1', 'payment_accounts_drob2', 'user_prop', 'user_au', 'prop','pay_accc','second_account','action']));
        } else {
            return $this->redirect(['login']);
        }
    }

    public function actionError(){

        return $this->render('error');
    }
}