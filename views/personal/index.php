<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use \yii\widgets\ActiveForm;
use \yii\helpers\Url;

?>
<div class="col-lg-9">
    <h3 style="text-align: center;margin-bottom: 30px;">Информация:</h3>
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <a href="#" class="thumbnail">
                    <?= Html::img('@web/images/no-avatar.jpg', ['alt' => 'main']) ?>
                </a>
            </div>
            <div style="margin-left: 250px;">
            <p><b style="font-size: 16px;">Логин:  </b> <?php echo $user->login;?></p>
            <p><b style="font-size: 16px;">Имя:  </b><?php echo $user->name;?></p>
            <p><b style="font-size: 16px;">Фамилия:  </b><?php echo $user->surname;?></p>
            <p><b style="font-size: 16px;">Эл.адресс:  </b><?php echo $user->email;?></p>
            </div>
        </div>
</div>
