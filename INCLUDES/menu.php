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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="IMGS/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            LIV CVL - Tournois de Football
            </a>
        </div>
    </nav>
    
    <header class="header">
        <img class="menu-logo" src="IMGS/logo.png" alt="Logo">
        <h4 class="menu-title">LIV CVL - Tournois de Football</h4>
        <!-- <h4 class="menu-title">UNI BDE - Tournois de Football - <?= $GLOBALS['VERSION']; ?></h4> -->
        <!-- <input type="checkbox" name="" id="color"> -->
        <?php
        if (checkConnected()) {
            ?>
            <li class="li-credits"><?= $_SESSION['user_credits']; ?> <i class="fa-solid fa-coins"></i></li>
            <?php
        }
        ?>
        <input class="menu-btn" type="checkbox" id="menu-btn" />
        <label class="menu-style" for="menu-btn"><span class="menu-style-line"></span></label>
        <nav class="nav">
            <ul class="menu-items">
                <li><a href="index.php" class="menu-item">Accueil</a></li>
                <li><a href="?page=rules" class="menu-item">Règles</a></li>
                <li><a href="?page=edt" class="menu-item">Planning</a></li>
                <?php

                if (checkConnected()) {
                    ?>
                    <script>const playerMoney = <?= $_SESSION['user_credits']; ?></script>
                    <li><a href="?page=profile" class="menu-item">Mon Profil</a></li>
                    <li><a href="?action=logout" class="menu-item">Déconnexion</a></li>
                    <?php

                    if ($_SESSION['user_rank'] <= 5) {
                        ?>
                        <style>
                            :root {
                                --main-forecolor: #831113;
                                --menu-backcolor-secondary: #9b6464;
                            }
                        </style>
                        <li><a href="?page=admin" style="color: red !important" class="menu-item">Administration</a></li>
                        <?php
                    }
                } else {
                    ?>

                    <li><a href="?page=login" class="menu-item">Se Connecter</a></li>
                    <li><a href="?page=signin" class="menu-item">S'inscrire</a></li>

                    <?php
                }

                ?>
            </ul>
        </nav>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>