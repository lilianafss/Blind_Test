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

    <!-- Font Awesome -->

    <script src="https://kit.fontawesome.com/2cafd0f29d.js" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <title>Blind Test</title>
</head>

<body>
    <div class="header-container">
        <header class="header">
            <h2 class="header__title">Blind Test</h2>
            <nav class="nav">
                <ul>
                    <li class="nav__link"><a href="./categories.html">categories</a></li>
                    <li class="nav__link"><a href="./index.html"><i class="fas fa-2x fa-home"></i></a></li>
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
           <tr>
               <td> <div class="radio__container">
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