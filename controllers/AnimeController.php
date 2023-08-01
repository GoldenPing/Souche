<?php


class AnimeController extends Controller
{

    public function allAnime()
    {
        $data['anime'] = ListAnimeService::getListAllAnimes();
        $data['studio'] = ListAnimeService::getListStudioForm();
        $data['tags'] = ListAnimeService::getListTagsForm();

        $this->render("listAnime", $data);
    }


    public function oneAnime($params)
    {
        $data['anime'] = Anime::one($params['id']);
        $data['tags']  = Anime::one($params['id'])->tags();
        $data['studios'] = Anime::one($params['id'])->studios();
        $data['isAdd'] = UserListService::isAlreadyAdd($params['id']);
        if ($data['isAdd']){
            $data['hisEtat'] = UserListService::getEtatFromAnime($params['id']);
            $data['notes']   = Note::all();
            $isNote = NoteService::isNote($params['id']);
            if ($isNote){
                $data['note'] = NoteService::getNoteFromUserWatchStat($params['id']);
            }
        }else{
            $data['hisEtat'] = false;
        }
        $this->render('oneAnime', $data);
    }
}