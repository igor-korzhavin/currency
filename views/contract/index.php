<?php
error_reporting(E_ERROR);
use \yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Currency Exchange';
?>

<div class="container" >
    <div class="row" style=" height: 100%; background-color:#fff;solid #8897b6;">
        <h3 style="color:rgba(63, 68, 92, 1);text-align: center; ">Информация о участниках</h3>
        <div style="border-top: 1px solid darkgrey">
            <div class="col-lg-4" style="height: 100vh;border-right: 1px solid darkgray;">
                <h4 style="margin-top: 25px !important;line-height:33px;color:grey;text-align:center;height:70px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo "Информация о создателе предложения:"; ?></h4>
                <p style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-info"><?php echo 'Логин: ' . $user_prop->login; ?></p>
                <p style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-info"><?php echo 'Фамилия и имя: ' . $user_prop->surname. ' ' . $user_prop->name; ?></p>
                <p style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-info"><?php echo 'Валюта: ' . $prop->currency_from; ?></p>
                <p style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-info"><?php echo 'Сумма:' . round($prop->sum_from,2); ?></p>
            </div>
            <div class="col-lg-4" style="height: 100vh; border-right: 1px solid darkgray;">
                <h4 style="margin-top: 25px !important;line-height:33px;color:grey;text-align:center;height:70px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo "Информация о согласившимся с предложением:"; ?></h4>
                <p style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-info"><?php echo 'Логин: ' . $user_au->login; ?></p>
                <p style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-info"><?php echo 'Фамилия и имя: ' . $user_au->name . ' ' . $user_au->surname; ?></p>
                <p style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-info"><?php echo 'Валюта: ' . $prop->currency_to; ?></p>
                <p style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-info"><?php echo 'Сумма: ' . round($auctions->sum_to,2); ?></p>
            </div>
            <div class="col-lg-4" style=" height: 100vh; border-right: 1px solid darkgray;">
                <div style="margin-top: 25px !important;">
                    <?php

                    $form = ActiveForm::begin([ 'class'=>'form-horizontal']);

                    ?>
                    <?php if (!$flag_au = ($auctions->user_id == $user_id)): ?>
                        <?php echo $form->field($contract,'prop_id_pay_from')->dropDownList($payment_accounts_drob1)->label('Кошелек, с которого будут сняты средства'); ?>
                        <button type="button" name ="ee" class="glyphicon glyphicon-plus"  data-toggle="modal" data-target="#myModal2" title="Добавить новый">
                        </button>
                        <?php echo $form->field($contract,'prop_id_pay_to')->dropDownList($payment_accounts_drob2)->label('Кошелек, для зачисления средств'); ?>
                        <button type="button" class="glyphicon glyphicon-plus"   data-toggle="modal" data-target="#myModal" title="Добавить новый">
                        </button>
                    <?php else:?>
                        <?php echo $form->field($contract,'au_id_pay_from')->dropDownList($payment_accounts_drob2)->label('Кошелек, с которого будут сняты средства'); ?>
                        <button type="button" class="glyphicon glyphicon-plus"  data-toggle="modal" data-target="#myModal">
                        </button>
                        <?php echo $form->field($contract,'au_id_pay_to')->dropDownList($payment_accounts_drob1)->label('Кошелек, для зачисления средств'); ?>
                        <button type="button" class="glyphicon glyphicon-plus"  data-toggle="modal" data-target="#myModal2" title="Добавить новый">
                        </button>
                    <?php endif;?>
                    <?php if ($flag_au): ?>
                        <p style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-danger"><?php echo 'Вы отдаёте ' . round($auctions->sum_to,2); ?><?php echo ' '. $prop->currency_to; ?></p>
                        <p style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo 'С учётом комиссии, Вы получите: ' . round($prop->sum_from *0.995,2); ?> <?php echo $prop->currency_from; ?></p>
                    <?php else:?>
                        <p style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-danger"><?php echo 'Вы отдаёте ' . round($prop->sum_from,2); ?><?php echo ' '. $prop->currency_from; ?></p>
                        <p style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo 'С учётом комиссии, Вы получите:  ' . round($auctions->sum_to *0.995,2); ?> <?php echo $prop->currency_to ; ?></p>
                    <?php endif;?>
                    <?php echo Html::submitButton('Далее',['class'=>'btn btn-primary'])?>
                    <?php
                    ActiveForm::end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Добавление кошелька</h4>
            </div>
            <div class="modal-body">
                <?php $form2 = ActiveForm::begin(); ?>
                <?php echo $form2->field($pay_accc, 'account')->textInput()->label('Введите ' . $prop->currency_to . ' кошелек'); ?>
                <?php echo Html::hiddenInput('new_acctype', $prop->currency_to);?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
                <button type="submit" name="err" class="btn btn-primary">Добавить</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Добавление кошелька</h4>
            </div>
            <div class="modal-body">
                <?php $form3 = ActiveForm::begin(); ?>
                <?php echo $form3->field($pay_accc, 'account')->textInput()->label('Введите ' . $prop->currency_from . ' кошелек'); ?>
                <?php echo Html::hiddenInput('new_acctype', $prop->currency_from);?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>