<?php
namespace app\controllers;

use app\models\Auctions;
use app\models\Contracts;
use app\models\PaymentAccounts;
use app\models\PropForm;
use app\models\Propositions;
use app\models\User;
use app\models\Statuses;
use Yii;
use yii\web\Controller;
use yii\db\Query;

error_reporting(E_ERROR);

class PersonalController extends Controller{

    public $layout = 'personal';

    public function actionUser()
    {
            $user_id = Yii::$app->session->get('id');
            $user = User::find()->where(['id'=>$user_id])->one();

        return $this->render('index',['user'=>$user]);
    }

    public function actionPropositions()
    {
        $user_id = Yii::$app->session->get('id');
        $prop = Propositions::find()->where(['user_id'=>$user_id])->all();

        if (!empty(Yii::$app->request->get('id'))){
            $id = Yii::$app->request->get('id');
            $del = Propositions::findOne($id);
            $del->delete();
            $this->redirect('/personal/propositions');
        }
        return $this->render('propositions',['prop'=>$prop,]);
    }

    public function actionPayment()
    {
        $user_id = Yii::$app->session->get('id');
        $account= PaymentAccounts::find()->where(['user_id'=>$user_id])->all();

        return $this->render('payment',['account'=>$account]);
    }

    public function actionCount()
    {
        if (Yii::$app->request->isAjax){
            $user_id = Yii::$app->session->get('id');
            $prop = Propositions::find()->with('auctions')->where(['user_id'=>$user_id])->all();
            foreach ($prop as $elem):
                foreach($elem->auctions as $val):
                    if ($val->status == 0 or $val->status == 2 or $val->status == 7):
                        if ($val->status != 2):
                            $result_auc[]= $val->id;
                        endif;
                        $result[]= $val->id;
                    endif;
                endforeach;
            endforeach;
            $count = count($result);
            $count_auc = count($result_auc);

            $accept_msg = Auctions::find()->with('propositions')->where( "user_id=$user_id")->all();
            $count_admin = Statuses::find()->where("date_from_prop !=0 AND date_from_auction !=0 AND date_to_prop = 0 AND date_to_auction = 0")->count('id_contract');
            foreach ($accept_msg as $value){   //TODO  переделать счетчик
                if ($value->status == 5 or $value->status == 4){
                    if ($value->status == 4){
                        $count_acc_auc[]=$value->id;
                    }
                    $count_acc []=$value->id;
                }
            }
            $count_auctions = count($count_acc);
            $count_auctions_auc = count($count_acc_auc);

            $data['all'] = $count + $count_auctions;
            $data['barb'] = $count_auc + $count_auctions_auc;
            $data['admin'] = $count_admin;

            return  json_encode($data);
        }
    }

    public function actionMessages()
    {
        $user_id = Yii::$app->session->get('id');
        $prop = Propositions::find()->with('auctions')->where(['user_id'=>$user_id])->all();

        $accept_msg = Auctions::find()->with('propositions')->where( "status IN(4,5) AND user_id=$user_id")->all();
        $history = Auctions::find()->with('propositions')->with('user')->where( "status IN(6) AND user_id=$user_id")->all();
        $history_2 = Auctions::find()->with('propositions')->with('user')->where( "status IN(6) AND user_id !=$user_id")->all();
        $contr = (new Query())->select(['contracts.id as id',
                                        'auctions.sum_to as sum_auc',
                                        'propositions.sum_from as sum_prop',
                                        'propositions.user_id as id_prop',
                                        'propositions.currency_from as currency_from',
                                        'propositions.currency_to as currency_to',
                                        'auctions.user_id as id_auc',
                                        'contracts.date'])
            ->from('contracts')
            ->leftJoin('auctions', 'contracts.id_auction = auctions.id')
            ->leftJoin('propositions', 'contracts.id_prop = propositions.id')
            ->where(['=', 'contracts.status', 2])
            ->andWhere( ['OR', "auctions.user_id = $user_id", "propositions.user_id = $user_id"])
            ->all();

        if (Yii::$app->session->get('id') and Yii::$app->request->get('id')){
            $id = Yii::$app->request->get('id');
            $auction = Auctions::find()->where(['id'=>$id])->one();
            $auction->status = 1;
            $auction->save();
            return $this->redirect(['messages']);
        }
        return $this->render('messages',[
            'prop'=>$prop,
            'accept_msg'=>$accept_msg,
            'history'=>$history,
            'history2'=>$history_2,
            'contr'=>$contr
        ]);
    }

    public function actionAccept($id_prop, $id_auc)
    {
        if (Yii::$app->session->get('id')) {
            Auctions::updateAll(['status' => '3'], ['id_prop' => $id_prop]);
            $this->redirect(["contract/index/$id_auc"]);
        }
    }

    public function actionAcc($id_prop, $id_auc)
    {
        $user = Yii::$app->session->get('id');
        if ($user) {
            Auctions::updateAll(['status' => '3'], ['id_prop' => $id_prop]);//&? Какой статус?
            $prop = Propositions::findOne(['id' => $id_prop]);
            $prop->status = 1;
            $prop->save();
            $auction = Auctions::find()->where(['id' => $id_auc])->one();
            $auction->status = "5";
            $auction->save();
            $this->redirect(["contract/index/$id_auc"]);
        }
    }

    public function actionAccprop($id_prop, $id_auc)
    {
        $user = Yii::$app->session->get('id');
        if ($user) {
            Auctions::updateAll(['status' => '6'], ['id_prop' => $id_prop]);
            $prop = Propositions::findOne(['id' => $id_prop]);
            $prop->status = 1;
            $prop->save();
            $auction = Auctions::find()->where(['id' => $id_auc])->one();
            $auction->status = "2";
            $auction->save();
            $this->redirect(["contract/index/$id_auc"]);
        }
    }
}