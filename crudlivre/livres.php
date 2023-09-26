<?php
include "../header.php";
include "../fonction.php";
require "../DB.php";

separation();

if(!empty($_GET['id_livre'])){
    $querysuppression->execute([
        "id" => $_GET['id_livre']
    ]);
    header("location: livres.php");
}
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