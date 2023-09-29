<?php
include "header.php";
include "fonction.php";
require "DB.php";



if (!empty($_GET)) {
    if ($_GET['action']) {
        session_unset();
        header("location:index.php");
    }
}
separation();
$errornom = null;
$errorprenom = null;
$taberror = array();
$errormail = null;
$errorfile = null;
$errorpsd = null;
$file = null;
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
    } else {
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    // var_dump($_FILES);
    if (!empty($_FILES) && (empty($_FILES['file']["error"]))) {

        $file = $_FILES['file'];
        $filename = $file['name'];
        $filetmp = $file['tmp_name'];
        $filesize = $file['size'];
        $fileerror = $file['error'];
        $fichierinsertion = "telechargement";
        $extensionallowd = ['png', 'jpg'];
        $fileext = explode('.', $filename);
        $fileext = strtolower(end($fileext));
        if (in_array($fileext, $extensionallowd)) {

            if (empty($fileerror)) {
                if ($filesize < 5000000) {
                    if (!file_exists($fichierinsertion)) {
                        mkdir($fichierinsertion);
                    }
                    $newfilename = uniqid("photoProfil") . "." . $fileext;
                    $fichierdest = $fichierinsertion . "/" . $newfilename;
                    move_uploaded_file($filetmp, $fichierdest);
                } else {
                    $errorfile .= " la taille de la photo dépasse les 500Mb, Veuillez choisir une autre";
                    $taberror[] = $errorfile;
                }
            } else {
                $errorfile .= "la photo n'est pas valide. Veuillez choisir une autre photo!";
                $taberror[] = $errorfile;
            }
        } else {
            $errorfile .= "l'extension n'est pas valide. veuillez choisir une photo en format png,jpg";
            $taberror[] = $errorfile;
        }
    } else {
        $newfilename = null;
    }

    // var_dump($_POST, $hash, $newfilename);
    if (empty($taberror)) {

        $statementinsertabo->execute([
            "nom" => $nom,
            "prenom" => $prenom,
            "birthdate" => $_POST['birthDate'],
            "mail" => $email,
            "pass" => $hash,
            "image" => $newfilename
        ]);
        header("location: connexion.php");
    }
}




?>
<div class="container">


    <form action="" method="post" enctype="multipart/form-data">
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
            <input type="text" class="form-control" name="mail">

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


        <div class="form-group">
            <label for="formFile" class="form-label mt-4">Photo de profil</label>
            <input class="form-control" type="file" id="formFile" name="file">
            <p class="text-primary">la photo en jpg, png. Ne pas dépasser 500Mb </p>
        </div>

        <?php
        if (!empty($errorfile)) { ?>
            <p class="text-secondary"><?= $errorfile ?></p>
        <?php } ?>

        <button type="submit" name="send" class="btn btn-outline-primary centrer">Inscription</button>



    </form>
    <h4 style="text-align: center;" class="text-success">Vous avez deja un compte. Veuillez vous connecter <a class="text-warning" href="connexion.php"> <strong class="text-success">ICI</strong></a> </h4>
</div>