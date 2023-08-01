<?php

class NoteService
{

    public static function addNewNote($idUser,$idAnime,$idNote)
    {
        $userWatchState = UserWatchState::find(['idUser' => $idUser,'idAnime' => $idAnime])[0];
        $userWatchState->idNote = $idNote;
        $userWatchState->save();
    }

    public static function isNote($id)
    {
        if (!isset($_SESSION['user'])){
            return false;
        }
        $animeUser = UserWatchState::find(["idUser" =>$_SESSION['user']->idUser,"idAnime"=>$id])[0];
        if (isset($animeUser->idNote)){
            return true;
        }
        return false;
    }

    public static function getNoteFromUserWatchStat($id)
    {
        $animeUser = UserWatchState::find(["idUser" =>$_SESSION['user']->idUser,"idAnime"=>$id])[0];
        return $animeUser->note();

    }

    public static function updateNote($idUser, $id, $note)
    {
        $userState = UserWatchState::find(['idUser'=>$idUser,'idAnime' => $id])[0];
        $userState->idNote = $note;
        $userState->save();
    }

}