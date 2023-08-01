<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/listStyle.css">
    <link rel="stylesheet" type="text/css" href="css/oneAnimeStyle.css">
    <link rel="stylesheet" type="text/css" href="css/formLogin.css">
    <link rel="stylesheet" type="text/css" href="css/formMulti.css">
    <script src="https://kit.fontawesome.com/355956916c.js" crossorigin="anonymous"></script>
    <title>Souche</title>
</head>

<body>
    <header>
        <h1>Souche</h1>

        <nav>
            <ul>
                <?php
                $page = $_GET["page"] ?? "";
                if ($page == "") $page = ".";


                $menu = [
                    "." => "Accueil",
                    "animes" => "Animes"
                ];
                if (isset($_SESSION['user'])){
                    $menu = array_merge($menu,[
                            "myList?id=".$_SESSION['user']->idUser => "My List",
                            "askAddAnime" =>"Demande d'Ajout"
                        ]);
                }


                foreach ($menu as $url => $label) {

                    $class = $page == preg_replace("/\?[aA-zZ]*=[0-9]*(\&[aA-zZ]*=[0-9]*)*/", "", $url) ? "active" : "";
                    echo "<li><a href=\"$url\" class=\"$class\">$label</a></li>";
                }
                ?>
            </ul>

        </nav>


        <?php 
        
        if (isset($_SESSION['user'])) : $user = $_SESSION['user']; ?>
        
            <div class="userPannel">
            <h4 class="name sign"><?php echo $user->loginUser ?></h4>
            <a href="/logout" class="logout login">Déconnexion</a>
            </div>
        <?php else : ?>
            <div class="auth">

                <a href="/sign" class="sign">Inscription</a>
                <a href="/login" class="login">Connexion</a>

            </div>

        <?php endif; ?>
    </header>

    <section>