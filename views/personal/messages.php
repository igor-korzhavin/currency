<?php
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\helpers\Html;
?>
<div class="col-lg-9">
    <h3 style="text-align: center;margin-bottom: 30px;">Сообщения:</h3>
    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" >Принятые:</a></li>
            <li role="presentation"><a href="#barge" aria-controls="barge" role="tab" data-toggle="tab">Торги  <?php echo Html::tag('span', "_", ['class' => 'badge','id'=>"auction",'style'=>'background-color:steelblue'])?></a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Отклоненные</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Завершенные контр.</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <table style="text-align: center" class="table table-bordered table-hover">
                    <tr>
                        <thead>
                        <th>№</th>
                        <th>Имя</th>
                        <th style="text-align: center">Ваша сумма:</th>
                        <th style="text-align: center">Вам предлагают:</th>
                        <th style="text-align: center">Курс:</th>
                        <th style="text-align: center">Тема письма:</th>    
                        <th style="text-align: center">Время:</th>
                        <th>Решение</th>
                        </thead>
                    </tr>
                    <?php foreach ($accept_msg as $elem):?>
                        <?php if ($elem->status == 5):?>
                            <tr>
                                <td><?php echo $elem->id;?></td>
                                <td><?php echo $elem->comment;?></td>
                                <td><?php echo round($elem->propositions->sum_to,2);?></td>
                                <td><?php echo round($elem->sum_to,2);?></td>
                                <td><?php echo round($elem->rate,2)?></td>
                                <td style="color: darkblue">Предложение принято!</td>
                                <td><?php echo substr($elem->date,10)?></td>
                                <td><a  href="javascript:ok(<?php echo $elem->propositions->id. ', ' . $elem->id  ?>)" title="согласиться" class="glyphicon glyphicon-ok"></a>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php foreach ($prop as $elem):
                        foreach($elem->auctions as $val): ?>
                            <?php if ($val->status==2): ?>
                            <tr>
                                <td><?php echo $val->id; ?></td>
                                <td><?php echo $val->comment ?></td>
                                <td><?php echo round($elem->sum_to,2); ?></td>
                                <td><?php echo round($val->sum_to,2); ?></td>
                                <td><?php echo round($val->rate,2); ?></td>
                                <td style="color: darkgreen">Предложение принято!</td>
                                <td><?php echo substr($val->date,10); ?></td>
                                <td><a  href="javascript:ok(<?php echo $elem->id . ', ' . $val->id; ?>)" title="согласиться" class="glyphicon glyphicon-ok"></a>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="barge">

                <table style="text-align: center" class="table table-bordered table-hover">
                    <thead>
                    <th>№</th>
                    <th style="text-align: center">Имя</th>
                    <th style="text-align: center">Сумма предл.:</th>
                    <th style="text-align: center">Сумма торга:</th>
                    <th style="text-align: center">Курс:</th>
                    <th style="text-align: center">Инфо</th>
                    <th style="text-align: center">Время:</th>
                    <th style="text-align: center;">Дейст.</th>
                    <th style="text-align: center; width: 200px">История</th>
                    </thead>
                    <?php foreach ($accept_msg as $elem):?>
                        <?php if ($elem->status == 4):?>
                            <tr>
                                <td><?php echo $elem->id;?></td>
                                <td><?php echo $elem->comment;?></td>
                                <td><?php echo round($elem->propositions->sum_to,2);?></td>
                                <td><?php echo round($elem->sum_to,2);?></td>
                                <td><?php echo round($elem->rate,2)?></td>
                                <td style="color: darkgreen">Торг!</td>
                                <td><?php echo substr($elem->date,10)?></td>
                                <td>
                                    <a  href="javascript: accProp(<?php echo $elem->propositions->id. ', ' . $elem->id  ?>)" title="согласиться" class="glyphicon glyphicon-ok"></a>
                                    <a style="padding-right: 5px"
                                       title="продолжить торг"
                                       id="modal-btn-auction-<?php echo $elem->id ?>"
                                       href="javascript: bargain(<?php echo $elem->id ?>);"
                                       data-target-auction-<?php echo $elem->id ?>="<?php echo Url::to("/auction/bargain/$elem->id")?>">
                                        &#128177</a>
                                    <a href="javascript: no_bargain(<?php echo $elem->id ?>)" title="отклонить" class="glyphicon glyphicon-remove"></a>
                                    <span style="cursor: pointer;color:#337ab7" title="История торгов" class="eye glyphicon glyphicon-eye-open"></span>
                                </td>
                                <td style="padding: 0">
                                    <div class="lorem" style="display: none">
                                        <table style="text-align: center;margin-bottom: 0;" class="table table-bordered table-hover">
                                            <thead>
                                            <th style="text-align: center">Курс:</th>
                                            <th style="text-align: center">Сумма:</th>
                                            <th style="text-align: center">Имя</th>
                                            </thead>
                                        <?php foreach ($history as $h_value){?>
                                            <?php if ($h_value->status == 6 and $elem->propositions->id == $h_value->id_prop){?>
                                            <tr>
                                                <td><?php echo round($h_value->rate,2)?></td>
                                                <td><?php echo round($h_value->sum_to,2)?></td>
                                                <td><?php echo $h_value->comment ?></td>
                                            </tr>
                                            <?php  }?>
                                        <?php } ?>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php foreach ($prop as $value):?>
                        <?php foreach ($value->auctions as $auc):?>
                            <?php if ($auc->status == 7 or $auc->status == 0):?>
                                <tr>
                                    <td><?php echo $auc->id;?></td>
                                    <td><?php echo $auc->comment;?></td>
                                    <td><?php echo round($value->sum_to,2);?></td>
                                    <td><?php echo round($auc->sum_to,2);?></td>
                                    <td><?php echo round($auc->rate,2)?></td>
                                    <td style="color: darkgreen">Торг!</td>
                                    <td><?php echo substr($auc->date,10)?></td>
                                    <td>
                                        <a  href="javascript: acc(<?php echo $value->id. ', ' . $auc->id  ?>)" title="согласиться" class="glyphicon glyphicon-ok"></a>
                                        <a style="padding-right: 5px"
                                           title="продолжить торг"
                                           class="glyphicon glyphicon-wrench"
                                           id="modal-btn-auction-<?php echo $auc->id ?>"
                                           href="javascript: bargain(<?php echo $auc->id ?>);"
                                           data-target-auction-<?php echo $auc->id ?>="<?php echo Url::to("/auction/bargain/$auc->id")?>">
                                           </a>
                                        <a href="javascript: no_bargain(<?php echo $auc->id ?>)" title="отклонить" class="glyphicon glyphicon-remove"></a>
                                        <span style="cursor: pointer;color:#337ab7" title="История торгов"  class="eye glyphicon glyphicon-eye-open"></span>
                                    </td>
                                    <td style="padding: 0">
                                        <div class="lorem" style="display: none">
                                            <table style="text-align: center;margin-bottom: 0;" class="table table-bordered table-hover">
                                                <thead>
                                                <th style="text-align: center">Курс:</th>
                                                <th style="text-align: center">Сумма:</th>
                                                <th style="text-align: center">Имя</th>
                                                </thead>
                                            <?php foreach ($history2 as $h_value2){?>
                                                <?php if ($h_value2->status == 6 and $value->id == $h_value2->id_prop){?>
                                                    <tr>
                                                        <td><?php echo round($h_value2->rate,2) ?></td>
                                                        <td><?php echo round($h_value2->sum_to,2) ?></td>
                                                    <td><?php echo $h_value2->comment?></td>
                                                    </tr>
                                                <?php  }?>
                                            <?php } ?>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; endforeach;?>
                </table>

            </div>
            <div role="tabpanel" class="tab-pane" id="messages">
                <table style="text-align: center" class="table table-bordered table-hover">
                    <tr>
                        <thead>
                        <th>№</th>
                        <th style="text-align: center">Ваша сумма:</th>
                        <th style="text-align: center">Вам предлагали:</th>
                        <th style="text-align: center">Курс:</th>
                        <th style="text-align: center">Пользователь</th>
                        <th style="text-align: center">Дата:</th>
                        </thead>
                    </tr>
                    <?php foreach ($prop as $elem):
                        foreach($elem->auctions as $val):?>
                            <?php if ($val->status == 1):?>
                                <tr>
                                    <td><?php echo $val->id;?></td>
                                    <td><?php echo round($elem->sum_to,2);?></td>
                                    <td><?php echo round($val->sum_to,2);?></td>
                                    <td><?php echo round($val->rate,2)?></td>
                                    <td><?php echo $val->comment?></td>
                                    <td><?php echo substr($val->date,10)?></td>
                                </tr>
                            <?php endif;endforeach; endforeach;?>
                </table>
            </div>

            <div role="tabpanel" class="tab-pane" id="settings">
                <table style="text-align: center" class="table table-bordered table-hover">
                    <tr>
                        <thead>
                        <th style="text-align: center">№</th>
                        <th style="text-align: center">Получ. сумма:</th>
                        <th style="text-align: center">Отдан. сумма:</th>
                        <th style="text-align: center">Направ. перевода</th>
                        <th style="text-align: center">Курс:</th>
                        <th style="text-align: center">Дата:</th>
                        </thead>
                    </tr>
                    <?php foreach ($contr as $con):?>
                    <tr>
                        <td><?php echo $con['id'] ?></td>

                        <?php if($con['id_prop'] == Yii::$app->session->get('id')): ?>

                        <td><?php echo round($con['sum_auc'] * 0.995,2); ?></td>
                        <td><?php echo round($con['sum_prop'],2); ?></td>
                        <td><?php echo $con['currency_from'] ?> -> <?php echo $con['currency_to'] ?></td>
                        <td><?php echo round($con['sum_auc']/$con['sum_prop'] ,2) ?></td>

                        <?php else: ?>

                        <td><?php echo round($con['sum_prop'] * 0.995,2); ?></td>
                        <td><?php echo round($con['sum_auc'],2); ?></td>
                        <td><?php echo $con['currency_to'] ?> -> <?php echo $con['currency_from'] ?></td>
                        <td><?php echo round($con['sum_prop']/$con['sum_auc'] ,2) ?></td>

                        <?php endif; ?>

                        <td><?php echo $con['date'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>

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
