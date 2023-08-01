<?php
?>

<div class="parentForm">

    <div class="formLogin formConfirm">
        <?php
        if ( isset($_SESSION['errors']['notMatch'])){
            echo " <p><strong class='errorOne'>".$_SESSION['errors']['notMatch']."</strong></p>";
        }
        ?>
        <h2>Bienvenue sur la Souche</h2>
        <h3>Veuillez saisir le code reçu par mail : </h3>
        <form action="/tryConfirm" method="POST">
            <input type="hidden" name="idTmpUser" value="<?php echo $data->idTmpUser;?>">
            <div class="textLogin formSign">
                <label for="codeTmpUser">Code :</label>
                <input type="text" name="codeTmpUser" id="codeTmpUser">
            </div>
            <input class="loginButton" type="submit" value="Confirmer">

        </form>

        <div class="reSend">
            <a id="reSend" href="reSendMail?id=<?php echo $data->idTmpUser?>">Renvoyer le mail</a>
        </div>
    </div>

</div>