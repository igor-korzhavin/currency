<div class="container">
    <div class="row"">
    <div class="col-md-9 col-md-offset-3">

        <h3 >Текущий курс электронных валют:</h3>


<table style="width: 50%" class="table table-hover table-bordered">
    <tr>
        <th>Что меняем</th>
        <th>На что меняем</th>
        <th>Отдаете</th>
        <th>Получаете</th>
    </tr>
    <?php
    foreach ($sxml as $value):?>
    <tr>
        <td><?php echo $value->currency_from ?></td>
        <td><?php echo $value->currency_to ?></td>
        <td><?php echo $value->rate_in ?></td>
        <td><?php echo $value->rate_out ?></td
    </tr>

    <?php endforeach;?>

</table>
    </div>
</div>
</div>