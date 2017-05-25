<?php
namespace app\controllers;

use app\models\Auctions;
use app\models\Propositions;
use Yii;
use yii\web\Controller;

class AuctionController extends Controller
{
    public $layout = 'zero';

    public function actionIndex($id)
    {
        if ($user_id = Yii::$app->session->get('id')) {

            $model = new Auctions();
            $prop = Propositions::find()->where(['id' => $id])->one();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->user_id = $user_id;
                $model->id_prop = $prop->id;
                $model->status = 0;
                $model->comment = Yii::$app->session->get('login');
                $model->save();
                return $this->goHome();
            }
            return $this->render('index', ['model' => $model, 'prop' => $prop, 'sum_from' => round($prop->sum_from, 2), 'rate' => round($prop->rate, 2)]);
        } else {
            return $this->redirect(['login']);
        }
    }

    public function actionAccept($id)
    {
        if ($user_id = Yii::$app->session->get('id')) {

            $model = new Auctions();
            $prop = Propositions::find()->where(['id' => $id])->one();

            Auctions::updateAll(['status' => Auctions::STATUS_ACTIVE], ['id_prop' => $prop->id]);

            $prop->status = 1;
            $prop->save();

            $model->user_id = $user_id;
            $model->id_prop = $prop->id;

            $model->sum_to = $prop->sum_from * $prop->rate;
            $model->rate = $prop->rate;
            $model->status = 2;
            $model->comment = Yii::$app->session->get('login');
            $model->save();
            $id_last = $model->id;

            return $this->redirect(["contract/index/$id_last"]);
        } else {
            return $this->redirect(['login']);
        }
    }
    public function actionBargain($id)
    {
        $auction = Auctions::find()->where("id = $id")->one();
        $model = new Auctions();
        $prop = Propositions::find()->where(['id' => $auction->id_prop])->one();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($auction->user_id == Yii::$app->session->get('id')){
                    $model->status = 7;
                }else {
                    $model->status = 4;
                }
                $model->id_prop = $auction->id_prop;
                $model->user_id = $auction->user_id;
                $auction->status = 6;
                $model->comment = Yii::$app->session->get('login');
                $auction->save();
            $model->save();
            return $this->redirect(["personal/messages"]);
        }
        return $this->render('bargain', [
            'model' => $model,
            'prop' => $prop,
            'sum_from' => round($prop->sum_from,2),
            'rate' => round($prop->rate, 2) ,
            'sum_from_new' => round($auction->sum_to,2),
            'rate_new' => round($auction->rate, 2)
        ]);
    }

    public function actionNo_bargain($id)
    {
        $model = Auctions::find()->where(['id' => $id])->one();
        $model->status = 1;
        $model->save();
        return $this->redirect(["personal/messages"]);
    }
}
