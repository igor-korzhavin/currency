<?php
use yii\helpers\Url;
?>

<h2 style="text-align: center">Панель администрирования:</h2>

<select id='models'>
    <option></option>
</select>
<a class="btn btn-primary"  style="float:right" href="<?php echo Url::toRoute(['admin/contract'])?>">Koнтракты
</a>
    <table class='table'>
        <thead id='dataHead'>
            <tr>
                <th></th>
            </tr>
        </thead>
        <tbody id='data'>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
<script src='js\nb.js'></script>
<script src='js\make_admin_page.js'></script>