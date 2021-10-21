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
$question1->question = 'De quelle ville est origine Naruto ?';
$question1->img = '../images/imgAnime/question1.jpg';
$question1->reponse = 'Konoha';
$question1->solution1='Suna';
$question1->solution2='Konoha';
$question1->solution3='Kumo';
$question1->solution4='Kiri';


$question2 = new Question();
$question2->question = 'Quel âge a Eren lorsqu’il sauve Mikasa dans la première saison ?';
$question2->img = '../images/imgAnime/question2.png';
$question2->reponse = '9';
$question2->solution1='10';
$question2->solution2='12';
$question2->solution3='7';
$question2->solution4='9';


$question3 = new Question();
$question3->question = 'Dans Bleach comment s’appelle l’endroit où vivent les Shinigami ?';
$question3->img = '../images/imgAnime/question3.jpg';
$question3->reponse = 'Soul';
$question3->solution1='Karakura';
$question3->solution2='Shinigamien';
$question3->solution3='Urahara';
$question3->solution4='Soul society';


$question4 = new Question();
$question4->question = 'Ou luffy a-t-il passer son enfance?';
$question4->img = '../images/imgAnime/question4.png';
$question4->reponse = 'Fushia';
$question4->solution1='RedLine';
$question4->solution2='Pays de Wano';
$question4->solution3='Fushia';
$question4->solution4='East Blue ';


$question5 = new Question();
$question5->question = 'Comment se nomme se personnage ?';
$question5->img = '../images/imgAnime/question5.jpg';
$question5->reponse = 'Maka';
$question5->solution1='Spirit Albarn';
$question5->solution2='Black Star';
$question5->solution3='Maka Albarn';
$question5->solution4='Crona';


$question6 = new Question();
$question6->question = 'Comment se nomme se personnage ?';
$question6->img = '../images/imgAnime/question6.jpg';
$question6->reponse = 'Taiju';
$question6->solution1='Taiju';
$question6->solution2='Senku';
$question6->solution3='Hyoga';
$question6->solution4='Teiju';


$question7 = new Question();
$question7->question = 'Quelle est cette anime ?';
$question7->img = '../images/imgAnime/question7.jpg';
$question7->reponse = 'Moriaty';
$question7->solution1='Black Butler';
$question7->solution2='Castelvania';
$question7->solution3='Dragon ball';
$question7->solution4='Moriaty';


$question8 = new Question();
$question8->question = 'Comment se nomme se personnage ?';
$question8->img = '../images/imgAnime/question8.jpg';
$question8->reponse = 'Kasumi ';
$question8->solution1='Maki Zenin';
$question8->solution2='Nobara Kugisaki';
$question8->solution3='Kasumi miwa';
$question8->solution4='Maka albarn';


$question9 = new Question();
$question9->question = 'Quelle est cette anime ?';
$question9->img = '../images/imgAnime/question9.png';
$question9->reponse = 'Beelzebub';
$question9->solution1='Beelzebub';
$question9->solution2='Detective conan';
$question9->solution3='Soul Eater'; 
$question9->solution4='Chainaw man';


$question10 = new Question();
$question10->question = 'Dans Snk combien de personne rentrent en vie après avoir rebouche le mur Maria?';
$question10->img = '../images/imgAnime/question10.jpg';
$question10->reponse = '9';
$question10->solution1 ='41';
$question10->solution2 ='102';
$question10->solution3 ='9';
$question10->solution4 ='12';


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