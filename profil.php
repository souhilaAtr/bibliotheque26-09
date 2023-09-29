<?php
include "header.php";
include "fonction.php";
require "DB.php";


$statmentbyid->execute([
    "id" => $_SESSION["id"]
]);
$abonne = $statmentbyid->fetch();
?>

<div class="container">
    <div class="card">
        <img <?php if (!empty($abonne['photo'])) {
                ?> src="telechargement/<?= $abonne['photo'] ?>" <?php } else { ?> src="img/bg.jpg" <?php  } ?> alt="Avatar" style="width:100%">
        <div class="container">
            <h4><b><?php echo $abonne['nom'] . " " . $abonne['prenom'] ?></b></h4>
            <p><?php echo $abonne['birthDate'] ?></b></p>
            <p><?php echo $abonne['mail'] ?></p>
        </div>
    </div>
</div>


<?php

$statementrecherche->execute([
    "id" => $_SESSION['id']
]);
$livres = $statementrecherche->fetchAll();
// var_dump($livres);
?>


<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">auteur</th>
                <th scope="col">titre</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livres as $livre) {  ?>


                <tr class="table-secondary">
                    <td><?= $livre['auteur'] ?></td>
                    <td><?= $livre['titre'] ?></td>
                    <td><a href="insertion.php?id_livre=<?= $livre['id_livre'] ?>">modification</a></td>
                    <td><a href="livres.php?id_livre=<?= $livre['id_livre'] ?>">suppression</a></td>




                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>