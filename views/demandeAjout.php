<?php

if (isset($_SESSION['errors']['firstStepAddAnime'])) {
    $errors = $_SESSION['errors']['firstStepAddAnime'];
}
?>
<div class="contentMultiForm">

    <div class="progressBar">

        <div class="step first">
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
        <div class="step far notFirst">
            <i class="fa-solid fa-circle"></i>
        </div>

    </div>

    <div class="formMultiStep">

        <p class="info">Avant de commencer on vas vérifier ensemble si l'anime que tu veux ajouté existe déjà chez
            nous</p>
        <p class="info">Pour cela remplis ce premier formulaire le système vas rechercher pour toi si il existe un
            équivalent</p>

        <form action="/firstTryAdd" method="POST">

            <?php
            if (isset($errors['nameAnime'])) : ?>
                <p><strong class="errorOne"><?php
                        echo $errors['nameAnime'] ?></strong></p>
            <?php
            endif; ?>
            <div class="textMulti">
                <input type="text" name="nameAnime" id="nameAnime" placeholder="Nom de l'anime"
                       value="<?php
                       if (isset($_SESSION['input']['firstStepAddAnime']['nameAnime'])) :
                           echo $_SESSION['input']['firstStepAddAnime']['nameAnime'];
                       endif;
                       ?>"
                >
            </div>
            <?php
            if (isset($errors['tagAnime'])) : ?>
                <p><strong class="errorOne"><?php
                        echo $errors['tagAnime'] ?></strong></p>
            <?php
            endif; ?>
            <div class="textMulti">
                <input type="text" name="tagAnime" id="tagAnime"
                       placeholder="Tag de cette anime(si il y en a plusieurs séparer par des ',')"
                       value="<?php
                       if (isset($_SESSION['input']['firstStepAddAnime']['tagAnime'])) :
                           echo $_SESSION['input']['firstStepAddAnime']['tagAnime'];
                       endif;
                       ?>">
            </div>
            <?php
            if (isset($errors['studioAnime'])) : ?>
                <p><strong class="errorOne"><?php
                        echo $errors['studioAnime'] ?></strong></p>
            <?php
            endif; ?>
            <div class="textMulti">
                <input type="text" name="studioAnime" id="studioAnime"
                       placeholder="Studio de cette anime(si il y en a plusieurs séparer par des ',')"
                       value="<?php
                       if (isset($_SESSION['input']['firstStepAddAnime']['studioAnime'])) :
                           echo $_SESSION['input']['firstStepAddAnime']['studioAnime'];
                       endif;
                       ?>">
            </div>

            <input class="loginButton" type="submit" value="Valider">
        </form>
    </div>

</div>