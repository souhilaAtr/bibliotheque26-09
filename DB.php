<?php 
$pdo = new PDO("mysql:host=localhost; dbname=bibliotheque;charset=utf8","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
$erreur = null;
try {
    $pdostatment = $pdo->query("select * from livre ");
    $livres = $pdostatment->fetchAll();

    $queryinsert = $pdo->prepare("INSERT INTO livre(auteur,titre)values(:auteur,:titre)");
   
    $queryselection = $pdo->prepare("SELECT * from livre where id_livre = :id");


    $querymodification = $pdo-> prepare("UPDATE livre set titre=:titre, auteur = :auteur where id_livre = :id");

    $querysuppression = $pdo->prepare("DELETE from livre where id_livre = :id");

} catch (PDOException $excption) {
    $erreur = $excption->getMessage();
}