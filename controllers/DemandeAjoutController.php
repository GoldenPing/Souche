<?php

class DemandeAjoutController extends Controller
{

    public function askAddAnime()
    {
        $this->render("demandeAjout");
    }

    public function findCopicat($params)
    {
        $validator = new ValidatorUtils($params);
        $validator->isNotNull("nameAnime");
        $validator->isNotNull("tagAnime");
        $validator->isNotNull("studioAnime");

        if ($validator->isValidate() === true) {
            $copicat = DemandeAjoutService::findCopicat($params);
            $_SESSION['formAjout'] = $params;
            if (!empty($copicat)) {
                $this->render("findCopicat",$copicat);
            } else {
                $this->render("findNoCopicat");
            }
        } else {

            $_SESSION['errors']['firstStepAddAnime'] = $validator->isValidate();
            $_SESSION['input']['firstStepAddAnime'] = $params;
            $this->redirect("askAddAnime");
        }
    }

    public function showComplementForm($params)
    {

        $data = [
            "type" => TypeAnimeService::getTypes()
        ];
        $this->render("complementForm",$data);
    }

    public function tryFinalForm($params)
    {
        var_dump($params);
        DemandeAjoutService::newDemande($params);
    }
}