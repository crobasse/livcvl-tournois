<?php

$GLOBALS['VERSION'] = "Beta v1.0";

include "PHP/required.php";
session_start();

include_once "MODALS/LoginModal.php";
include_once "MODALS/RegisterModal.php";

// if (session_status() === PHP_SESSION_NONE){session_start();}
// $_SESSION = array();
// session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="IMGS/logo.png" />

</head>

</head>

<body>
    <div class="modal fade" id="rulesModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Règles du Tournois</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p> - Le règlement du football de base s’applique, seuls les hors jeux flagrant sont comptés comme
                        tel.</p>
                    <p> - Une équipe est constituée au minimum de 8 élèves d’une même classe, le tournoi est mixte.</p>
                    <p> - Chaque équipe se doit de ramener SA balle pour jouer le match</p>
                    <p> - Chaque match commence à 12h45. Si une des 2 équipes n’est pas présente, soit vous jouez avec
                        le nombre de joueur présent sur le moment soit c’est forfait : équivalent à un score de 2-0. Un
                        match se déroule en 2 mi-temps de 12 minutes chacune. Pour les secondes, les matchs se déroulent
                        sur le petit terrain. De plus, chaque match doit se terminer à 13h15 peu importe le déroulement.
                    </p>
                    <p> - Les cartons peuvent être utilisé : 2 jaunes = 1 rouge. Les sanctions encourues pour un carton
                        rouge</p>
                    <p> - diffèrent en fonction de la faute commise. Dans tous les cas, le joueur est expulsé et
                        l’équipe joue avec un joueur en moins le reste du match.</p>
                    <p> - Un match gagné, nul ou perdu valent respectivement 3, 1 et 0 points. En cas d’égalité de
                        points dans une poule la qualification se fera au goal average.</p>
                    <p> - Pour l’équipement, les crampons en fers et les vissés ne sont pas autorisés.</p>
                    <p> - En cas d’impossibilité de jouer un match il faut impérativement prévenir le CVL au moins 48H à
                        l’avance, dans le cas contraire : forfait.</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">J'ai compris</button>
                </div>
            </div>
        </div>
    </div>
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
                        <button type="button" class="btn nav-link" data-bs-toggle="modal" data-bs-target="#rulesModal">
                            Règlement
                        </button>
                    </li>
                    <?php

                    if (checkConnected()) {
                        ?>
                        <script>const playerMoney = <?= $_SESSION['user_credits']; ?></script>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=profile">Mon Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?action=logout">Déconnexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"><?php echo number_format($_SESSION['user_credits'], 0, ",", " "); ?> <i
                                    class="bi bi-coin"></i></a>
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
                            <button type="button" class="btn nav-link" data-bs-toggle="modal"
                                data-bs-target="#registerModal">
                                S'inscrire
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Se connecter
                            </button>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>


</body>

</html>