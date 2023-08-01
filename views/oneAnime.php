<div class="oneAnime">
    <?php


    $isAdd = $data['isAdd'];
    if ($isAdd) {
        $hisEtat = $data['hisEtat'];
        $notes = $data['notes'];

    } else {
        $hisEtat = false;
    }
    $tags = $data['tags'];
    $studios = $data['studios'];

    $isEnregistre = false;
    $isEnCours = false;
    $isRegarder = false;
    $isNote = false;
    $isEnPause = false;

    if ($isAdd) {
        switch ($hisEtat->idEtat) {
            case "1":
                $isEnregistre = true;
                break;
            case "2":
                $isEnCours = true;
                break;
            case "3":
                $isRegarder = true;
                break;
            case "4":
                $note = $data['note'];
                $isNote = true;
                break;
            case "6":
                $isEnPause = true;
                break;
        }
    }
    $data = $data['anime'];

    ?>
    <img class="ilust" src="img/<?php
    echo $data->pathAnime; ?>" alt="<?php
    echo $data->nameAnime; ?>">

    <div class="info">
        <div class="header">
            <h2 class="title"><?php
                if ($hisEtat) {
                    echo $data->nameAnime . " (" . $hisEtat->libelleEtat . ")";
                } else {
                    echo $data->nameAnime;
                }
                ?></h2>
            <?php if (isset($_SESSION['user']) && !$isAdd) : ?>
                <a class="button" href="\add?id=<?php
                echo $data->idAnime; ?>">
                    <button class="add"><i class="fa-solid fa-plus"></i></button>
                </a>
            <?php endif; ?>

            <?php if ($isEnregistre) : ?>
                <a class="button" href="\launch?id=<?php
                echo $data->idAnime; ?>">
                    <button class="add"><i class="fa-regular fa-floppy-disk"></i></button>
                </a>
            <?php endif; ?>

            <?php if ($isEnCours) : ?>
                <a class="button" href="\pause?id=<?php
                echo $data->idAnime; ?>">
                    <button class="add"><i class="fa-solid fa-play"></i></button>
                </a>
            <?php endif; ?>


            <?php if ($isEnPause) : ?>
                <a class="button" href="\replay?id=<?php
                echo $data->idAnime; ?>">
                    <button class="add"><i class="fa-solid fa-pause"></i></button>
                </a>
            <?php endif; ?>

            <?php if ($isRegarder) : ?>
                <a class="button" href="\replay?id=<?php
                echo $data->idAnime; ?>">
                    <button class="add"><i class="fa-solid fa-clapperboard"></i></button>
                </a>
            <?php endif; ?>

            <?php if ($isNote) : ?>
                <a class="button">
                    <button class="add"><i class="fa-solid fa-check"></i></button>
                </a>
            <?php endif; ?>
        </div>

        <?php if ($isEnCours) : ?>
            <a href="end?id=<?php echo $data->idAnime; ?>">Anime terminé</a>
        <?php endif; ?>

        <?php  if ($isAdd) : ?>
        <a href="remove?id=<?php echo $data->idAnime; ?>">Enlever l'anime de la liste</a>
        <?php endif;?>

        <h3>Date : <?php
            echo substr($data->anneeAnime, 0, 4); ?></h3>

        <h3>Tags :</h3>
        <?php
        foreach ($tags as $tag) : ?>

            <a href="\research?search=&tags=<?php
            echo $tag->idTags; ?>&studio=."><?php
                echo $tag->nameTags; ?> </a>

        <?php
        endforeach; ?>


        <h3>Studio :</h3>
        <?php
        foreach ($studios as $studio) : ?>

            <a href="\research?search=&tags=.&studio=<?php
            echo $studio->idStudio; ?>"><?php
                echo $studio->nameStudio; ?> </a>

        <?php
        endforeach; ?>


        <h3>Synopsis :</h3>
        <p><?php
            echo $data->synopsisAnime; ?></p>

        <?php if ($isRegarder) : ?>
            <h3>Note : </h3>
            <h4>Veuillez Noté cette anime pour partager votre avis au mondes entier (･ω<)☆ </h4>

            <?php if (isset($_SESSION['errors'][$data->idAnime]['note']))  : ?>
                <h4 class="errorOne"><?php  echo $_SESSION['errors'][$data->idAnime]['note'] ?></h4>
            <?php endif; ?>
            <form action="/updateNote" method="post" id="formNote">
                <input type="hidden" name="id" value="<?php echo $data->idAnime; ?>">
                <label for="note">Note :</label>
                <select name="note" id="note">
                    <option value=".">Note</option>
                    <?php foreach ($notes as $note) : ?>
                        <option value="<?php echo $note->idNote ?>"><?php echo $note->libelleNote ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="submit" value="Confirmer">
            </form>
        <?php endif; ?>

        <?php if ($isNote) : ?>
            <h3>Note : </h3>
            <p><strong><?php echo $note->libelleNote; ?></strong></p>

            <h4>Mais tu peux la modifier à tout moment ☆*:.｡.o(≧▽≦)o.｡.:*☆</h4>

            <?php if (isset($_SESSION['errors'][$data->idAnime]['note']) && !is_null($_SESSION['errors'][$data->idAnime]['note']))  : ?>
                <h4 class="errorOne"><?php  echo $_SESSION['errors'][$data->idAnime]['note'] ?></h4>
            <?php endif; ?>
            <form action="/updateNote" method="post" id="formNote">
                <input type="hidden" name="id" value="<?php echo $data->idAnime; ?>">
                <label for="note">Note :</label>
                <select name="note" id="note">
                    <option value=".">Note</option>
                    <?php foreach ($notes as $note) : ?>
                        <option value="<?php echo $note->idNote ?>"><?php echo $note->libelleNote ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="submit" value="Confirmer">
            </form>
        <?php endif; ?>
    </div>
</div>