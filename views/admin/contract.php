<h1 style="text-align: center">Панель Контрактов</h1>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th style="text-align: center">№ Контракта</th>
            <th style="text-align: center">Имя:</th>
            <th style="text-align: center">Сумма:</th>
            <th style="text-align: center">Счета:</th>
        </tr>
<?php foreach ($data_auc as $auc_data):?>
    <?php foreach ($data_prop as $prop_data):?>
        <?php if ($prop_data['id'] == $auc_data['id']):?>
        <tr>
            <td>
                <p style="text-align: center;"><?php echo $prop_data['id']; ?></p>
            </td>
            <td>
                <table width="100%"  style="background:#E4E4E4;margin-top: 0;"  class="table">
                    <tr><td style="text-align: center;"><?php echo $prop_data['prop_login']; ?></td></tr>
                    <tr><td style="text-align: center;"><?php echo $auc_data['auc_login']; ?></td></tr>
                </table>
            </td>
            <td>
                <table width="100%" style="background:#E4E4E4;"  class="table">
                    <tr><td style="text-align: center;"><?php echo round($auc_data['sum_auc'],2); ?></td></tr>
                    <tr><td style="text-align: center;"><?php echo round($prop_data['sum_prop'],2); ?></td></tr>
                </table>
            </td>
            <td>
                <table width="100%"  style="background:#E4E4E4;"  class="table">
                    <tr><td style="text-align: center;"><?php echo $prop_data['ac_prop']; ?></td></tr>
                    <tr><td style="text-align: center;"><?php echo $auc_data['ac_auc']; ?></td></tr>
                </table>
            </td>
            <td>
                <table width="100%" style="background:#E4E4E4;" class="table">
                    <tr><td style="text-align: center"><a  target="_blank" href="https://mini.webmoney.ru/">Оплатить</a></td></tr>
                    <tr><td style="text-align: center"><a target="_blank" href="https://mini.webmoney.ru/">Оплатить</a></td></tr>
                </table>
            </td>
            <td>
                <a class="btn btn-primary" href="?id=<?php echo $prop_data['id']?>">Завершить контракт</a>
            </td>
        </tr>
        <?php  endif;?>
    <?php  endforeach; ?>
<?php ; endforeach;?>
    </table>
</div>

