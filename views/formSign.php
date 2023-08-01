<div class="parentForm">

    <div class="formLogin formSign">

        <form action="/trySign" method="POST">

            <?php if (isset($_SESSION['errors']['sign']['loginUser'])) : ?>
                <p><strong class="errorOne"><?php echo $_SESSION['errors']['sign']['loginUser'] ?></strong></p>
            <?php endif; ?>
            <div class="textLogin formSign">
                <label for="loginUser">Nom d'Utilisateur</label>
                <input type="text" name="loginUser" id="loginUser"
                       value="<?php
                       if (isset($_SESSION['input']['sign']['loginUser'])) :
                           echo $_SESSION['input']['sign']['loginUser'];
                       endif;
                       ?>"
                >
            </div>
            <?php if (isset($_SESSION['errors']['sign']['mailUser'])) : ?>
                <p><strong class="errorOne"><?php echo $_SESSION['errors']['sign']['mailUser'] ?></strong></p>
            <?php endif; ?>
            <?php if (isset($_SESSION['copicat']['sign'])) : ?>
                <p><strong class="errorOne"><?php echo $_SESSION['copicat']['sign'] ?></strong></p>
            <?php endif; ?>
            <div class="textLogin formSign">
                <label for="mailUser">Mail</label>
                <input type="text" name="mailUser" id="mailUser"
                       value="<?php
                       if (isset($_SESSION['input']['sign']['mailUser'])) :
                           echo $_SESSION['input']['sign']['mailUser'];
                       endif;
                       ?>"
                >
            </div>
            <?php if (isset($_SESSION['errors']['sign']['passwordUser'])) : ?>
                <p><strong class="errorOne"><?php echo $_SESSION['errors']['sign']['passwordUser'] ?></strong></p>
            <?php endif; ?>
            <div class="textLogin formSign">
                <label for="passwordUser">Mot de Passe (max 8 caractère)</label>
                <input type="password" name="passwordUser" id="passwordUser"
                >
            </div>
            <?php if (isset($_SESSION['errors']['sign']['champs'])) : ?>
                <p><strong class="errorOne"><?php echo $_SESSION['errors']['sign']['champs'] ?></strong></p>
            <?php endif; ?>
            <div class="textLogin formSign">
                <label for="passwordConfirmUser">Confirmer Mot de Passe</label>
                <input type="password" name="passwordConfirmUser" id="passwordConfirmUser"
                >
            </div>
            <input class="loginButton signButton" type="submit" value="Inscription">
        </form>

    </div>

</div>