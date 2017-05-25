<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 07.04.17
 * Time: 10:15
 */
namespace app\controllers;

error_reporting( E_ERROR );

use app\models\Statuses;
use yii\web\Controller;
use Yii;
use app\models\Sums;

class WebmoneyController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent :: beforeAction($action);
    }

    public function actionWm()
    {
        $key = hash('sha256',$_POST['LMI_PAYEE_PURSE'].
            $_POST['LMI_PAYMENT_AMOUNT'].
            $_POST['LMI_HOLD'].
            $_POST['LMI_PAYMENT_NO'].
            $_POST['LMI_MODE'].
            $_POST['LMI_SYS_INVS_NO'].
            $_POST['LMI_SYS_TRANS_NO'].
            $_POST['LMI_SYS_TRANS_DATE'].
            '9876512345'.
            $_POST['LMI_PAYER_PURSE'].
            $_POST['LMI_PAYER_WM']);

        if (strtoupper($key) != $_POST['LMI_HASH']){
            exit('error');}

        if (!empty($_POST)) {

            if (isset($_POST['tu_kto'])) {
                $res1 = Statuses::findOne(['id_contract' => $_POST['contract_id']]);
                if ($res1) {
                    $status = Statuses::findOne(['id_contract' => $_POST['contract_id']]);
                    $status->date_from_auction = $_POST['SYS_TRANS_DATE'];
                    $status->save();

                } else {
                    $status = new Statuses();
                    $status->id_contract = $_POST['contract_id'];
                    $status->date_from_auction = $_POST['SYS_TRANS_DATE'];
                    $status->save();
                }
            } else {
                $res2 = Statuses::findOne(['id_contract' => $_POST['contract_id']]);
                if ($res2) {
                    $status = Statuses::findOne(['id_contract' => $_POST['contract_id']]);
                    $status->date_from_prop = $_POST['SYS_TRANS_DATE'];
                    $status->save();

                } else {
                    $status = new Statuses();
                    $status->id_contract = $_POST['contract_id'];
                    $status->date_from_prop = $_POST['SYS_TRANS_DATE'];
                    $status->save();
                }
            }
            $sums = new Sums();
            $sums->id_contract = $_POST['contract_id'];
            $sums->sum_from = $_POST['LMI_PAYMENT_AMOUNT'];
            $sums->sum_interest =$_POST['interes'];
            $sums->currency =$_POST['currency'];
            $sums->save();


        }
        return $this->render('wm');
    }

    public function actionSuccess()
    {
        $session = Yii::$app->session;
        $session->remove('contract_id');
        $session->remove('au_user_id');
        $session->remove('summ');
        $session->remove('currency');
        $session->remove('type_pay');
        $session->remove('au_id');

        return $this->render('success');
    }

    public function actionError()
    {
        $contract = Yii::$app->session->get('au_id');
        return $this->render('error',compact('contract'));
    }

    public function actionPay()
    {
        $summa =Yii::$app->session->get('summ');
        $type_pay = Yii::$app->session->get('type_pay');

        if ($type_pay == 'WMZ') {
            $my_webmoney ='Z124475559964';
        }
        elseif ($type_pay == 'WMR'){
            $my_webmoney ='R108845130629';
        }
        elseif ($type_pay == 'WME'){
            $my_webmoney = 'E675191362912';
        }
        elseif ($type_pay == 'WMU'){
            $my_webmoney ='U758882937634';
        }

        return $this->render('pay', compact('summa','my_webmoney'));
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}