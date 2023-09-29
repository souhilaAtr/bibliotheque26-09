<?php
$pdo = new PDO("mysql:host=localhost; dbname=bibliotheque;charset=utf8", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
$erreur = null;
try {
    // requetes livre 
    $pdostatment = $pdo->query("select * from livre ");
    $livres = $pdostatment->fetchAll();

    $queryinsert = $pdo->prepare("INSERT INTO livre(auteur,titre)values(:auteur,:titre)");

    $queryselection = $pdo->prepare("SELECT * from livre where id_livre = :id");


    $querymodification = $pdo->prepare("UPDATE livre set titre=:titre, auteur = :auteur where id_livre = :id");

    $querysuppression = $pdo->prepare("DELETE from livre where id_livre = :id");


    //requete abonne


    // $pdostatmenta = $pdo->query("select * from abonne ");
    // $labonnes = $pdostatmenta->fetchAll();

    $statementinsertabo = $pdo->prepare("INSERT INTO abonne(nom,prenom,birthDate,mail,password,photo)values(
        :nom,:prenom,:birthdate,:mail,:pass,:image)");

        //abonne par mail 
     $statmentbyid = $pdo->prepare("select * from abonne where id_abonne = :id");   

        $statabomail = $pdo->prepare("SELECT * from abonne where mail = :mail");


$statementrecherche = $pdo->prepare("SELECT * from livre where id_livre IN(select id_livre from emprunt where id_abonne = :id)");


    } catch (PDOException $excption) {
    $erreur = $excption->getMessage();
}
