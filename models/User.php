<?php

class User extends Model
{
    protected $primaryKey = 'idUser';


    public function __construct()
    {
        parent::__construct($this->primaryKey);
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'idRole','idRole');
    }


    public static function login($pLogin, $pPassword)
    {
       $listUser = User::all();
       //var_dump($listUser);
       global $user;
      // $user = new User;
       foreach ($listUser as  $userItem) {
        if(($userItem->mailUser === $pLogin)
            && hash('md5', $pPassword) === $userItem->passwordUser){
            $user = User::one($userItem->idUser);
            break;
        }
       }
      
       return !is_null($user);
    }

   
}
