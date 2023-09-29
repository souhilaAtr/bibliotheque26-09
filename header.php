<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/vapor/bootstrap.min.css">

    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Bibliothèque</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/bibliotheque/index.php">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/bibliotheque/crudlivre/livres.php">Livres Disponible</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/bibliotheque/crudlivre/insertion.php">Ajout Livre</a>
                    </li>
                    <?php if(!empty($_SESSION)){?> 
                    <li class="nav-item">
                        <a class="nav-link" href="/bibliotheque/inscription.php?action=true">Deconnexion</a>
                    </li>
                    <?php }else{ ?> 
                    <li class="nav-item">
                        <a class="nav-link" href="/bibliotheque/inscription.php">Inscription/connexion</a>
                    </li>
                        <?php } ?>
                </ul>

            </div>
        </div>
    </nav>