<?php
header('Conteny-type:text/html;charset=utf-8');
require_once 'phpQuery-onefile.php';
$url = "http://www.kolesa.ru/";
$site = file_get_contents($url);
//$curl = curl_init();
//
//curl_setopt($curl,CURLOPT_URL,$url);
//curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
//curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);
//
////preg_match_all('#<h2>(.+?)</h2>#',$site,$res);
//
//curl_setopt($curl,CURLOPT_COOKIEFILE,$cookieFullPath);
//curl_setopt($curl,CURLOPT_COOKIEJAR,$cookieFullPath);
//curl_setopt($curl,CURLOPT_POSTFIELDS,['name'=>'admin','password'=>'admin']);
//$site = curl_exec($curl);

$pq = phpQuery::newDocument($site);
//echo $res = $pq->find('.data_container');
echo $site;
