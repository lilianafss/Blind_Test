<?php

require_once "config.php";
session_start();
 

function conexionBase(){
static $mydb=null;
try{
    if($mydb===null){
        $connectionString='mysql:host='.DB_HOST.';dbname='.DB_NAME;
        $mydb=new PDO($connectionString,DB_USER);
        $mydb->setAttribute(PDO :: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
}
catch (PDOException $e){
        die("Error :".$e-> getMessage());
    }
    return $mydb;
}

/*unction getSerie(){
    try{
        $cnxBase = conexionBase();
        $sql = "SELECT idSerie, question.serie,img.serie,reponse.serie FROM serie";
        $requeteSQL = $cnxBase->query($sql);
        $reponseSQL = $requeteSQL->fetchAll();
    }
    catch (PDOException $e){
        print nl2br("Error");
    }
return $reponseSQL;
}
*/
function getSerie(){
    try{
        $query=conexionBase()->prepare(
            "SELECT idSerie, question.serie,img.serie,reponse.serie FROM serie");
        $query-> execute();
    }
    catch (PDOException $e)
    {
        print nl2br("Error");
    }
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getAnime(){
    try{
        $cnxBase = conexionBase();
        $sql = "SELECT idAnime, question.anime,image.anime,reponse.anime FROM anime";
        $requeteSQL = $cnxBase->query($sql);
        $reponseSQL = $requeteSQL->fetchAll();
    }
    catch (PDOException $e){
        print nl2br("Error");
    }
return $reponseSQL;
}
    

?>