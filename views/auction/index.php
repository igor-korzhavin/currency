<?php
use \yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
            <div style="text-align:center;margin: 0 auto;">
            <?php $form = ActiveForm::begin(['class'=>'form-horizontal']); ?>
                <p style="margin-bottom: 20px;text-align: center;font-weight: bold;font-size: 16px;">Данные предложения:</p>

                <div style="display: inline-block;margin-right:10px; width: 140px;vertical-align: top">Сумма
                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo round($prop->sum_from, 2); ?></p>
                </div>
                <div style="display: inline-block;width: 140px;margin-right:10px;vertical-align: top">Валюта:
                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo $prop->currency_from; ?></p>
                </div>
                <div style="display: inline-block;width: 140px;vertical-align: top;">Курс
                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo round($prop->rate, 2); ?></p>
                </div>

                <p style="margin-bottom: 20px;text-align: center;font-weight: bold;font-size: 14px;">К оплате</p>

                <div style="display: inline-block;width: 210px;margin-right:10px;vertical-align: top">Валюта:
                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo $prop->currency_to; ?></p>
                </div>
                <div style="display: inline-block;width: 210px;vertical-align: top;">Сумма
                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo round($prop->sum_to, 2); ?></p>
                </div>

                <p style="margin-bottom: 20px;text-align: center;font-weight: bold;font-size: 14px;">Ваш вариант:</p>

                <div style="display: inline-block;width: 210px;margin-right:5px;vertical-align: top;">
                    <?php echo $form->field($model,'rate')->textInput(['value' => $rate, 'type'=>'number', 'step'=>"0.0001",'min'=>"0.0001",'onchange' => "conversionKursToSum($sum_from)"])->label('Курс')?>
                </div>
                <div style="display: inline-block;width: 210px;vertical-align: top; padding-bottom: 20px;">
                    <?php echo $form->field($model,'sum_to')->textInput(['value' => ($sum_from * $rate), 'type'=>'number','step'=>"0.0001",'min'=>"0.0001",'onchange' => "conversionSumToKurs($sum_from)"])->label('Сумма')?>
                </div>
                <div class="modal-footer">
                <div class="footer-button">
                    <button style="margin-top:20px" type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <?php echo Html::submitButton('Добавить',['class'=>'btn btn-primary','style'=>'float:right;margin-top:20px;margin-bottom:20px'])?>
                </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>