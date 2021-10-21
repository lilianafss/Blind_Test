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
$question1->question = 'Qui est ce ?';
$question1->img = '../images/imgQuiEstCe/Question1_qui.jpg';
$question1->reponse = 'Shakira';
$question1->solution1='Shakira';
$question1->solution2='Madonna';
$question1->solution3='Megan Fox';
$question1->solution4='Katy Perry';

$question2 = new Question();
$question2->question = 'Qui est ce ?';
$question2->img = '../images/imgQuiEstCe/Question2_qui.jpg';
$question2->reponse = 'Drake';
$question2->solution1='Chris Brown';
$question2->solution2='Kenny West';
$question2->solution3='Drake';
$question2->solution4='French Montana';

$question3 = new Question();
$question3->question = 'Qui est ce ?';
$question3->img = '../images/imgQuiEstCe/Question3_qui.jpg';
$question3->reponse = 'Beyonce';
$question3->solution1='Mariah Carey';
$question3->solution2='Whitney Houston';
$question3->solution3='Jennifer Lopez';
$question3->solution4='Beyonce';

$question4 = new Question();
$question4->question = 'Qui est ce ?';
$question4->img = '../images/imgQuiEstCe/Question4_qui.jpg';
$question4->reponse = 'Brad';
$question4->solution1='Tom Cruise';
$question4->solution2='Brad Pitt';
$question4->solution3='Ian Somerhalder';
$question4->solution4='Johnny Depp';

$question5 = new Question();
$question5->question = 'Qui est ce ?';
$question5->img = '../images/imgQuiEstCe/Question5_qui.jpg';
$question5->reponse = 'Rihanna';
$question5->solution1='Rihanna';
$question5->solution2='Rita Ora';
$question5->solution3='Iggy Azalea';
$question5->solution4='Alicia Keys';

$question6 = new Question();
$question6->question = 'Qui est ce ?';
$question6->img = '../images/imgQuiEstCe/Question6_qui.jpg';
$question6->reponse = 'Shwarzenegger';
$question6->solution1='Jean-Claude Van Damme';
$question6->solution2='Stallone';
$question6->solution3='Shwarzenegger';
$question6->solution4='Dolph Lundgren';

$question7 = new Question();
$question7->question = 'Qui est ce ?';
$question7->img = '../images/imgQuiEstCe/Question7_qui.jpg';
$question7->reponse = 'Taylor';
$question7->solution1='Adele';
$question7->solution2='Camila Cabello';
$question7->solution3='Lana Del  Rey';
$question7->solution4='Taylor Swift';

$question8 = new Question();
$question8->question = 'Qui est ce ?';
$question8->img = '../images/imgQuiEstCe/Question8_qui.jpg';
$question8->reponse = 'Dua';
$question8->solution1='Dua Lipa';
$question8->solution2='Doja Cat';
$question8->solution3='Olivia Rodrigo';
$question8->solution4='Zara Larsson';


$question9 = new Question();
$question9->question = 'Qui est ce ?';
$question9->img = '../images/imgQuiEstCe/Question10_qui.jpg';
$question9->reponse = 'Ariana';
$question9->solution1='Taylor Swift';
$question9->solution2='Ariana Grande';
$question9->solution3='Charlie d amelio';
$question9->solution4='Selena Gomez';

$question10 = new Question();
$question10->question = 'Qui est ce ?';
$question10->img = '../images/imgQuiEstCe/Question11_qui.jpg';
$question10->reponse = 'Chris';
$question10->solution1='Brad Pitt';
$question10->solution2='Lucas Till';
$question10->solution3='Tom Cruise';
$question10->solution4='Chris Hemsworth';

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