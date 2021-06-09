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
$question1->question = 'De quelle ville est origine Naruto ?';
$question1->img = '../images/imgAnime/question1.jpg';
$question1->reponse = 'konoha';

$question2 = new Question();
$question2->question = 'Quel âge a Eren lorsqu’il sauve Mikasa dans la première saison ?';
$question2->img = '../images/imgAnime/question2.png';
$question2->reponse = '9';

$question3 = new Question();
$question3->question = 'Dans Bleach comment s’appelle l’endroit où vivent les Shinigami ?';
$question3->img = '../images/imgAnime/question3.jpg';
$question3->reponse = 'soul society';

$question4 = new Question();
$question4->question = 'Ou luffy a-t-il passer son enfance?';
$question4->img = '../images/imgAnime/question4.png';
$question4->reponse = 'fushia';

$question5 = new Question();
$question5->question = 'Comment se nomme se personnage ?';
$question5->img = '../images/imgAnime/question5.jpg';
$question5->reponse = 'maka albarn';

$question6 = new Question();
$question6->question = 'Comment se nomme se personnage ?';
$question6->img = '../images/imgAnime/question6.jpg';
$question6->reponse = 'taiju';

$question7 = new Question();
$question7->question = 'Quelle est cette anime ?';
$question7->img = '../images/imgAnime/question7.jpg';
$question7->reponse = 'moriaty';

$question8 = new Question();
$question8->question = 'Comment se nomme se personnage ?';
$question8->img = '../images/imgAnime/question8.jpg';
$question8->reponse = 'kasumi miwa';

$question9 = new Question();
$question9->question = 'Quelle est cette anime ?';
$question9->img = '../images/imgAnime/question9.png';
$question9->reponse = 'beelzebub';

$question10 = new Question();
$question10->question = 'Dans Snk combien de personne rentrent en vie après avoir rebouche le mur Maria?';
$question10->img = '../images/imgAnime/question10.jpg';
$question10->reponse = '9';

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
            header("location: ./finJeuxVideo.php");
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
            <h1 class="title">Blind Test</h1>
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