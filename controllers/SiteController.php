<?php


class SiteController extends Controller
{

    public function index($params)
    {
        $this->render("home");
    }

    public function doResearch($params)
    {
        $data['tags'] = ListAnimeService::getListTagsForm();
        $data['studio'] = ListAnimeService::getListStudioForm();
        $data['anime'] = RechercheService::doResearch($params);
        $data['input'] = ["tags" => $params['tags'], "studio" => $params['studio'], "search" => $params['search']];

        if (isset($params['isMyList']) && $params['isMyList'] === 'true') {
            $data["etats"] = ListAnimeService::getAllEtat();
            $data["notes"] = ListAnimeService::getAllNote();
            $this->render("myList", $data);

        } else {
            $this->render("listAnime", $data);
        }
    }

    public function filter($params)
    {
        $data["anime"] = FilterService::doFilter($params);
        $data["etats"] = ListAnimeService::getAllEtat();

        $data["notes"] = ListAnimeService::getAllNote();
        $data['tags'] = ListAnimeService::getListTagsForm();
        $data['studio'] = ListAnimeService::getListStudioForm();
        $data['input'] = ['note' => $params['note'], 'etat' => $params['etat']];

        $this->render("myList", $data);
    }

    public function confirmMail($params)
    {
        $user = TmpUser::one($params['id']);
        $this->render("confirmMail",$user);
    }

    public function reSendMail($params)
    {
        var_dump($params);
        $newUser = TmpUser::one($params['id']);
        MailService::mailConfirmation($newUser->mailTmpUser);
        $this->redirect("confirmMail?id=".$params['id']);
    }
}
