<?php

class UserService
{

    static public function userLogin($pParams)
    {
        if (User::login($pParams['loginUser'], $pParams['passwordUser'])) {
            global $user;
            $_SESSION['user'] = $user;
            return true;
        } else {
            $_SESSION['errors']["login"] = "Nom d'utilisateur et/ou mot de passe invalide";
            return false;
        }
    }

    public static function signIn($loginUser, $mailUser, $passwordUser , $passwordConfirmUser)
    {
        $validator = new ValidatorUtils(['loginUser' => $loginUser,'mailUser' => $mailUser,'passwordUser' => $passwordUser,'passwordConfirmUser' => $passwordConfirmUser]);

        $validator->isNotNull('loginUser');
        $validator->isNotNull('mailUser');
        $validator->isNotNull('passwordUser');
        $validator->isNotNull('passwordConfirmUser');

        $validator->isMailValid('mailUser');
        $validator->minLenght('passwordUser',8);

        $validator->sameField('passwordUser','passwordConfirmUser');



        return $validator->isValidate();
    }

    public static function alloneUser($mailUser)
    {
        $users = User::find(['mailUser' => $mailUser]);
        return empty($users);
    }

    public static function newUser($idTmpUser)
    {
        $user = TmpUser::one($idTmpUser);


        $newUser = new User();
        $newUser->mailUser = $user->mailTmpUser;
        $newUser->loginUser = $user->loginTmpUser;
        $newUser->passwordUser = $user->passwordTmpUser;
        $newUser->idRole = 2;
        $newUser->save();
        TmpUser::delete($idTmpUser);
        return  User::find([ "mailUser" => $newUser->mailUser])[0];

    }

    public static function samePass($passwordUser, $passwordConfirmUser)
    {
        var_dump($passwordUser);
        var_dump($passwordConfirmUser);
        die();
    }
}
