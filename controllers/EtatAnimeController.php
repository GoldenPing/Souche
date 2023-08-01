<?php

class EtatAnimeController extends Controller
{
    public function launch($params)
    {
        EtatAnimeService::saveToPlay($_SESSION['user']->idUser, $params['id']);
        $this->redirect('anime?id=' . $params['id']);
    }

    public function pause($params)
    {
        EtatAnimeService::playToPause($_SESSION['user']->idUser, $params['id']);
        $this->redirect('anime?id=' . $params['id']);
    }

    public function replay($params)
    {
        EtatAnimeService::pauseToPlay($_SESSION['user']->idUser, $params['id']);
        $this->redirect('anime?id=' . $params['id']);
    }

    public function end($params)
    {
        EtatAnimeService::playToEnd($_SESSION['user']->idUser, $params['id']);
        $this->redirect('anime?id=' . $params['id']);
    }

    public function newNote($params)
    {
        $idUser = $_SESSION['user']->idUser;

        $validator = new ValidatorUtils($params);

        $validator->selectNull('note');
        if ($validator->isValidate() === true) {
            NoteService::addNewNote($idUser, $params['id'], $params['note']);
            EtatAnimeService::endToNote($idUser, $params['id']);
            if (isset($_SESSION['errors'][$params['id']]['note'])) {
                $_SESSION['errors'][$params['id']]['note'] = null;
            }
        } else {
            $_SESSION['errors'][$params['id']] = $validator->errorMsgs[0];
        }
        $this->redirect('anime?id=' . $params['id']);

    }

    public function remove($params)
    {
        EtatAnimeService::remove($_SESSION['user']->idUser, $params['id']);
        $this->redirect('myList?id=' . $_SESSION['user']->idUser);
    }
}