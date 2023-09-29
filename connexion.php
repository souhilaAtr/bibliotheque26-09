<?php
include "header.php";
include "fonction.php";
require "DB.php";


if (isset($_POST['connexion'])) {
    $email = strip_tags($_POST['mail']);
    $password = $_POST['password'];
    $errormail = null;
    $errorpsd = null;
    $taberror = array();


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

    if (empty($taberror)) {
        $statabomail->execute([
            "mail" => $email
        ]);
        $abonne = $statabomail->fetch();
        if ($abonne) {
                        if (password_verify($password, $hash)) {
                            $_SESSION['id'] = $abonne['id_abonne'];
                            header("location: profil.php");
                        }else{
                            ?>
                            <h4 style="text-align: center;" class="text-danger">mot de passe incorrecte/introuvable. </h4>
                            <?php
                        }
        } else {
?>
            <h4 style="text-align: center;" class="text-danger">l'email est incorrecte/introuvable. Veuillez vous inscrire <a class="text-danger" href="inscription.php"> <strong class="text-danger">ICI</strong></a> </h4>

<?php
        }
    }
}

?>
<div class="container">
    <form action="" method="post">

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
        <button type="submit" name="connexion" class="btn btn-outline-primary centrer">Connexion</button>
    </form>
    <h4 style="text-align: center;" class="text-success">Vous n'avez pas de compte. Veuillez vous inscrire <a class="text-warning" href="inscription.php"> <strong class="text-success">ICI</strong></a> </h4>

</div>