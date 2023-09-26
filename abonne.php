<?php
include "header.php";
include "fonction.php";
require "DB.php";
separation();
$errornom = null;
$errorprenom = null;
$taberror = array();
if (isset($_POST['send'])) {
    $nom = strip_tags($_POST['nom']);
    $prenom = strip_tags($_POST['prenom']);
    $email = strip_tags($_POST['mail']);
    if (empty($nom)) {
        $errornom =  'Veuillez remplir le champs nom';
        $taberror[] = $errornom;
    } elseif (strlen($nom) < 2 || strlen($nom) > 15) {
        $errornom .= 'longueur du nom est invalide (entre 2 et 15)';
        $taberror[] = $errornom;
    }

    if (empty($prenom)) {
        $errorprenom =  'Veuillez remplir le champs prenom';

        $taberror[] = $errorprenom;
    } elseif (strlen($prenom) < 2 || strlen($prenom) > 15) {
        $errorprenom .= 'longueur du prenom est invalide (entre 2 et 15)';

        $taberror[] = $errorprenom;
    }
    if (empty($email)) {
        $errormail =  'Veuillez remplir le champs email';
        $taberror[] = $errormail;
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errormail .= 'champ email invalide';
        $taberror[] = $errormail;
    }
    if (empty($_POST['password'])) {
        $errorpsd =  'Veuillez remplir le champs mot de passe';
        $taberror[] = $errorpsd;
    }
}




?>
<div class="container">


    <form action="" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1" class="form-label mt-4">nom:</label>
            <input type="text" name="nom" class="form-control">
        </div>

        <?php if (!empty($errornom)) { ?>
            <p class="text-secondary"><?= $errornom ?></p>
        <?php } ?>

        <div class="form-group">
            <label for="exampleInputEmail1" class="form-label mt-4">prenom:</label>
            <input type="text" name="prenom" class="form-control">
        </div>


        <?php if (!empty($errorprenom)) { ?>
            <p class="text-secondary"><?= $errorprenom ?></p>
        <?php } ?>



        <div class="form-group">
            <label for="exampleInputEmail1" class="form-label mt-4">date de naissance:</label>
            <input type="date" class="form-control" name="birthdate">

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" class="form-label mt-4">Email:</label>
            <input type="email" class="form-control" name="mail">

        </div>

        <?php if (!empty($errormail)) { ?>
            <p class="text-secondary"><?= $errormail ?></p>
        <?php } ?>

        <div class="form-group">
            <label for="exampleInputPassword1" class="form-label mt-4">mot de passe :</label>
            <input type="password" class="form-control" name="password">
        </div>
        <?php if (!empty($errorpsd)) { ?>
            <p class="text-secondary"><?= $errorpsd ?></p>
        <?php } ?>
        <button type="submit" name="send" class="btn btn-outline-primary centrer">Inscription</button>



    </form>
</div>