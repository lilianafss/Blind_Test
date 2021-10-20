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
    <link rel="stylesheet" href="./style/styleJeu.css">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"    
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Font Awesome -->

    <script src="https://kit.fontawesome.com/2cafd0f29d.js" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <title>Fin</title>
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

        header("location:./jeuSerie.php");

        $_SESSION["score"] = 0;
        $_SESSION["nbQuestion"] = 1;
        $_SESSION["imageChoisie"] = $anime[$random];

        session_destroy();

    } ?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>