<?php

//include "jeuAnime.php";

session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <p>tu a fini tu est probablement une merde</p>
    <?php echo $_SESSION["score"] ?>
    <form method="post">
        <input type="submit" name="Accueil" value="Accueil">
        <input type="submit" name="reset" value="reset">
    </form>

    <?php 
    if (filter_has_var(INPUT_POST, "Accueil")) {

        header("location:./categories.html");

        $_SESSION["score"] = 0;
        $_SESSION["nbQuestion"] = 1;
    }
    if (filter_has_var(INPUT_POST, "reset")) {

        header("location:./jeuAnime.php");

        $_SESSION["score"] = 0;
        $_SESSION["nbQuestion"] = 1;
        $_SESSION["imageChoisie"] = $anime[$random];

        session_destroy();

    } ?>
</body>

</html>