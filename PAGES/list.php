<?php

$getMatchs = $db->query("SELECT * FROM matchs ORDER BY date ASC");
$getMatchs->execute();

$matchs = $getMatchs->fetchAll();

$daysOfWeek = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
$monthsOfYear = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];


?>


<title>Accueil - LIV</title>
<div class="container">

    <h1 class="mt-4 mb-3">Liste des matchs</h1>

    <div class="container mb-3">
        <div class="row">
            <div class="col-lg">
                <div class="row">
                    <div class="col"><i class="bi bi-circle-fill" style="color: var(--bs-primary-bg-subtle)"></i>
                        Déjà joué</div>
                    <div class="col"><i class="bi bi-circle-fill" style="color: var(--bs-warning-bg-subtle)"></i> En
                        cours
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="row">
                    <div class="col"><i class="bi bi-circle-fill" style="color: var(--bs-success-bg-subtle)"></i>
                        Terminé
                    </div>
                    <div class="col"><i class="bi bi-circle-fill" style="color: var(--bs-danger-bg-subtle)"></i>
                        Reporté/Annulé</div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion mb-4" id="accordionExample">
        <?php

        foreach ($matchs as $id => $match) {
            $date = new DateTimeImmutable($match["date"]);
            $txtStatus = '';
            $accordionStatus = '';
            switch ($match["status"]) {
                case 0:
                    if (checkConnected()) {
                        if (hasPlayerPlayed($_SESSION["user_id"], $match["id"])) {
                            $accordionStatus = 'accordion-primary';
                        }
                    }
                    $txtStatus = "<span class='text-primary-emphasis'>Planifié</span>";
                    break;
                case 1:
                    $txtStatus = "<span class='text-warning'>En cours</span>";
                    $accordionStatus = 'accordion-warning';
                    break;
                case 2:
                    $txtStatus = "<span class='text-success'>Terminé</span>";
                    $accordionStatus = 'accordion-success';
                    break;
                case 3:
                    $txtStatus = "<span class='text-danger-emphasis'>Reporté</span>";
                    $accordionStatus = 'accordion-danger';
                    break;
                case 4:
                    $txtStatus = "<span class='text-danger'>Annulé</span>";
                    $accordionStatus = 'accordion-danger';
                    break;
                default:
                    $txtStatus = "<span class='text-danger'>Inconnu</span>";
                    $accordionStatus = 'accordion-danger';
                    break;
            }
            ?>
            <div class="accordion-item <?= $accordionStatus; ?>">
                <h2 class="accordion-header">
                    <button class="accordion-button focus-ring collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse<?= $id; ?>" aria-expanded="true" aria-controls="collapseOne">
                        <div class="container">
                            <div class="row">
                                <div class="col-2">
                                    <?= $date->format("d/m"); ?>
                                </div>
                                <div class="col-4 text-end">
                                    <?= $match["teamA"]; ?>
                                </div>
                                <div class="col-2 text-center">vs</div>
                                <div class="col-4">
                                    <?= $match["teamB"]; ?>
                                </div>
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="collapse<?= $id; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <b class="me-3">Score: </b>
                                                </td>
                                                <td>
                                                    <?= $match["ptsA"]; ?> - <?= $match["ptsB"]; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Date: </b>
                                                </td>
                                                <td>
                                                    <?= $daysOfWeek[$date->format("N") - 1] . " " . $date->format("d") . " " . $monthsOfYear[$date->format("n") - 1] . " " . $date->format("Y"); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Heure: </b>
                                                </td>
                                                <td>
                                                    <?= $date->format("H\hi"); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Statut: </b>
                                                </td>
                                                <td>
                                                    <?= $txtStatus; ?>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <?php

                                if ($match["status"] == 0) {
                                    ?>
                                    <div class="col border-start align-center mt-3 mt-sm-0">
                                        <div class="row">
                                            <?php
                                            if (checkConnected()) {
                                                if (hasPlayerPlayed($_SESSION["user_id"], $match["id"])) {
                                                    ?>
                                                    <div class="col">
                                                        <h4 class="align-center">
                                                            Vous avez déja joué !
                                                        </h4>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="col">
                                                        <h4 class="align-center">
                                                            Envie de jouer ?
                                                        </h4>
                                                    </div>
                                                    <div class="col">
                                                        <a type="button" href="?page=play&match=<?= $match["id"]; ?>"
                                                            class="btn bg-body-tertiary">
                                                            Cliquez ici !
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <h4 class="align-center">
                                                                Envie de jouer ?
                                                            </h4>
                                                        </div>
                                                        <div class="col-sm">
                                                            <a type="button" href="?modal=login" class="btn bg-body-tertiary">
                                                                Connectez-vous !
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        ?>
    </div>
</div>