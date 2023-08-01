<?php

class UserController extends Controller
{
    public function login()
    {
        $this->render("formLogin");
    }

    public function tryLogin($params)
    {
        $isConnect = UserService::userLogin($params);
        if ($isConnect) {
            $this->redirect("/");
        } else {
            $this->redirect("/login");
        }
    }

    public function logout()
    {
        session_unset();
        $this->redirect("/");
    }

    public function sign()
    {
        $data['step'] = 1;
        $this->render('formSign', $data);
    }

    public function trySign($params)
    {

        $canSign = UserService::signIn($params['loginUser'], $params['mailUser'], $params['passwordUser'],$params['passwordConfirmUser']);
        $noCopicat = UserService::alloneUser($params['mailUser']);

        if ($canSign === true && $noCopicat) {
//            var_dump($params);
            $newUser = NewUserService::newUser($params['loginUser'], $params['mailUser'], $params['passwordUser']);
            MailService::mailConfirmation($params['mailUser']);
            $this->redirect("confirmMail?id=" . $newUser->idTmpUser);
        } else {
            $_SESSION['errors']['sign'] = $canSign;
            if (!$noCopicat) {
                $_SESSION['copicat']['sign'] = "Cette adresse mail est déjà relié a un autre compte.";
            }
            $_SESSION['input']['sign'] = $params;
            $this->redirect('sign');
        }
    }

    public function tryConfirm($params)
    {
        $validator = new ValidatorUtils($params);
        $validator->minLenght('codeTmpUser', 6);
        $canSign = $validator->isValidate();
        if ($canSign === true) {

            $isCheck = NewUserService::confirmUser($params['codeTmpUser'], $params["idTmpUser"]);
            var_dump($isCheck);
            if ($isCheck) {
                $user = UserService::newUser($params['idTmpUser']);
                $_SESSION['user'] = $user;
                $this->redirect(".");
            }else{
                $_SESSION['errors']['notMatch'] = "Ton Code n'est pas bon est tu sur d'avoir renseigné un mail valide ?";
                $this->redirect('confirmMail?id=' . $params["idTmpUser"]);
            }
        } else {
            $_SESSION['errors']['confirm'] = $canSign;
            $this->redirect('confirmMail?id=' . $params["idTmpUser"]);
        }
    }
}
