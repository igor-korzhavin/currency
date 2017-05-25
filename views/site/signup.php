<?php
use \yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1><?= Html::encode($this->title) ?></h1>
            <h2>Регистрация:</h2>
<?php
    $form = ActiveForm::begin(['class'=>'form-horizontal']);
?>
<?php echo $form->field($model,'name')->textInput(['autofocus'=>true])->label('Имя')?>
<?php echo $form->field($model,'surname')->textInput()->label('Фамилия')?>
<?php echo $form->field($model,'login')->textInput()->label('Логин')?>
<?php echo $form->field($model,'email')->textInput()->label('Эл.адрес')?>
<?php echo $form->field($model,'password')->passwordInput()->label('Пароль')?>
<?php echo Html::submitButton('Применить',['class'=>'btn btn-primary','style'=>'float:right;margin-top:20px;'])?>
<?php
    ActiveForm::end();
?>
        </div>
    </div>
</div>