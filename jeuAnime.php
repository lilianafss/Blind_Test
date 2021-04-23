<?php
session_start();
//initialisation des variables
$random = rand(0, 9);
$imageChoisi=null;




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
$question1->img = './imgAnime/Konohavillage.jpg';
$question1->reponse = 'konoha';

$question2 = new Question();
$question2->question = 'Quel âge a Eren lorsqu’il sauve Mikasa dans la première saison ?';
$question2->img = './imgAnime/Eren_Jäger.png';
$question2->reponse = '9';

$question3 = new Question();
$question3->question = 'Dans Bleach comment s’appelle l’endroit où vivent les Shinigami ?';
$question3->img = './imgAnime/Soul_society.jpg';
$question3->reponse = 'soul society';

$question4 = new Question();
$question4->question = 'Ou luffy a-t-il passer son enfance?';
$question4->img = './imgAnime/Village_de_Fushsia_Anime_Infobox.png';
$question4->reponse = 'fushia';

$question5 = new Question();
$question5->question = 'Comment se nomme se personnage ?';
$question5->img = './imgAnime/Maka-Albarn.jpg';
$question5->reponse = 'maka albarn';

$question6 = new Question();
$question6->question = 'Comment se nomme se personnage ?';
$question6->img = './imgAnime/taiju.jpg';
$question6->reponse = 'taiju';

$question7 = new Question();
$question7->question = 'Quelle est cette anime ?';
$question7->img = './imgAnime/moriarty-the-patriot.jpg';
$question7->reponse = 'moriaty';

$question8 = new Question();
$question8->question = 'Comment se nomme se personnage ?';
$question8->img = './imgAnime/kasumi_miwa.jpg';
$question8->reponse = 'kasumi miwa';

$question9 = new Question();
$question9->question = 'Quelle est cette anime ?';
$question9->img = './imgAnime/beelzebub.png';
$question9->reponse = 'beelzebub';

$question10 = new Question();
$question10->question = 'Dans Snk combien de personne rentrent en vie après avoir rebouche le mur Maria?';
$question10->img = './imgAnime/VsRM1dP.jpg';
$question10->reponse = '9';

//Creation du tableau avec les question
$anime = array($question1, $question2, $question3, $question4, $question5, $question6, $question7, $question8, $question9, $question10);

$btnEnvoyer = filter_input(INPUT_POST, "envoyer", FILTER_SANITIZE_STRING);
$reponseUtilisateur = filter_input(INPUT_POST, "reponse", FILTER_SANITIZE_STRING);
//la premiere fois qu'on arrive sur cette page 
// if (!isset($_SESSION["score"])) {
//     $_SESSION["score"] = 0;
//     $imageChoisi = $anime[$random];
// }

$RequestSignature = md5($_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'].print_r($_POST, true));

if ($_SESSION['LastRequest'] == $RequestSignature)
{
    $_SESSION["score"] = 0;
    $imageChoisi = $anime[$random];
}   
else
{
    $_SESSION["score"]++;
    $imageChoisi = $anime[$random];
  $_SESSION['LastRequest'] = $RequestSignature;
}

//apres  qu'on est validé notre choix

// if (filter_has_var(INPUT_POST, "envoyer")) {
//     if ($reponseUtilisateur == $imageChoisi->reponse) {
//         $_SESSION["score"]++;
//         $imageChoisi = $anime[$random];
//     }
// }
if (filter_has_var(INPUT_POST, "reset")) {
    $_SESSION["score"] = 0;
}

//print_r($anime[$random]);


for ($nbQuestion = 0; $nbQuestion <= 10; $nbQuestion++) {

    if (filter_has_var(INPUT_POST, "envoyer")) {
        $nbQuestion++;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


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
                    <li><a href="./index.html"><i class="fas fa-2x fa-home"></i></a></li>
                </ul>
            </nav>
        </header>
    </div>

    <form action="#" method="POST">
        <table>
            <tr>
                <td><label>Question n°: <?= $nbQuestion ?>/10 </label></td>
                <td><label>Score : <?= $_SESSION["score"] ?></label></td>
            </tr>
            <tr class="img">
                <?php
                echo $reponseUtilisateur;
                echo "<br>";
                echo $imageChoisi->reponse;
                echo "<br>";
                echo $imageChoisi->question . '<br>';
                echo '<img src="' . $imageChoisi->img . '" >'
                ?>
            </tr>
            <tr>
                <td><input type="text" name="reponse"></td>
                <td><input type="submit" name="envoyer" value="envoyer"></td>
                <td><input type="submit" name="reset" value="reset"></td>
            </tr>
        </table>
    </form>
</body>

</html>