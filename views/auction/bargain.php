<?php
use \yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="container">
    <div class="row"">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
            <div style="text-align:center;margin: 0 auto;">
            <?php $form = ActiveForm::begin(['class'=>'form-horizontal']); ?>
                <p style="margin-bottom: 20px;text-align: center;font-weight: bold;font-size: 16px;">Данные предложения:</p>

                <div style="display: inline-block;margin-right:10px; width: 140px;vertical-align: top">Сумма
                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo round($prop->sum_from,2); ?></p>
                </div>
                <div style="display: inline-block;width: 140px;margin-right:10px;vertical-align: top">Валюта:
                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo $prop->currency_from; ?></p>
                </div>
                <div style="display: inline-block;width: 140px;vertical-align: top;">Курс
                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo round($prop->rate, 2); ?></p>
                </div>

                <div style="display: inline-block;width: 210px;margin-right:10px;vertical-align: top">Валюта:
                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo $prop->currency_to; ?></p>
                </div>
                <div style="display: inline-block;width: 210px;vertical-align: top;">Сумма
                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo round($prop->sum_to, 2); ?></p>
                </div>

                <?php if ($model->user_id == Yii::$app->session->get('id')):?>
                    <p style="margin-bottom: 20px;text-align: center;font-weight: bold;font-size: 14px;">Предожили сойтись на:</p>
                <?php else:?>
                    <p style="margin-bottom: 20px;text-align: center;font-weight: bold;font-size: 14px;">Вам предожили:</p>
                <?php endif;?>

                <div style="display: inline-block;width: 210px;vertical-align: top;">Курс
                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo $rate_new; ?></p>
                </div>
                <div style="display: inline-block;width: 210px;vertical-align: top;">Сумма
                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"><?php echo $sum_from_new; ?></p>
                </div>

                <p style="margin-bottom: 20px;text-align: center;font-weight: bold;font-size: 14px;">Ваш вариант:</p>

                <div style="display: inline-block;width: 210px;margin-right:5px;vertical-align: top;">
                    <?php echo $form->field($model,'rate')->textInput(['value' => $rate_new,'type'=>'number','step'=>"0.0001", 'min'=>"0.0001", 'onchange' => "conversionKursToSum($sum_from)"])->label('Курс')?>
                </div>
                <div style="display: inline-block;width: 210px;vertical-align: top;">
                    <?php echo $form->field($model,'sum_to')->textInput(['value' => ($sum_from_new), 'type'=>'number', 'step'=>"0.0001", 'min'=>"0.0001", 'onchange' => "conversionSumToKurs($sum_from)"])->label('Сумма')?>
                </div>

                <div class="footer-button">
                    <?php echo Html::submitButton('Добавить',['class'=>'btn btn-primary','style'=>'float:right;margin-right:60px;margin-top:60px;margin-bottom:30px'])?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>