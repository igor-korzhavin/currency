<?php

$hash = sha1($_POST['notification_type'].'&'.
    $_POST['operation_id'].'&'.
    $_POST['amount'].'&'.
    $_POST['currency'].'&'.
    $_POST['datetime'].'&'.
    $_POST['sender'].'&'.
    $_POST['codepro'].'&'.
    'UI6UTTIm5VtLB6x/Z80hxRKV'.'&'.
    $_POST['label']);


if ($_POST['sha1_hash']!=$hash or $_POST['codepro'] === true or $_POST['unaccepted'] === true){
        exit('error');
}

file_put_contents('history.php',$_POST['datetime'].'to Yandex.Money sum'.$_POST['amount']);
