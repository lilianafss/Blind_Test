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
$question1->question = 'DE QUELLE SÉRIE CULTE EST TIRÉ CET ÉLÉMENT SYMBOLIQUE ?';
$question1->img = '../images/imgSeries/question1_serie.png';
$question1->reponse = 'Breaking';
$question1->solution1='Malcolm';
$question1->solution2='Shameless';
$question1->solution3='Prison Break';
$question1->solution4='Breaking Bad';

$question2 = new Question();
$question2->question = 'Comment s’appelle le café dans Friends?';
$question2->img = '../images/imgSeries/question2_series.jpg';
$question2->reponse = 'Central';
$question2->solution1='Central park';
$question2->solution2='Central perk';
$question2->solution3='The Cafe';
$question2->solution4='Inconnu';

$question3 = new Question();
$question3->question = 'Comment s’appelle se personnage de the 100 ?';
$question3->img = '../images/imgSeries/question3_serie.jpg';
$question3->reponse = 'Jasper';
$question3->solution1='Jasper';
$question3->solution2='Clark';
$question3->solution3='Finn';
$question3->solution4='Belamy';

$question4 = new Question();
$question4->question = 'dans la casa de papel qui est la voix off de l’histoire?';
$question4->img = '../images/imgSeries/question4_serie.jpg';
$question4->reponse = 'Tokyo';
$question4->solution1='Le professeur';
$question4->solution2='Denver';
$question4->solution3='Tokyo';
$question4->solution4='Rio';

$question5 = new Question();
$question5->question = 'Qui est le compagnon de cellule de Charles Westmoreland ? ?';
$question5->img = '../images/imgSeries/question5_serie.jpg';
$question5->reponse = 'Chat';
$question5->solution1='Chien';
$question5->solution2='Rat';
$question5->solution3='Scorpion';
$question5->solution4='Chat';

$question6 = new Question();
$question6->question = 'Comment s’appelle t’il ?';
$question6->img = '../images/imgSeries/question6_seriejpg.jpg';
$question6->reponse = 'Demogorgon';
$question6->solution1='Pierre';
$question6->solution2='Demogorgon';
$question6->solution3='Demon';
$question6->solution4='Le monstre';


$question7 = new Question();
$question7->question = 'Que s est-il produit entre Hannah et Bryce ?';
$question7->img = '../images/imgSeries/question7_serie.jpg';
$question7->reponse = 'Viole';
$question7->solution1='Viole';
$question7->solution2='Meurtre';
$question7->solution3='Kidnapping';
$question7->solution4='Rien';

$question8 = new Question();
$question8->question = 'Comment se nomment tous les personnage présent sur cette image ?';
$question8->img = '../images/imgSeries/question8_serie.jpg';
$question8->reponse = 'Robb,John,Sansa,Arya,Bran,Rickon';
$question8->solution1='Robert,John,Sansa,Arya,Brandon,Rickon';
$question8->solution2='Robb,John,Sansa,Arya,Rickon,Bran';
$question8->solution3='Robb,John,Sansa,Arya,Bran,Rickon';
$question8->solution4="Y ont pas de prenom";

$question9 = new Question();
$question9->question = 'Dans pll qui est le premier -A ?';
$question9->img = '../images/imgSeries/question9_serie.jpg';
$question9->reponse = 'Mona';
$question9->solution1='Alison';
$question9->solution2='Spencer';
$question9->solution3='On ne sait pas';
$question9->solution4="Mona";

$question10 = new Question();
$question10->question = 'Qui est ce personnage?';
$question10->img = '../images/imgSeries/question10_serie.png';
$question10->reponse = 'Aiden';
$question10->solution1='Aiden';
$question10->solution2='Scott';
$question10->solution3='Derek';
$question10->solution4="Ethan";

//Creation du tableau avec les question
$anime = array($question1, $question2, $question3, $question4, $question5, $question6, $question7, $question8, $question9, $question10);

$btnEnvoyer = filter_input(INPUT_POST, "envoyer", FILTER_SANITIZE_STRING);
$reponseUtilisateur = filter_input(INPUT_POST, "solution", FILTER_SANITIZE_STRING);


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
        $ListeQuestion =$_SESSION["question"];;
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
            $_SESSION["nbQuestion"] = 1;
            header("location: ./finSerie.php");
          
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
    <div class="container-fuild">
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
    </div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>