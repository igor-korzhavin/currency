<?php
use \yii\helpers\Url;
?>

<div class="col-lg-9">
        <h3 style="text-align: center;margin-bottom: 30px;">Мои объявления:</h3>
        <div class="row">
            <div class="col-lg-12">
            <table style="text-align: center" class="table table-bordered table-hover">
                <tr>
                   <thead>
                    <th>№</th>
                    <th style="text-align: center">Отдаёте:</th>
                    <th style="text-align: center">Сумма:</th>
                    <th style="text-align: center">Курс:</th>
                    <th style="text-align: center">Получаете:</th>
                    <th style="text-align: center">Сумма:</th>
                   <th style="text-align: center">Коментарий:</th>
                   <th style="text-align: center">Дата:</th>
                   <th style="text-align: center">Удалить</th>
                   </thead>
                </tr>
                <?php foreach ($prop as $value):?>
                    <tr>
                        <td><?php echo $value->id;?></td>
                        <td><?php echo $value->currency_from;?></td>
                        <td><?php echo $value->sum_from?></td>
                        <td><?php echo $value->rate?></td>
                        <td><?php echo $value->currency_to?></td>
                        <td><?php echo $value->sum_to?></td>
                        <td><?php echo $value->description?></td>
                        <td><?php echo $value->date?></td>
                        <td><a style="font-weight: bold;" title="Удалить" href="<?php echo Url::toRoute(["personal/propositions/$value->id"]);?>">X</a></td>
                    </tr>
                <?php endforeach;?>
            </table>
            </div>
        </div>
    </div>
</div>
