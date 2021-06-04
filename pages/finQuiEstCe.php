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
    <link rel="stylesheet" href="../style/styleFin.css">
    <title>Document</title>
</head>

<body>
<?php if ($_SESSION["score"]<=5){?>
    <h1>Tu as fini mais ton score est insuffisant  </h1>
<?php } ?>
<?php if ($_SESSION["score"]>=6)
{?>
<h1>Felicitation tu as fini avec un score excellent</h1>
<?php } ?>


   
    <h2>ton score est de : <?php echo $_SESSION["score"] ?></h2>
    <form method="post">
        <table>
            <tr>
                <td > 
                    <input type="submit" name="Accueil" value="Accueil" class="accueil">
                    <input type="submit" name="reset" value="reset" class="reset">
                </td>
            </tr>
        </table>
    </form>

    <?php 
    if (filter_has_var(INPUT_POST, "Accueil")) {

        header("location:./categories.html");

        $_SESSION["score"] = 0;
        $_SESSION["nbQuestion"] = 1;
        session_destroy();
    }
    if (filter_has_var(INPUT_POST, "reset")) {

        header("location:./jeuQuiEstCe.php");

        $_SESSION["score"] = 0;
        $_SESSION["nbQuestion"] = 1;
        $_SESSION["imageChoisie"] = $anime[$random];

        session_destroy();

    } ?>
</body>

</html>