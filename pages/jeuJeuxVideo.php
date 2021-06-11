<?php
session_start();

//Creation de la classe Question
class Question
{
    public $question;
    public $img;
    public $reponse;
}
//stockage des question,images,reponse
$question1 = new Question();
$question1->question = 'Quel est la monnaie des Sims ?';
$question1->img = '../images/imgJeuxVideo/Question1_jeux.jpg';
$question1->reponse = 'Simflouz';

$question2 = new Question();
$question2->question = 'Dans la série Call of Duty qui est-ce ?';
$question2->img = '../images/imgJeuxVideo/Question2_jeux.jpg';
$question2->reponse = 'John Price';

$question3 = new Question();
$question3->question = '
La planète sur laquelle se déroule "Borderlands" est une référence à une histoire de mythologie grecque. Quel est le nom de la planète sur laquelle se déroule "Borderlands"?';
$question3->img = '../images/imgJeuxVideo/Question3_jeux.jpg';
$question3->reponse = 'Pandore';

$question4 = new Question();
$question4->question = 'Dans assassin s creed black flag comment s’appelle le personnage principal ?';
$question4->img = '../images/imgJeuxVideo/Question4_jeux.png';
$question4->reponse = 'Edward kenway';

$question5 = new Question();
$question5->question = 'Comment se nomme La première zone de The Legend of Zelda : Breath of the Wild ?';
$question5->img = '../images/imgJeuxVideo/Question5_jeux.jpg';
$question5->reponse = 'Plateau du prélude';

$question6 = new Question();
$question6->question = 'De quel univers est issu Apex Legends ?';
$question6->img = '../images/imgJeuxVideo/Question6_jeux.jpg';
$question6->reponse = 'Titanfall';

$question7 = new Question();
$question7->question = 'C’est qui lui ?';
$question7->img = '../images/imgJeuxVideo/Question7_jeux.png';
$question7->reponse = 'Suicune';

$question8 = new Question();
$question8->question = 'Comment se nomme le dragon(boss Final) de skyrim?';
$question8->img = '../images/imgJeuxVideo/Question8_jeux.jpg';
$question8->reponse = 'Alduin';

$question9 = new Question();
$question9->question = 'De quel jeu provient cette image ?';
$question9->img = '../images/imgJeuxVideo/Question9_jeux.jpg';
$question9->reponse = 'Reign of Kings';

$question10 = new Question();
$question10->question = 'De quel jeu provient cette image ?';
$question10->img = '../images/imgJeuxVideo/Question10_jeux.jpeg';
$question10->reponse = 'Dungeon Keeper';

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
            header("location: ./finJeuxvideo.php");
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
        <table>
            <tr class="infoJeu">
                <td><label>Question n°: <?= $_SESSION["nbQuestion"] ?>/10 </label></td>
                <td><label>Score : <?= $_SESSION["score"] ?></label></td>
            </tr>
            <tr style="text-align: center;">
                <td class="img" style="text-align:center;">
                    <?php
                    if (isset($_SESSION["imageChoisie"])) {
                        $imageChoisi = $_SESSION["imageChoisie"];

                        echo "<br>";
                        echo '<p style="font-size: 40px; color: white;">', $imageChoisi->question . '</p> <br>';

                        echo '<img style="height: 400px; width: 500px; " src="' . $imageChoisi->img . '">';
                    }
                    ?>
                </td>
            </tr>
            <tr class="envoyer">
                <td style="text-align:center;">
                    <input type="text" name="reponse" placeholder="Reponse">
                    <input type="submit" name="envoyer" value="envoyer" class="submit">
                    <input type="submit" name="reset" value="reset" class="reset">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>