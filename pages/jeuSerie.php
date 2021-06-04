<?php
session_start();
//initialisation des variables
$random = rand(0, 9);
//$nbQuestion=0;

//Creation de la classe Question
class Question
{
    public $question;
    public $img;
    public $reponse;
}
//stockage des question,images,reponse
$question1 = new Question();
$question1->question = 'DE QUELLE SÉRIE CULTE EST TIRÉ CET ÉLÉMENT SYMBOLIQUE ?';
$question1->img = '../images/imgSeries/question1_serie.png';
$question1->reponse = 'breaking bad';

$question2 = new Question();
$question2->question = 'Comment s’appelle le café dans Friends?';
$question2->img = '../images/imgSeries/question2_series.jpg';
$question2->reponse = 'central perk';

$question3 = new Question();
$question3->question = 'Comment s’appelle se personnage de the 100 ?';
$question3->img = '../images/imgSeries/question3_serie.jpg';
$question3->reponse = 'jasper';

$question4 = new Question();
$question4->question = 'dans la casa de papel qui est la voix off de l’histoire?';
$question4->img = '../images/imgSeries/question4_serie.jpg';
$question4->reponse = 'tokyo';

$question5 = new Question();
$question5->question = 'Qui est le compagnon de cellule de Charles Westmoreland ? ?';
$question5->img = '../images/imgSeries/question5_serie.jpg';
$question5->reponse = 'chat';

$question6 = new Question();
$question6->question = 'comment s’appelle t’il ?';
$question6->img = '../images/imgSeries/question6_seriejpg.jpg';
$question6->reponse = 'demogorgon';

$question7 = new Question();
$question7->question = 'Que s est-il produit entre Hannah et Bryce ?';
$question7->img = '../images/imgSeries/question7_serie.jpg';
$question7->reponse = 'viole';

$question8 = new Question();
$question8->question = 'comment se nomment tous les personnage présent sur cette image (aller de gauge à droite et mettez une virgule pour séparer les prénoms) ?';
$question8->img = '../images/imgSeries/question8_serie.jpg';
$question8->reponse = 'Robb,John,Sansa,Arya,Bran,Rickon';

$question9 = new Question();
$question9->question = 'dans pll Qui est le premier -A ?';
$question9->img = '../images/imgSeries/question9_serie.jpg';
$question9->reponse = 'mona';

$question10 = new Question();
$question10->question = 'qui est ce personnage?';
$question10->img = '../images/imgSeries/question10_serie.png';
$question10->reponse = 'aiden';

//Creation du tableau avec les question
$anime = array($question1, $question2, $question3, $question4, $question5, $question6, $question7, $question8, $question9, $question10);
//$imageChoisi=$anime[$random];
$btnEnvoyer = filter_input(INPUT_POST, "envoyer", FILTER_SANITIZE_STRING);
$reponseUtilisateur = filter_input(INPUT_POST, "reponse", FILTER_SANITIZE_STRING);

//la premiere fois qu'on arrive sur cette page 
// if (!isset($_SESSION["score"])) {
//     $_SESSION["score"] = 0;
//     $imageChoisi = $anime[$random];
// }

if (filter_has_var(INPUT_POST, "reset")) {
    $_SESSION["numeroQuestion"] = count($anime)-1;
    $_SESSION["score"] = 0;
    $_SESSION["nbQuestion"] = 1;
    $_SESSION["imageChoisie"] = $anime[$_SESSION["numeroQuestion"]];
    $_SESSION["question"] = $anime;


    session_destroy();
}


if (isset($_SESSION["imageChoisie"])) {
    //refresh

    if (filter_has_var(INPUT_POST, "envoyer")) {
        $random = $_SESSION["numeroQuestion"];
        $ListeQuestion = $_SESSION["question"];
        $imageChoisi = $_SESSION["imageChoisie"];

      
        array_pop($ListeQuestion);
        $_SESSION["question"] = $ListeQuestion;
       

        $random =count($ListeQuestion)-1;
        $_SESSION["numeroQuestion"] = $random;
        if ($reponseUtilisateur == $imageChoisi->reponse) {
            $_SESSION["score"]++;
        }

        $imageChoisi = $ListeQuestion[$random];
        $_SESSION["imageChoisie"] = $imageChoisi;
        $_SESSION["nbQuestion"]++;
        if ($_SESSION["nbQuestion"] >= 11) {
            header("location: ./finSerie.php");
            $_SESSION["nbQuestion"] = 1;
            exit;
        }
    }
} else {
    //premiere fois 

    $_SESSION["numeroQuestion"] = count($anime)-1;
    $_SESSION["score"] = 0;
    $_SESSION["nbQuestion"] = 1;
    $imageChoisi = $anime[$_SESSION["numeroQuestion"]];
    $_SESSION["imageChoisie"] = $imageChoisi;
    $_SESSION["question"] = $anime;
}




//apres  qu'on est validé notre choix

// 
//     if ($reponseUtilisateur == $imageChoisi->reponse) {
//         $_SESSION["score"]++;
//         $imageChoisi = $anime[$random];
//     }
// }


//print_r($anime[$random]);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/styleJeu.css">

    <!-- Font Awesome -->

    <script src="https://kit.fontawesome.com/2cafd0f29d.js" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <title>Blind Test</title>
</head>

<body>
    <div class="header-container">
        <header class="header">
            <h2 class="title">Blind Test</h2>
            <nav class="nav">
                <ul>
                    <li><a href="./categories.html">categories</a></li>
                    <li><a href="../index.html"><i class="fas fa-2x fa-home"></i></a></li>
                </ul>
            </nav>
        </header>
    </div>

    <form action="#" method="POST">
        <table >
            <tr>
                <td><label>Question n°: <?= $_SESSION["nbQuestion"] ?>/10 </label></td>
                <td><label>Score : <?= $_SESSION["score"] ?></label></td>
            </tr>
            <tr style="text-align: center;">
                <td class="img">
                    <?php
                    if (isset($_SESSION["imageChoisie"])) {
                        $imageChoisi = $_SESSION["imageChoisie"];

                        echo "<br>";
                        echo '<p style="font-size: 22px;">', $imageChoisi->question . '</p> <br>';

                        echo '<img style="height: 700px; width: 900px; " src="' . $imageChoisi->img . '">';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="reponse" placeholder="Reponse">
                    <input type="submit" name="envoyer" value="envoyer" class="submit">
                    <input type="submit" name="reset" value="reset" class="reset">
                </td>
            </tr>
        </table>
    </form>

</body>

</html>