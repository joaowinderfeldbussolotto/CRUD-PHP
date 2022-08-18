<?php
namespace App\Model\Entity;
use \app\Db\Database;

class User{
    public $id;
    public $name;
    public $email;
    public $senha;

    public static function getUserByEmail($email){
        return (new Database('users'))->select("email = '".$email."'")->fetchObject(self::class);
    }
    
   
}