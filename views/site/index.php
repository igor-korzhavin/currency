<?php
error_reporting(E_ERROR);
use yii\helpers\Html;
use yii\bootstrap\Modal;
use \yii\widgets\ActiveForm;
use \yii\helpers\Url;
?>
<div class="site-index">
    <div style="position: relative;right:15px;">
        <?= Html::img('@web/images/1001956-currency .jpg', ['alt' => 'main']) ?>
    </div>
    <div class="body-content">
        <div class="row" style="background-color:#fff; border-top:3px solid #8897b6">
            <div class="col-lg-3" style="background: #FCFCFD;min-height: 710px;border-left: 1px solid darkgray;border-right: 1px solid darkgray;">
                <h4 style="text-align: center;color:rgba(63, 68, 92, 1); margin-top: 20px; margin-bottom: 20px"> Информация:</h4>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <!-- Minfin.com.ua region informer 251x120 grey-->
                        <div id="minfin-informer-m1Fn-region">Загружаем <a href="http://minfin.com.ua/currency/" target="_blank">курсы валют</a> от minfin.com.ua</a></div>
                        <script type="text/javascript">var iframe = '<ifra'+'me width="251" height="120" fram'+'eborder="0" src="http://informer.minfin.com.ua/gen/region/57/?color=grey" vspace="0" scrolling="no" hspace="0" allowtransparency="true"style="width:251px;height:120px;ove'+'rflow:hidden;"></iframe>';var cl = 'minfin-informer-m1Fn-region';document.getElementById(cl).innerHTML = iframe; </script>
                        <noscript><img src="http://informer.minfin.com.ua/gen/img.png" width="1" height="1" alt="minfin.com.ua: курсы валют" title="Курс валют" border="0" /></noscript>
                        <!-- Minfin.com.ua region informer 251x120 grey-->
                    </div>
                </div>
                <div style="margin-left: 20px; margin-top: 40px;">
                <h5 style="text-align: center; color:rgba(63, 68, 92, 1);"> Мы работаем:</h5>
                    <a href="http://passport.webmoney.ru/asp/certview.asp?wmid=181940515780" target="_blank" ><img style="display: inline-block;margin-left: 20px;"title="Webmoney"  src="/images/wmlogo_32.png"></a>


                 <a href="https://money.yandex.ru/" target="_blank"> <img style="display: inline-block;margin-left: 25px; margin-top: 10px;" title ="Yandex.Money" src="/images/yandex.png"></a>

                <a href="https://perfectmoney.is/" target="_blank"><img style="display:inline-block;margin-left: 20px; margin-top: 10px;" title ="Perfect Money"src="/images/pm.png"></a>

                <a href="https://bitcoin.org/ru/" target="_blank "><img style="display: inline-block;margin-left: 20px;" title = "Bitcoin "src="/images/Bitcoin.png"></a>

                <a href="https://www.privat24.ua/" target="_blank"> <img title ="Privat24" style="display: inline-block;margin-left: 20px;" src="/images/privat24.jpg"></a>


                <a href="https://payeer.com/ru/" target="_blank"> <img style="display: inline-block;margin-left: 20px;" title ="Payeer" src="/images/payeer.png"></a>
                </div>
                <div style="margin: 80px 20px" id="minfincomua_i_usd">Загружаем межбанк от <a href="http://minfin.com.ua/">minfin.com.ua</a></div><script type="text/javascript" src="http://informer.minfin.com.ua/interbank/usd.js"></script>
            </div>
            <div class="col-lg-9" style="min-height: 710px;border-left: 1px solid darkgray;border-right: 1px solid darkgray;">
                        <h4 style="color:rgba(63, 68, 92, 1);text-align: center">Список предложений:</h4>
                        <p id="test"></p>
                    <?php
                    foreach ($currency as $val){
                        if ($val->parrent_id!=0) {
                            $name_currency[$val->name] = $val->name;
                        }
                    }?>
                <!-- Button trigger modal -->
                <?php if (Yii::$app->session->get('id')):?>
                <button id="btn" type="button" style="float:right" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Добавить
                </button>
                <?php else: ?>
                     <a class="btn btn-primary"  style="float:right" href="<?php echo Url::toRoute(['site/login'])?>">Добавить</a>
                <?php endif;?>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 style="text-align: center" class="modal-title" id="myModalLabel">Добавить предложение:</h4>
                            </div>
                            <div style="text-align:center;margin: 0 auto;" class="modal-body">
                                <?php $form = ActiveForm::begin();
                                ?>
                                <p style="margin-bottom: 20px;text-align: center;font-weight: bold;font-size: 16px;">Отдаете:</p>
                                <div style="display: inline-block;width: 120px;margin-right:10px;vertical-align: top">
                                    <?php echo $form->field($model,'currency_from')->dropDownList($name_currency,[
                                        'prompt' => 'Выбрать...',
                                        'id'=>'cur_from',
                                        'OnChange' => 'ChangeCurrencyFrom()'
                                    ])->label('Валюта:')?>
                                </div>
                                <div style="display: inline-block;margin-right:10px; width: 120px;vertical-align: top">
                                    <?php echo $form->field($model,'sum_from')->textInput(['type'=>'number','min'=>"1",'placeholder'=>'Сумма','onchange'=>'rateToSum()'])->label('Сумма:')?>
                                </div>

                                <div style="display: inline-block;width: 120px;vertical-align: top;">
                                    <?php echo $form->field($model,'rate')->textInput(['class'=>'avg form-control','type'=>'number','step'=>"0.0001",'min'=>"0.0001",'placeholder'=>'Курс','onchange'=>'rateToSum()'])->label('Курс:')?>
                                </div>
                                <p style="margin-bottom: 20px;margin-top: 20px;text-align: center;font-weight: bold;font-size: 16px;">Получаете:</p>
                                <div style="display: inline-block;margin-right:10px; width: 120px;vertical-align: top">
                                    <?php echo $form->field($model,'currency_to')->dropDownList($name_currency,[
                                        'prompt' => 'Выбрать...',
                                        'id'=>'cur_to',
                                        'OnChange' => 'ChangeCurrencyTo()'
                                    ] )->label('Валюта:')?>
                                </div>
                                <div style="display: inline-block;margin-right:10px; width: 120px;vertical-align: top">
                                    <?php echo $form->field($model,'sum_to')->textInput(['type'=>'number', 'step'=>"0.01", 'min'=>"0.1",'placeholder'=>'Сумма','onchange'=>'sumToRate()'])->label('Сумма:')?>
                                </div>
                                <div style="display: inline-block;width: 120px;vertical-align: top">
                                    <span id="avg" >Средний курс:</span>
                                    <p id="rate" style="line-height:33px;color:grey;text-align:center;height:34px;border-radius:5px;margin-top: 5px;" class="bg-success"></p>
                                </div>
                                <div style="margin-top: 20px;">
                                    <?php echo $form->field($model,'description')->textarea(['rows'=>'5', 'cols'=>'15','style'=>'margin:0 auto;width:386px'])->label('Коментарий')?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                <?php echo Html::submitButton('Добавить',['class'=>'btn btn-primary','style'=>'margin:20px 0;'])?>
                            </div>
                      <?php ActiveForm::end();?>
                        </div>
                    </div>
                </div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Все</a></li>
                        <?php foreach ($currency as $elem):
                            if ($elem->parrent_id==0):
                            ?>
                        <li role="presentation"><a href="#<?php echo $elem->name;?>" aria-controls="<?php echo $elem->name;?>" role="tab" data-toggle="tab"><?php echo $elem->name;?></a></li>
                        <?php endif;endforeach;?>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <table style="text-align: center" class="table table-hover">
                                    <tr>
                                        <th style="text-align: center">Время</th>
                                        <th style="text-align: center">Что меняем</th>
                                        <th style="text-align: center">Сумма</th>
                                        <th style="text-align: center">Курс</th>
                                        <th style="text-align: center">На что меняем</th>
                                        <th style="text-align: center">Сумма</th>
                                        <th style="text-align: center">Описание</th>
                                        <th style="text-align: center">Пользователь</th>
                                    </tr>
                                <?php foreach ($propositions as $elem):?>
                                    <tr>
                                    <td style="margin-top: 10px;"><?php echo substr($elem->date,10)?></td>
                                        <td><?php echo $elem->currency_from;?></td>
                                        <td><?php echo round($elem->sum_from,2);?></td>
                                    <td><?php echo round($elem->rate,2);?></td>
                                        <td><?php echo $elem->currency_to;?></td>
                                        <td><?php echo round($elem->sum_to,2);?></td>
                                    <td style="text-align: left"><?php  echo $elem->description;?><br>
                                        <span style="color: steelblue;">Контракты: </span><span class="span-count-contr-<?php echo $elem->user->login;?>" style="padding-right: 20px;color: steelblue;">0</span>
                                        <a style="font-size: 18px;padding-right: 5px"
                                           title="Торг" class="glyphicon glyphicon-wrench"
                                           id="modal-btn-auction-<?php echo $elem->id ?>"
                                           href="javascript: auction(<?php echo $elem->id ?>, <?php echo $elem->user_id ?>, <?php echo !empty(Yii::$app->session->get(id)) ? Yii::$app->session->get(id) : '0'; ?>);"
                                           data-target-auction-<?php echo $elem->id ?>="<?php echo Url::to("/auction/index/$elem->id")?>">
                                        </a>
                                        <a href="javascript: accept(<?php echo $elem->id . ', ' . $elem->user_id ?>, <?php echo !empty(Yii::$app->session->get(id)) ? Yii::$app->session->get(id) : '0'; ?>);" title="Принять предложение" class="glyphicon glyphicon-ok"></a>
                                    </td>
                                    <td><a href="#"><?php echo $elem->user->login;?></a></td>
                                    </tr>
                                    <?php endforeach;?>
                                </table>
                            </div>
                            <?php foreach ($currency as $elem):?>
                            <div role="tabpanel" class="tab-pane" id="<?php echo $elem->name;?>">
                                <table  style="text-align: center" class="table table-hover">
                                    <tr>
                                        <th style="text-align: center">Время</th>
                                        <th style="text-align: center">Что меняем</th>
                                        <th style="text-align: center">Сумма</th>
                                        <th style="text-align: center">Курс</th>
                                        <th style="text-align: center">На что меняем</th>
                                        <th style="text-align: center">Сумма</th>
                                        <th style="text-align: center">Описание</th>
                                        <th style="text-align: center">Пользователь</th>
                                    </tr>
                                    <?php
                                    foreach ($currency as $child):
                                    foreach ($propositions as $val):
                                        if ($elem->id==$child->parrent_id):
                                            if($child->name == $val->currency_from):
                                        ?>
                                            <tr>
                                                <td style="margin-top: 10px;"><?php echo substr($val->date,10)?></td>
                                                <td><?php echo $val->currency_from;?></td>
                                                <td><?php echo round($val->sum_from,2);?></td>
                                                <td><?php echo round($val->rate,2);?></td>
                                                <td><?php echo $val->currency_to;?></td>
                                                <td><?php echo round($val->sum_to,2);?></td>
                                                <td style="text-align: left"><?php  echo $val->description;?><br>
                                                    <span style="color: steelblue;">Контракты: </span><span class="span-count-contr-<?php echo $val->user->login;?>" style="padding-right: 20px;color: steelblue;">0</span>
                                                    <a style="font-size: 18px;padding-right: 5px"title="Торг" class="glyphicon glyphicon-wrench" href="javascript: auction(<?php echo $val->id . ', ' . $val->user_id ?>, <?php echo !empty(Yii::$app->session->get(id)) ? Yii::$app->session->get(id) : '0'; ?>);"> </a>
                                                    <a href="javascript: accept(<?php echo $val->id . ', ' . $val->user_id ?>, <?php echo !empty(Yii::$app->session->get(id)) ? Yii::$app->session->get(id) : '0'; ?>);" title="Принять предложение" class="glyphicon glyphicon-ok"></a>
                                                </td>
                                                <td><a href=""><?php echo $val->user->login;?></a></td>
                                            </tr>
                                        <?php endif; endif;endforeach; endforeach?>
                                </table>
                            </div>
                            <?php endforeach; ?>
                        <?php
                        Modal::begin([
                            'header' => '<h3 style="text-align:center">Предложить торг:</h3>',
                            'id' => 'modal-auction',
                            'size' => '',
                        ]);
                        ?>
                        <div id='modal-content-auction'>Загружаю предложения... Чекай ...</div>
                        <?php
                        Modal::end();
                        ?>
                    </div>
            </div>
        </div>
    </div>
</div>

