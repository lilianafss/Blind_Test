<?php
session_start();
$random = rand(0, 9);
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
$question1->question = 'Quel est la monnaie des Sims ?';
$question1->img = '../images/imgJeuxVideo/Question1_jeux.jpg';
$question1->reponse = 'Simflouz';
$question1->solution1='Euro';
$question1->solution2='Simlich';
$question1->solution3='Simflouz';
$question1->solution4='Dollars';

$question2 = new Question();
$question2->question = 'Dans la série Call of Duty qui est-ce ?';
$question2->img = '../images/imgJeuxVideo/Question2_jeux.jpg';
$question2->reponse = 'Price';
$question2->solution1='Prixis';
$question2->solution2='Price';
$question2->solution3='Irons';
$question2->solution4='Woods';

$question3 = new Question();
$question3->question = '
La planète sur laquelle se déroule "Borderlands" est une référence à une histoire de mythologie grecque. Quel est le nom de la planète sur laquelle se déroule "Borderlands"?';
$question3->img = '../images/imgJeuxVideo/Question3_jeux.jpg';
$question3->reponse = 'Pandore';
$question3->solution1='Athena';
$question3->solution2='Pandora';
$question3->solution3='Héphaïstos';
$question3->solution4='Pandore';

$question4 = new Question();
$question4->question = 'Dans assassin s creed black flag comment s’appelle le personnage principal ?';
$question4->img = '../images/imgJeuxVideo/Question4_jeux.png';
$question4->reponse = 'Kenway';
$question4->solution1='Kenway';
$question4->solution2='Kenny';
$question4->solution3='Kesha';
$question4->solution4='Kim';

$question5 = new Question();
$question5->question = 'Comment se nomme La première zone de The Legend of Zelda : Breath of the Wild ?';
$question5->img = '../images/imgJeuxVideo/Question5_jeux.jpg';
$question5->reponse = 'Plateau';
$question5->solution1='Le debut';
$question5->solution2='Plateau du prélude';
$question5->solution3='Le plateau du départ';
$question5->solution4='Entrée';

$question6 = new Question();
$question6->question = 'De quel univers est issu Apex Legends ?';
$question6->img = '../images/imgJeuxVideo/Question6_jeux.jpg';
$question6->reponse = 'Titanfall';
$question6->solution1='CSGO';
$question6->solution2='COD';
$question6->solution3='Titanfall';
$question6->solution4='Aucun';

$question7 = new Question();
$question7->question = 'C’est qui lui ?';
$question7->img = '../images/imgJeuxVideo/Question7_jeux.png';
$question7->reponse = 'Suicune';
$question7->solution1='pikachu';
$question7->solution2='Ratata';
$question7->solution3='Raiquaza';
$question7->solution4='Suicune';

$question8 = new Question();
$question8->question = 'Comment se nomme le dragon(boss Final) de skyrim?';
$question8->img = '../images/imgJeuxVideo/Question8_jeux.jpg';
$question8->reponse = 'Alduin';
$question8->solution1='Erwin';
$question8->solution2='Alduin';
$question8->solution3='José';
$question8->solution4='Elduin';

$question9 = new Question();
$question9->question = 'De quel jeu provient cette image ?';
$question9->img = '../images/imgJeuxVideo/Question9_jeux.jpg';
$question9->reponse = 'Reign';
$question9->solution1='Reign of Kings';
$question9->solution2='Chivalry';
$question9->solution3='Rust';
$question9->solution4='Warcraft';

$question10 = new Question();
$question10->question = 'De quel jeu provient cette image ?';
$question10->img = '../images/imgJeuxVideo/Question10_jeux.jpeg';
$question10->reponse = "Dungeon";
$question10->solution1='Civilization';
$question10->solution2='Warcraft';
$question10->solution3='Diablo';
$question10->solution4="Dungeon Keeper";


//Creation du tableau avec les question
$anime = array($question1, $question2, $question3, $question4, $question5, $question6, $question7, $question8, $question9, $question10);

// $solution=$_POST['solution'];
// echo $solution;
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
//      $_SESSION["score"] = 0;
//      $_SESSION["nbQuestion"] = 1;
//      $_SESSION["imageChoisie"] = $anime[$random];



}

if (isset($_SESSION["imageChoisie"])) {
    //refresh

    if (filter_has_var(INPUT_POST, "envoyer")) {
       
        $random = $_SESSION["numeroQuestion"];
        $ListeQuestion = $_SESSION["question"];
        $imageChoisi = $_SESSION["imageChoisie"];

        if ($reponseUtilisateur == $imageChoisi->reponse)
        {
            $_SESSION["score"]++;
            
        }
        if($reponseUtilisateur!=$imageChoisi->reponse){
            $reponseUtilisateur
        }

        array_pop($ListeQuestion);
        $_SESSION["question"] = $ListeQuestion;
    
        $random = count($ListeQuestion)-1;
        $_SESSION["numeroQuestion"] = $random;
        
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
    // if(isset($_POST['solution'])){
    //     if ($reponseUtilisateur == $imageChoisi->reponse) {
    //         $_SESSION["score"]++;
    //     }
       
    // }
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
<!--<?php
   
   //if($reponseUtilisateur!=""){
        // if($reponseUtilisateur!=$imageChoisi->reponse)
        // {
        // // echo "<div class='alert alert-warning' role='alert'>
        // //         La reponse est......
        // //     </div>";
        // $message=$imageChoisi->reponse;
 
        // echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
        //     $reponseUtilisateur="";
         
        // }
        // //elseif($reponseUtilisateur=""){
        //     echo "<div class='alert alert-warning' role='alert'>
        //         bien joué
        //     </div>";
        // }
       // }
?> -->
</body>

</html>