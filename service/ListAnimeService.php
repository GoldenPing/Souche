<?php


class ListAnimeService
{


    static public function getListAllAnimes()
    {
        return Anime::all();
    }

    static public function getListStudioForm()
    {
        return Studio::all();
    }

    static public function getListTagsForm()
    {
        return Tags::all();
    }

    public static function getMyListeAnime($params)
    {
        $userId = $_SESSION['user']->idUser ?? $params['id'];
        $animesList = UserWatchState::find(['idUser' => $userId]);
        $animeData = [];
        foreach ($animesList as $item){
            $anime = Anime::one($item->idAnime);
            $animeData []= $anime;
        }
        return ArrayUtils::makeIdArrayObject($animeData,'idAnime');
    }

    public static function getAllEtat()
    {
        $etats = Etat::all();
        $etats = ArrayUtils::makeIdArrayObject($etats,'idEtat');
        ksort($etats);
        return $etats;
    }

    public static function getAllNote()
    {
        return Note::all();
    }
}
