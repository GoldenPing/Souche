<?php

class DemandeAjoutService
{


    public static function findCopicat($params)
    {
        $animes = Anime::all();
        $animeNameInput = strtolower($params['nameAnime']);
        $animeTagsInput = preg_split('/, |,/i', $params['tagAnime']);
        $animeTagsInput = array_map(function ($n){
            return  strtoupper($n);
        },$animeTagsInput);
        $animeStudiosInput = preg_split('/, |,/i', $params['studioAnime']);
        $animeStudiosInput = array_map(function ($n){
            return  strtoupper($n);
        }, $animeStudiosInput);

        $listCopicat = [];
        foreach ($animes as $anime) {
            $name = strtolower($anime->nameAnime);
            $maxLevenshtein = strlen($name);
            //  echo $animeNameInput,levenshtein($animeNameInput, $name,1,1,0), $name." ".$maxLevenshtein ."</br>"; // permet d'avoir les achronyme exp fate stay night = fsn
            $lavenAcronym = levenshtein($name, $animeNameInput, 1, 1, 0);
            //    $lavenMissSpelling = levenshtein($name,$animeNameInput) <= (int)(strlen($name)/5);
            //    $ifContains = str_contains($name,$animeNameInput);
            if ($lavenAcronym === 0) {
                $listCopicat [] = $anime;
            }
        }
//        var_dump($listCopicat);
//        var_dump($animeTagsInput);
//        var_dump($animeStudiosInput);
        foreach ($listCopicat as $key => $copicat) {

            $animesTags = array_map(function ($o){
                return $o->nameTags;
            },$copicat->tags());
            /**
             * S'il n'y pas de correspondance entre les tags du copicat ainsi que
             * et les entrés utilisateurs, alors on enlève l'anime de la liste des copicats
             */
            $matcheTag = array_intersect($animesTags, $animeTagsInput);
            if (empty($matcheTag)) {
                array_splice($listCopicat, $key);
            }
//            var_dump("Etape Tags ------");
//            var_dump($listCopicat);

            $animeStudio = array_map(function ($o){
                return strtoupper($o->nameStudio);
            },$copicat->studios());

            /**
             * S'il n'y pas de correspondance entre les Studios du copicat ainsi que
             * et les entrés utilisateurs, alors on enlève l'anime de la liste des copicats
             */

            if (empty($matcheTag)){
                $matcheStudio = array_intersect($animeStudio, $animeStudiosInput);
            }
            if (isset($matcheStudio)) {
                array_splice($listCopicat, $key);
            }

//            var_dump("Etape Studios ------");
//            var_dump($listCopicat);
        }
        return $listCopicat;
    }

    public static function newDemande($params)
    {
        $newType = new Type();
        var_dump(isset($params['dateAnime']));
        $newType->dateDemande = empty($params['dateAnime']) ? null : $params['dateAnime'];
        $newType->idType = ($params['dateAnime']==='.') ? null : $params['dateAnime'];
        

    }
}