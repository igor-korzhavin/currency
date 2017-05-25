<?php
namespace app\controllers;

use yii\web\Controller;
use Yii;

class YandexmoneyController extends Controller
{
    public function actionPay()
    {
        $summa =Yii::$app->session->get('summ');
        return $this->render('pay',compact('summa'));
    }

    public function actionSuccess()
    {
        return $this->render('success');
    }

    public function actionYm()
    {
        return $this->render('ym');
    }
}