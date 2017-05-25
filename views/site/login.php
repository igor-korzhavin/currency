<?php
$session = Yii::$app->session;
use \yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="container">
    <div class="row"">
        <div class="col-md-4 col-md-offset-4">
            <h1><?= Html::encode($this->title) ?></h1>
            <h2 style="margin:40px 0;">Войдите в свой аккаунт:</h2>
            <?php
            $form = ActiveForm::begin(['class'=>'form-horizontal']);
            ?>
            <?php echo $form->field($login_model,'login')->textInput()->label('Логин')?>
            <?php echo $form->field($login_model,'password')->passwordInput()->label('Пароль')?>
            <div>
                <button style="margin-top: 20px;float: right" type="submit" class="btn btn-primary">Войти</button>
            </div>
            <?php
            ActiveForm::end();
            ?>
        </div>
    </div>
</div>