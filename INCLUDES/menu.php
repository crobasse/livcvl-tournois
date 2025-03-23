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
                    <p> - Les matchs dureront 20 minutes, 10 minutes par mi-temps et 3-4 minutes de pause entre les
                        deux.</p>
                    <p> - Les Hors-Jeu flagrant devronts êtres signalés.</p>
                    <p> - Tous les joueurs devront respecter les horaires des matchs.</p>
                    <p> - Tout retard dû aux matchs pour la reprise des cours, entraînera l'annulation du tournois.</p>
                    <p> - Tous les élèves devront récupérer leurs déchets et ne pas les laisser au bord du terrain.</p>
                    <p> - On compte sur le fair play des classes pour que le tournoi se passe dans de bonnes conditions.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">J'ai compris</button>
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