<?php
var_dump($data);
var_dump($_SESSION);
?>

<div class="contentMultiForm">

    <div class="progressBar">

        <div class="step done first">
            <i class="fa-solid fa-circle"></i>
        </div>
        <div class="step enCours notFirst">
            <i class="fa-solid fa-circle"></i>
        </div>
        <div class="step enCours notFirst">
            <i class="fa-regular fa-circle-dot"></i>
        </div>
        <div class="step far notFirst">
            <i class="fa-solid fa-circle"></i>
        </div>
        <div class="step far notFirst">
            <i class="fa-solid fa-circle"></i>
        </div>

    </div>


    <div class="formMultiStep">

        <p>Voici le dernier Formulaire tiens bon tu y es presque ( ~*-*)~</p>
        <p>Aucune de ces informations sont obligatoire</p>
        <p>Mais plus se seras remplis vite plus se sera traiter par nos charmant Modérateur (^_<)〜☆</p>
        <form action="tryFinalForm" method="post">

            <div class="">
                <label for="nameAnime">Nom de l'anime</label>
                <input type="text" value="Nom" disabled name="nameAnime" id="nameAnime">
            </div>

            <div class="">
                <label for="dateAnime">Date de sortie (AAAA-MM-JJ)</label>
                <input type="date" name="dateAnime" id="dateAnime">
            </div>

            <div>
                <label for="typeAnime">Type de l'anime(OAV/Film)</label>
                <select name="typeAnime" id="typeAnime">
                    <option value=".">Type d'anime</option>
                    <?php foreach ($data['type'] as $datum) :?>
                        <option value="<?php echo  $datum->idType; ?>">
                            <?php echo  $datum->libelleType; ?>
                        </option>

                    <?php endforeach; ?>
                </select>
            </div>

            <div class="">
                <label for="episodeAnime">Nombre d'épisode</label>
                <input type="text" name="episodeAnime" id="episodeAnime">
            </div>

            <div class="">
                <label for="saisonAnime">N° de la saison</label>
                <input type="text" name="saisonAnime" id="saisonAnime">
            </div>

            <div class="">
                <label for="pathAnime">Path de l'affiche</label>
                <input type="text" name="pathAnime" id="pathAnime">
            </div>

            <div class="">
                <label for="studioAnime">Tag de l'anime</label>
                <input type="text" value="Tags" disabled name="studioAnime" id="studioAnime">
            </div>

            <div class="">
                <label for="tagsAnime">Studio de l'anime</label>
                <input type="text" value="Studio" disabled name="tagsAnime" id="tagsAnime">
            </div>

            <div class="">
                <label for="synopsisAnime">Studio de l'anime</label>
                <textarea name="synopsisAnime" id="synopsisAnime" cols="30" rows="10"></textarea>
            </div>

            <input class="loginButton" type="submit" value="Valider">
        </form>

    </div>

</div>