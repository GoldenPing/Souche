<?php

class NoteController extends Controller
{
    public function updateNote($params)
    {
        $idUser = $_SESSION['user']->idUser;

        $validator = new ValidatorUtils($params);

        $validator->selectNull('note');
        if ($validator->isValidate() === true){
            NoteService::updateNote($idUser,$params['id'],$params['note']);
            if (isset($_SESSION['errors'][$params['id']]['note'])){
                $_SESSION['errors'][$params['id']]['note'] = null;
            }
        }else{
            $_SESSION['errors'][$params['id']] =  $validator->errorMsgs[0];
        }
        $this->redirect('anime?id='.$params['id']);

}

}