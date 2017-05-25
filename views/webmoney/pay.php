
<?php error_reporting( E_ERROR );
$sm="+3";
$time=strtotime("now".$sm." hour");
$currency =Yii::$app->session->get('currency');



?>



<div class="row" style=" height: 100vh; background-color:#fff;solid #8897b6;">
    <h3 style="color:rgba(63, 68, 92, 1);text-align: center; "> Подтверждение платежа:</h3>
    <div style="border-top: 1px solid darkgrey">
        <div style="margin-top: 50px; text-align: center">

            <h4> С вашего кошелька будет списано: </h4>
            <p style="color: red"> <?php echo $summa . ' ' . $currency  ?></p>
            <form method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp" accept-charset="windows-1251" >
                <input  type="hidden" name="LMI_PAYMENT_AMOUNT"  value="<?php echo $summa ?>" readonly >
                <input type="hidden" name="LMI_PAYMENT_DESC" value="платеж по счету">
                <input type="hidden" name="LMI_PAYMENT_NO" value="1234">
                <input type="hidden" name="interes" value="<?php echo ($summa * 0.005) ?>">
                <input type="hidden" name="currency" value="<?php echo $currency ?>">
                <input type="hidden" name="LMI_PAYEE_PURSE" value="<?php echo $my_webmoney ?>">
                <input type="hidden" name="contract_id" value="<?php echo Yii::$app->session->get('contract_id') ?>">
                <input type="hidden" name="SYS_TRANS_DATE" value ="<?php echo date("y-m-d H:i:s",$time ); ?>">

                <?php if (Yii::$app->session->get('au_user_id') == Yii::$app->session->get('id')){
                    echo '<input type="hidden" name="tu_kto" value ="1">';
                } ?>


                <button style="margin-top: 20px;" class="btn btn-default" type="submit" >Перейти к оплате</button>
            </form>
        </div>
    </div>
</div>
