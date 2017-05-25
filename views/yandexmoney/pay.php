
<div class="row" style=" height: 100vh; background-color:#fff;solid #8897b6;">
    <h3 style="color:rgba(63, 68, 92, 1);text-align: center; "> Подтверждение платежа:</h3>
    <div style="border-top: 1px solid darkgrey">
        <div style="margin-top: 25px; margin-left: 25px">

            <form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
                <input type="hidden" name="receiver" value="410011119369243">
                <input type="hidden" name="label" value="$order_id">   <!--  логин пользователя -->
                <input type="hidden" name="quickpay-form" value="shop"><!--  назначение кнопки(магазин, баготворительность и т.д)-->
                <input type="hidden" name="targets" value="transaction {order_id}">
                <input type="text" name="sum" value="<?php echo $summa ?>" readonly data-type="number"><!--  сумма платежа -->
                <input type="hidden" name="comment" value="I want it to have a remote control.">   <!--  коментарий к платежу -->
                <input type="hidden" name="successURL" value="currency.currency.php2.a-level.com.ua/yandexmoney/success">
                <label><input type="hidden" name="paymentType" value="PC">Yandex.Money</label>
                <input type="submit" value="Перевести">
            </form>


            </form>
        </div>
    </div>
</div>
