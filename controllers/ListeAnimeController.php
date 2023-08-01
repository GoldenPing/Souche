<?php

class ListeAnimeController extends Controller {


    public function myList($params)
    {
        $data["anime"] = ListAnimeService::getMyListeAnime($params);
        $data["tags"]  = ListAnimeService::getListTagsForm();
        $data["studio"] = ListAnimeService::getListStudioForm();
        $data["etats"]  = ListAnimeService::getAllEtat();
        $data["notes"]  = ListAnimeService::getAllNote();
        $this->render("myList",$data);
    }

    public function add($params)
    {
        UserListService::addToList($_SESSION["user"]->idUser,$params['id']);
        $this->redirect('animes');
    }
}