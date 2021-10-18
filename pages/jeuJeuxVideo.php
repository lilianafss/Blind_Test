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

    <!-- Font Awesome -->

    <script src="https://kit.fontawesome.com/2cafd0f29d.js" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <title>Blind Test</title>
</head>

<body class="main">
    <div class="header-container">
        <header class="header">
            <h2 class="header__title">Blind Test</h2>
            <nav class="nav">
                <ul>
 
                    <li class="nav__link"><a href="./index.html"><i class="fas fa-2x fa-home"></i></a></li>
                </ul>
            </nav>
        </header>
    </div>
    <form action="#" method="POST">
 
        <div class="nbQuestion">Question n°: <?= $_SESSION["nbQuestion"] ?>/10 </div>
        <div class="score">Score : <?= $_SESSION["score"] ?></div> 
        <div class="questionImg">
            <?php
            if (isset($_SESSION["imageChoisie"])) {
                $imageChoisi = $_SESSION["imageChoisie"];

                echo "<br>";
                echo '<p>', $imageChoisi->question . '</p> <br>';

                echo '<img  src="' . $imageChoisi->img . '">';
            }
            ?>
        </div>
        <table>
            <tr>
                <td>
                    <div class="radio__container">
                        <ul>
                            <li class="radio">
                                
                                <label class="radio__label">
                                    <input type="radio" id="solution" name="solution" value=<?php echo $imageChoisi->solution1?>>
                                    <?php echo  $imageChoisi->solution1?>
                                </label>
                            </li>
                            <li class="radio">
                                <label class="radio__label">
                                    <input type="radio" id="solution" name="solution" value=<?php echo $imageChoisi->solution2 ?>>
                                    <?php echo  $imageChoisi->solution2?>
                                </label>
                            </li>   
                            <li class="radio">
                                <label class="radio__label">
                                    <input type="radio" id="solution" name="solution" value=<?php echo $imageChoisi->solution3 ?>>
                                    <?php echo  $imageChoisi->solution3 ?>
                                </label>
                            </li>   
                            <li class="radio">
                                <label class="radio__label">
                                    <input type="radio" id="solution" name="solution" value=<?php echo $imageChoisi->solution4 ?>>
                                    <?php echo  $imageChoisi->solution4 ?>
                                </label>
                            </li>               
                        </ul>
                    </div>
                </td>
            </tr>
            <tr class="envoyer">
                <td style="text-align:center;">
                    <input type="submit" name="envoyer" value="envoyer" class="submit">
                    <input type="submit" name="categories" value="categories" class="reset">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>