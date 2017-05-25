<?php
namespace app\controllers;

use app\models\Exchange;
use app\models\Parse;
use yii\web\Controller;


use app\models\Payment_accounts;

class ParseController extends Controller {

    const RSS_TTL = 3600;

   public function download($url,$filename){
        $file = file_get_contents($url);
        if($file){
           return file_put_contents($filename,$file);
        }
    }

    public function actionDownloadXml(){

        $data = Exchange::find()->all();
        foreach ($data as $elem){
            $filename = $elem->title .".xml";
            $rss_url = $elem->link;
            $id[]=$elem->id;
            if (!is_file( $filename or time()>filemtime( $filename)+ $rss_url)){
                $this-> download($rss_url, $filename);
            }
            $sxml[] = simplexml_load_file( $filename);
        }

        for ($j=0;$j<count($sxml);$j++) {
            $pars_info = Parse::find()->select('id')->where(['id_exchange'=>$id[$j]])->asArray()->all();
            for ($i = 0; $i < count($sxml[$j]); $i++) {
                if (!empty($pars_info)) {
                    $pars = Parse::findOne($pars_info[$j]['id']);
                } else {
                    $pars = new Parse();
                }
                $pars->currency_from = $sxml[$j]->item[$i]->from;
                $pars->currency_to = $sxml[$j]->item[$i]->to;
                $pars->rate_in = $sxml[$j]->item[$i]->in;
                $pars->rate_out = $sxml[$j]->item[$i]->out;
                $pars->id_exchange = $id[$j];
                $pars->save();
            }
        }
    }

    public function actionXml(){
        $parse_result = Parse::find()->all();
//        var_dump($parse_result);die();
        return $this->render('xml',['sxml'=>$parse_result ]);
    }
}