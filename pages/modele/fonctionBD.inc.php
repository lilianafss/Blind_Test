<?php

require_once "config.php";
session_start();
// fonction qui va permettre la connexion à la base 

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
    function getSerie(){
        try{
            $cnxBase = conexionBase();
            $sql = "SELECT idSerie, question.serie,image.serie,reponse.serie FROM serie";
            $requeteSQL = $cnxBase->query($sql);
            $reponseSQL = $requeteSQL->fetchAll();
        }
        catch (PDOException $e){
            print nl2br("Error");
        }
    return $reponseSQL;
    }
?>