<?php

class UserListService
{

    static public function addToList($idUser, $idAnime)
    {
        $addAnime = new UserWatchState();
        $addAnime->idUser = $idUser;
        $addAnime->idAnime = $idAnime;
        $addAnime->idEtat = 1;

        $addAnime->save();
    }

    static public function isAlreadyAdd($idAnime){
        if (!isset($_SESSION['user'])){
            return false;
        }
        $animeUser = UserWatchState::find(['idUser' => $_SESSION['user']->idUser]);
        $animeUser = ArrayUtils::makeIdArrayObject($animeUser,'idAnime');
        if (isset($animeUser[$idAnime])){
            return true;
        }

        return false;
    }

    public static function getEtatFromAnime($idAnime)
    {
        $animeWatch = UserWatchState::find(['idUser' => $_SESSION['user']->idUser , "idAnime" => $idAnime],"idAnime");
        $etat = UserWatchState::one($animeWatch[0]->idUserwatchstate)->etat();
        return $etat;
    }
}