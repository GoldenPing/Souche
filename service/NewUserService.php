<?php

class NewUserService
{

    public static function newUser($loginUser, $mailUser, $passwordUser)
    {
        $newTmpUser = new TmpUser();
        $newTmpUser->mailTmpUser = $mailUser;
        $newTmpUser->loginTmpUser = $loginUser;
        $newTmpUser->passwordTmpUser = hash('md5',$passwordUser);
        $newTmpUser->codeTmpUser = rand(100000,999999);
        $newTmpUser->save();
        return $newTmpUser;
    }

    public static function getNewUser($mailUser)
    {
        return TmpUser::find(['mailTmpUser' => $mailUser])[0];
    }

    public static function confirmUser($codeTmpUser, $idTmpUser)
    {
        $user = TmpUser::one($idTmpUser);
        if (!isset($user)){
            return false;
        }
        if ($user->codeTmpUser == $codeTmpUser){
            return true;
        }
        return false;
    }
}