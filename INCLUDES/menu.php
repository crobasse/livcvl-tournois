<?php

$GLOBALS['VERSION'] = "Beta v1.0";

include "PHP/required.php";
session_start();

// if (session_status() === PHP_SESSION_NONE){session_start();}
// $_SESSION = array();
// session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/menu.css">
    <link rel="stylesheet" href="CSS/base.css">
    <link rel="icon" type="image/png" href="IMGS/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img src="IMGS/logo.png" alt="Logo" height="50" class="d-inline-block align-text-top me-3">
            <a class="navbar-brand" href="index.php">LIV CVL - Football</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-3" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=rules">Règles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=edt">Planning</a>
                    </li>
                    <?php

                    if (checkConnected()) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=profile">Mon Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?action=logout">Déconnexion</a>
                        </li>
                        <?php

                        if ($_SESSION['user_rank'] <= 5) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="?page=admin">Administration</a>
                            </li>
                            <?php
                        }
                    } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=signin">S'inscrire</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=login">Se Connecter</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>