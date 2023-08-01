<div class="parentForm">

    <div class="formLogin">

        <form action="/tryLogin" method="POST">

            <?php
            if (isset($_SESSION['errors']['login'])) :?>
               <p><strong class="errorOne"><?php  echo $_SESSION['errors']['login'] ?></strong></p>
            <?php endif;  ?>
        <div class="textLogin">
            <label for="loginUser">Mail de l'Utilisateur</label>
            <input type="text" name="loginUser" id="loginUser">
        </div>

        
        <div class="textLogin">
            <label for="passwordUser">Mot de Passe</label>
            <input type="password" name="passwordUser" id="passwordUser">
        </div>

        <input class="loginButton" type="submit" value="Connexion">
        </form>

    </div>

</div>