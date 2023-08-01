<?php
var_dump($data);
?>

<div class="contentMultiForm">

    <div class="progressBar">

        <div class="step done first">
            <i class="fa-solid fa-circle"></i>
        </div>
        <div class="step enCours notFirst">
            <i class="fa-regular fa-circle-dot"></i>
        </div>
        <div class="step next notFirst">
            <i class="fa-solid fa-circle"></i>
        </div>
        <div class="step far notFirst">
            <i class="fa-solid fa-circle"></i>
        </div>
        <div class="step far notFirst">
            <i class="fa-solid fa-circle"></i>
        </div>

    </div>


    <div class="formMultiStep">

        <p>Un ou plusieurs anime(s) sont similaires à celui que tu as renseigné ....</p>
        <p>Je te conseille donc de regarder ces animes tu trouveras peux être ton bonheur</p>

        <table class="tableCopicat">
            <tr>
                <th>Nom</th>
                <th>Nb d'épisode</th>
                <th>N° de la saison</th>
            </tr>
        <?php foreach ($data as $anime) :?>
            <tr class="rowCopicat">

               <td><a href="anime?id=<?php echo $anime->idAnime ?>"> <?php echo $anime->nameAnime; ?></a></td>
               <td><a href="anime?id=<?php echo $anime->idAnime ?>"><?php echo $anime->episodeAnime; ?></a></td>
               <td><a href="anime?id=<?php echo $anime->idAnime ?>"><?php echo $anime->saisonAnime; ?></a></td>

            </tr>
        <?php endforeach; ?>
        </table>

        <p>Cependant si tu es confiant dans tes convictions tu peux quand même mener à termes ta demande d'ajout <br>
            <a href="/complementForm" class="continue">Continuer</a>
        </p>

    </div>

</div>




