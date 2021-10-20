<?php

//include "jeuAnime.php";

session_start();


?>
<!DOCTYPE html>
<!--
    Auteurs : Ania Marostica, Liliana Santos
    Projet : BlindTest/ Quiz
    Version: 1.0
-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/styleFin.css">
    <title>Document</title>
</head>

<body>
    <div class="conatiner-fuild">
        <div class="row">
            <div class="col">
                <header class="header">
                    <nav class="navbar navbar-expand">
                        <ul class="navbar-nav">
                            <li class="nav__link"><a href="./categories.html">categories</a></li>
                            <li class="nav__link"><a href="./index.html"><i class="fas fa-2x fa-home"></i></a></li>
                        </ul>
                    </nav>
                </header>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <?php if ($_SESSION["score"]<=5){?>
                    <h1>Tu as fini mais ton score est insuffisant  </h1>
                <?php } ?>
                <?php if ($_SESSION["score"]>=6)
                {?>
                    <h1>Felicitation tu as fini avec un score excellent</h1>
                <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <!--Affichage du score-->
   
                <h2>ton score est de : <?php echo $_SESSION["score"] ?></h2>
            </div>
        </div>
    
        <form method="post">
            <div class="row">
                <div class="col">
                        <input type="submit" name="Accueil" value="Categories" class="accueil">
                        <input type="submit" name="reset" value="Reset" class="reset">
                </div>
            </div>
        </form>
    </div>

    <?php 
    if (filter_has_var(INPUT_POST, "Accueil")) {

        header("location:./categories.html");

        $_SESSION["score"] = 0;
        $_SESSION["nbQuestion"] = 1;
        session_destroy();
    }
    if (filter_has_var(INPUT_POST, "reset")) {

        header("location:./jeuJeuxVideo.php");

        $_SESSION["score"] = 0;
        $_SESSION["nbQuestion"] = 1;
        $_SESSION["imageChoisie"] = $anime[$random];

        session_destroy();

    } ?>
</body>

</html>