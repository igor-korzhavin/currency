<?php
namespace app\models;

use yii\base\Model;

class Signup extends Model
{
    public $login;
    public $email;
    public $password;
    public $name;
    public $surname;

    public function rules()
    {
        return [
            [['name','surname','login','email','password'],'required','message'=>'Поле обязательно'],
            ['email','email'],
            ['login','unique','targetClass'=>'app\models\User'],
            ['email','unique','targetClass'=>'app\models\User'],
            ['password','string','min'=>2,'max'=>10],
        ];
    }

    public function signup(){
        $user = new User();
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->login = $this->login;
        $user->email = $this->email;
        $user->password = sha1($this->password);
        return $user->save();
    }
}
