<?php

class RechercheService
{


    static public function doResearch($params)
    {
        $critere = 0;
        if (!empty($params['search'])) {
            $resultByMot = self::doResearchAnimeName($params['search']);
            $critere++;
        }
        if ($params['tags'] !== '.') {
            $resultByTag = self::doResearchAnimeTags($params['tags']);
            $critere++;
        }
        if ($params['studio'] !== '.') {
            $critere++;
            $resultByStudio = self::doResearchAnimeStudio($params['studio']);
        }
        if ($critere == 1) {
            if (empty($resultByMot) && empty($resultByStudio)) {
                return  $resultByTag;
            } elseif (empty($resultByMot) && empty($resultByTag)) {
                return $resultByStudio;
            } else if (empty($resultByStudio) && empty($resultByTag)) {
                return $resultByMot;
            }
        } else if ($critere == 2) {
            if(empty($resultByMot)){
                $resultByStudio = ArrayUtils::makeIdArray($resultByStudio,'idAnime');
                $resultByTag = ArrayUtils::makeIdArray($resultByTag,'idAnime');
                $result = ArrayUtils::interArray(
                    $resultByStudio,$resultByTag
                    );
               
                $restTag = ArrayUtils::diffArray($result,$resultByTag);
                $restStudio = ArrayUtils::diffArray($result,$resultByStudio);
                
                if(empty($restStudio) && empty($restTag)){
                    return $result;
                }elseif(empty($restStudio)){
                    return array_merge($result,$restTag);
                }elseif(empty($restTag)){
                    return array_merge($result,$restStudio);
                }
            }
        }
    }


    static private function doResearchAnimeStudio($animeStudio)
    {
        $allAnime = Anime::all();
        $listResultAnime = [];
        foreach ($allAnime as $anime) {
            $anime = Anime::one($anime->idAnime);
            foreach ($anime->studios() as $studio) {
                if ($studio->idStudio === $animeStudio) {
                    $listResultAnime[] = $anime;
                }
            }
        }

        return empty($listResultAnime) ? false : $listResultAnime;
    }

    static private function doResearchAnimeName($animeName)
    {
        $allAnime = Anime::all();
        $listResultAnime = [];
        foreach ($allAnime as $anime) {
            if (str_contains(strtolower($anime->nameAnime), strtolower($animeName) )) {
                $listResultAnime[] = $anime;
            }
        }
        return empty($listResultAnime) ? false : $listResultAnime;
    }

    static private function doResearchAnimeTags($animeTags)
    {
        $allAnime = Anime::all();
        $listResultAnime = [];
        foreach ($allAnime as $anime) {
            $anime = Anime::one($anime->idAnime);
            foreach ($anime->tags() as $tag) {
                if ($tag->idTags === $animeTags) {
                    $listResultAnime[] = $anime;
                }
            }
        }

        return empty($listResultAnime) ? false : $listResultAnime;
    }
}
