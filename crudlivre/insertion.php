<?php
include "../header.php";
require "../DB.php";
include "../fonction.php";

// la partie modification 


if (!empty($_GET['id_livre'])) {
    $queryselection->execute([
        "id" => $_GET['id_livre']
    ]);
    $livre = $queryselection->fetch();
}
// var_dump($livre);
// 

if (isset($_POST['ajouter'])) {
    $auteur = strip_tags($_POST['auteur']);
    $titre = strip_tags($_POST['titre']);
    $errorauteur = null;
    $errortitre = null;
    $taberror = array();

    if (empty($auteur)) {
        $errorauteur .= "<li> le champ auteur ne doit pas etre vide </li>";
        $taberror[] = $errorauteur;
    } elseif (strlen($auteur) < 2 || strlen($auteur) > 45) {
        $errorauteur .= "<li> le nom de l'auteur ne doit pas depasser les 45 caracteres</li>";
        $taberror[] = $errorauteur;
    }
    if (empty($titre)) {
        $errortitre .= "<li> le champ titre ne doit pas etre vide </li>";
        $taberror[] = $errortitre;
    } elseif (strlen($titre) < 2 || strlen($titre) > 45) {
        $errortitre .= "<li> le titre du livre ne doit pas depasser les 45 caracteres</li>";
        $taberror[] = $errortitre;
    }
     //traitement
    if (empty($taberror)) {
        if(empty($livre)){
             $queryinsert->execute([
            "auteur" => $auteur,
            "titre" => $titre
        ]);
        }else{
            $querymodification->execute([
                "auteur" => $_POST['auteur'],
                "titre" => $_POST['titre'],
                "id" => $_GET['id_livre']
            ]);
        }
       
       

        header("location: livres.php");
    }
}


?>

<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1" class="form-label mt-4">Auteur : </label>
            <!-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="auteur" 
            value="<?php // echo @$_POST['auteur'] 
                    ?>"> -->


            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="auteur" value="<?php
                                                                                                                                if (empty($livre)) {
                                                                                                                                    echo @$_POST['auteur'];
                                                                                                                                } else {
                                                                                                                                    echo $livre['auteur'];
                                                                                                                                }

                                                                                                                                ?>">

        </div>
        <?php if (!empty($errorauteur)) { ?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong><?= $errorauteur   ?></strong>
            </div>

        <?php  } ?>



        <div class="form-group">
            <label for="exampleInputEmail1" class="form-label mt-4">Titre : </label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="titre" value="<?php
                                                                                                                                if (empty($livre)) {
                                                                                                                                    echo @$_POST['titre'];
                                                                                                                                } else {
                                                                                                                                    echo $livre['titre'];
                                                                                                                                }

                                                                                                                                ?>">

        </div>

        <?php if (!empty($errortitre)) { ?>

            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong><?php echo $errortitre ?></strong>
            </div>

        <?php } ?>

        <?php separation()    
        ?>

        <button type="submit" class="btn btn-success centrer" name="ajouter">
                                                                            <?php if(empty($livre)){         
                                                                            echo "Ajouter" ;
                                                                        }else{
                                                                            echo "Modifier" ;
                                                                        }?>
         </button>



    </form>
</div>