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
    public $solution1;
    public $solution2;
    public $solution3;
    public $solution4;
}
//stockage des question,images,reponse
$question1 = new Question();
$question1->question = 'Quel est la capitale de la Guinée ?';
$question1->img = '../images/imgCapital/Question1_capital.png';
$question1->reponse = 'Conakry';
$question1->solution1='Conakry';
$question1->solution2='Kindia';
$question1->solution3='Macenta';
$question1->solution4='Kankan';


$question2 = new Question();
$question2->question = 'Quel est la capitale du Maroc ?';
$question2->img = '../images/imgCapital/Question2_capital.jpg';
$question2->reponse = 'Rabat';
$question2->solution1='Casablanca';
$question2->solution2='Rabat';
$question2->solution3='Salé';
$question2->solution4='Marrakech';


$question3 = new Question();
$question3->question = 'Quel est la capitale de la Mongolie ?';
$question3->img = '../images/imgCapital/Question3_capital.png';
$question3->reponse = 'Oulan-Bator';
$question3->solution1='Erdenet';
$question3->solution2='Choybalsan';
$question3->solution3='Oulan-Bator';
$question3->solution4='Darkhan';

$question4 = new Question();
$question4->question = 'Quel est la capitale de l’Israël?';
$question4->img = '../images/imgCapital/Question4_capital.png';
$question4->reponse = 'Jerusalem';
$question4->solution1='Jerusalem';
$question4->solution2='Tel-Aviv';
$question4->solution3='Afoula';
$question4->solution4='Haïfa';

$question5 = new Question();
$question5->question = 'Quel est la capitale de Taiwan?';
$question5->img = '../images/imgCapital/Question5_capital.jpg';
$question5->reponse = 'Taipei';
$question5->solution1='Tainan';
$question5->solution2='Taiwan';
$question5->solution3='Taichung';
$question5->solution4='Taipei';

$question6 = new Question();
$question6->question = 'Quel est la capitale de la Turquie?';
$question6->img = '../images/imgCapital/Question6_capital.png';
$question6->reponse = 'Ankara';
$question6->solution1='Bursa';
$question6->solution2='Ankara';
$question6->solution3='Istanbul';
$question6->solution4='Adana';

$question7 = new Question();
$question7->question = 'Quel est la capitale du Portugal?';
$question7->img = '../images/imgCapital/Question7_capitale.jpg';
$question7->reponse = 'Lisbonne';
$question7->solution1='Porto';
$question7->solution2='Aveiro';
$question7->solution3='Lisbonne';
$question7->solution4='Guimarães';


$question8 = new Question();
$question8->question = 'Quel est la capitale du Brésil?';
$question8->img = '../images/imgCapital/Question8_capital.png';
$question8->reponse = 'Brasilia';
$question8->solution1='Rio de janeiro';
$question8->solution2='São Paulo';
$question8->solution3='Buenos Aires';
$question8->solution4="Brasilia";


$question9 = new Question();
$question9->question = 'Quel est la capitale de la Pologne?';
$question9->img = '../images/imgCapital/Question9_capital.png';
$question9->reponse = 'Varsovie';
$question9->solution1='Varsovie';
$question9->solution2='Bucarest';
$question9->solution3='Cracovie';
$question9->solution4="Kiev";

$question10 = new Question();
$question10->question = 'Quel est la capitale de l’Australie?';
$question10->img = '../images/imgCapital/Question10_capital.png';
$question10->reponse = 'Canberra';
$question10->solution1='Brisbane';
$question10->solution2='Melbourne';
$question10->solution3='Canberra';
$question10->solution4="Sidney";

//Creation du tableau avec les question
$anime = array($question1, $question2, $question3, $question4, $question5, $question6, $question7, $question8, $question9, $question10);
//$imageChoisi=$anime[$random];
$btnEnvoyer = filter_input(INPUT_POST, "envoyer", FILTER_SANITIZE_STRING);
$reponseUtilisateur = filter_input(INPUT_POST, "solution", FILTER_SANITIZE_STRING);

//la premiere fois qu'on arrive sur cette page 
// if (!isset($_SESSION["score"])) {
//     $_SESSION["score"] = 0;
//     $imageChoisi = $anime[$random];
// }

if (filter_has_var(INPUT_POST, "categories")) {
    header("location:categories.html");
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
            header("location: ./finCapital.php");
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
    <link rel="stylesheet" href="./style/styleJeu.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"    
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->

    <script src="https://kit.fontawesome.com/2cafd0f29d.js" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <title>Blind Test</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <h1 class="navbar-brand">Quizz</h1>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarContent" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="./categories.html">categories</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form action="#" method="POST">
        <div class="row">
            <div class="col-6 col-md-6 col-lg-6">
                <label>Question n°: <?= $_SESSION["nbQuestion"] ?>/10 </label>
            </div>
            <div class="col-6 col-md-6 col-lg-6">
                <label>Score : <?= $_SESSION["score"] ?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <?php
                    
                    if (isset($_SESSION["imageChoisie"]))
                        {
                        $imageChoisi = $_SESSION["imageChoisie"];

                        echo "<br>";
                        echo '<p style="font-size: 22px;">', $imageChoisi->question . '</p> <br>';

                        echo '<img class="w-50" src="' . $imageChoisi->img . '" >';
                    
                    }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-md-6 col-lg-6">
                <label class="radio__label">
                    <input type="radio" id="solution" name="solution" value=<?php echo $imageChoisi->solution1?>>
                    <?php echo  $imageChoisi->solution1?>
                </label>
            </div>
            <div class="col-6 col-md-6 col-lg-6">
                <label class="radio__label">
                    <input type="radio" id="solution" name="solution" value=<?php echo $imageChoisi->solution2 ?>>
                    <?php echo  $imageChoisi->solution2?>
                </label>
            </div>
            <div class="col-6 col-md-6 col-lg-6">
                <label class="radio__label">
                    <input type="radio" id="solution" name="solution" value=<?php echo $imageChoisi->solution3 ?>>
                    <?php echo  $imageChoisi->solution3 ?>
                </label>
            </div>
            <div class="col-6 col-md-6 col-lg-6">
                <label class="radio__label">
                    <input type="radio" id="solution" name="solution" value=<?php echo $imageChoisi->solution4 ?>>
                    <?php echo  $imageChoisi->solution4 ?>
                </label>
            </div>
        </div>
        <div class="row">
                <div class="col">
                    <input type="submit" name="envoyer" value="envoyer" class="submit">
                    <input type="submit" name="categories" value="categories" class="reset">
                </div>
        </div>

    </form>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>