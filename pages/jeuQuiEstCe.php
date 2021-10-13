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
$question1->question = 'Qui est ce ?';
$question1->img = '../imgages/imgQuiEstCe/Question1_qui.jpg';
$question1->reponse = 'Shakira';

$question2 = new Question();
$question2->question = 'Qui est ce ?';
$question2->img = '../images/imgQuiEstCe/Question2_qui.jpg';
$question2->reponse = 'Drake';

$question3 = new Question();
$question3->question = 'Qui est ce ?';
$question3->img = '../images/imgQuiEstCe/Question3_qui.jpg';
$question3->reponse = 'Beyonce';

$question4 = new Question();
$question4->question = 'Qui est ce ?';
$question4->img = '../images/imgQuiEstCe/Question4_qui.jpg';
$question4->reponse = 'Brad Pitt';

$question5 = new Question();
$question5->question = 'Qui est ce ?';
$question5->img = '../images/imgQuiEstCe/Question5_qui.jpg';
$question5->reponse = 'Rihanna';

$question6 = new Question();
$question6->question = 'Qui est ce ?';
$question6->img = '../images/imgQuiEstCe/Question6_qui.jpg';
$question6->reponse = 'shwarzenegger';

$question7 = new Question();
$question7->question = 'Qui est ce ?';
$question7->img = '../images/imgQuiEstCe/Question7_qui.jpg';
$question7->reponse = 'Taylor Swift';

$question8 = new Question();
$question8->question = 'Qui est ce ?';
$question8->img = '../images/imgQuiEstCe/Question8_qui.jpg';
$question8->reponse = 'Dua Lipa';

$question9 = new Question();
$question9->question = 'Qui est ce ?';
$question9->img = '../images/imgQuiEstCe/Question9_qui.jpg';
$question9->reponse = 'Florent pagny';

$question10 = new Question();
$question10->question = 'Qui est ce ?';
$question10->img = '../images/imgQuiEstCe/Question10_qui.jpg';
$question10->reponse = 'Ariana Grande';

$question11 = new Question();
$question11->question = 'Qui est ce ?';
$question11->img = '../images/imgQuiEstCe/Question11_qui.jpg';
$question11->reponse = 'chris hemsworth';

//Creation du tableau avec les question
$anime = array($question1, $question2, $question3, $question4, $question5, $question6, $question7, $question8, $question9, $question10,$question11);
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
            header("location: ./finQuiEstCe.php");
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
                    <li class="nav__link" ><a href="./categories.html">categories</a></li>
                    <li class="nav__link"><a href="../index.html"><i class="fas fa-2x fa-home"></i></a></li>
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