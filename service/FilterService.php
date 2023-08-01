<?php

class FilterService
{


    public static function doFilter($params)
    {
        $idUser = $_SESSION['user']->idUser?? $params['idUser'];
        $etatParams = $params['etat'];
        $noteParams = $params['note'];

        if ($etatParams !== '.' && $noteParams !== '.') {
          return  self::doubleFilter($noteParams, $etatParams, $idUser);
        } else if ($etatParams !== '.') {
            return self::simpleFilterEtat($etatParams, $idUser);
        } else if ($noteParams !== '.' && $etatParams === '4') {
            return self::simpleFilterNote($noteParams,$idUser);
        } else {
            return ListAnimeService::getMyListeAnime();
        }

    }

    private static function doubleFilter($noteParams, $etatParams, $idUser)
    {
        $userWatch = UserWatchState::find(['idNote' => $noteParams , 'idEtat' => $etatParams , 'idUser' => $idUser]);
        $result = [];
        foreach ($userWatch as $watch) {
            $result [] = $watch->anime();
        }
        return $result;
    }

    private static function simpleFilterEtat($etatParams, $idUser)
    {
        $userWatch = UserWatchState::find(['idEtat' => $etatParams , 'idUser' => $idUser]);
        $result = [];
        foreach ($userWatch as $watch) {
            $result [] = $watch->anime();
        }
        return $result;
    }

    private static function simpleFilterNote($noteParams, $idUser)
    {
        $userWatch = UserWatchState::find(['idNote' => $noteParams , 'idUser' => $idUser]);
        $result = [];
        foreach ($userWatch as $watch) {
            $result [] = $watch->anime();
        }
        return $result;
    }


}