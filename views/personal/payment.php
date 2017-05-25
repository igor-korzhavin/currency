<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use \yii\widgets\ActiveForm;
use \yii\helpers\Url;
?>
<?php if (!empty($account)):?>
<div class="col-lg-9">
    <h3 style="text-align: center;margin-bottom: 30px;">Платежные реквизиты:</h3>
    <table style="text-align: center" class="table table-bordered table-hover">
        <tr >
            <th style="text-align: center">Платежная система:</th>
            <th style="text-align: center">Счет:</th>
        </tr>
        <?php foreach ($account as $value):?>
            <tr>
                <td><?php echo $value->type_account?></td>
                <td><?php echo $value->account?></td>
            </tr>
        <?php endforeach;?>
    </table>
</div>
<?php else: echo "<h3 style='text-align: center'>Нет данных...</h3>"; endif;?>
