<?php

class EtatAnimeService
{


    public static function saveToPlay($idUser, $idAnime)
    {
        $userWatchAnime = UserWatchState::find(["idUser" => $idUser, "idAnime" => $idAnime])[0];
        self::changeEtat($userWatchAnime,2);
    }

    public static function pauseToPlay($idUser, $idAnime)
    {
        $userWatchAnime = UserWatchState::find(["idUser" => $idUser, "idAnime" => $idAnime])[0];
        self::changeEtat($userWatchAnime,2);
    }

    public static function playToPause($idUser, $idAnime)
    {
        $userWatchAnime = UserWatchState::find(["idUser" => $idUser, "idAnime" => $idAnime])[0];
        self::changeEtat($userWatchAnime,6);
    }

    public static function playToEnd($idUser, $idAnime)
    {
        $userWatchAnime = UserWatchState::find(["idUser" => $idUser, "idAnime" => $idAnime])[0];
        self::changeEtat($userWatchAnime,3);
    }

    public static function endToNote($idUser, $idAnime)
    {
        $userWatchAnime = UserWatchState::find(["idUser" => $idUser, "idAnime" => $idAnime])[0];
        self::changeEtat($userWatchAnime,4);
    }
    public static function changeEtat($userWatch, $etat)
    {
        $userWatch->idEtat = $etat;
        $userWatch->save();
    }

    public static function remove($idUser, $idAnime)
    {
        $userWatchAnime = UserWatchState::find(["idUser" => $idUser, "idAnime" => $idAnime])[0];
        UserWatchState::delete($userWatchAnime->idUserwatchstate);
    }


}