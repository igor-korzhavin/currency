<?php
namespace app\models;

use yii\base\Model;

class Login extends Model
{
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login','password'],'required','message'=>'Поле не может быть пустым'],
            ['password','validatePassword']
        ];
    }

    public function validatePassword($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $user = $this->getUser();
            if(!$user || !$user->validatePassword($this->password))
            {
                $this->addError($attribute,'Не верное имя(email) пользователя или пароль');
            }
        }
    }

    public function getUser()
    {
        return User::findOne(['login'=>$this->login]) ? User::findOne(['login'=>$this->login]) : User::findOne(['email'=>$this->login]);
    }
}