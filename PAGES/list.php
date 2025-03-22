<?php

$getMatchs = $db->query("SELECT * FROM matchs ORDER BY date ASC");
$getMatchs->execute();

$matchs = $getMatchs->fetchAll();

$daysOfWeek = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
$monthsOfYear = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];


?>


<title>Accueil - LIV</title>
<link rel="stylesheet" href="CSS/matchs.css">
<div class="container">

    <h1 class="mt-3 mb-3">Liste des matchs</h1>

    <div class="accordion" id="accordionExample">
        <?php

        foreach ($matchs as $id => $match) {
            $date = new DateTimeImmutable($match["date"]);
            $txtStatus = '';
            $accordionStatus = '';
            switch ($match["status"]) {
                case 0:
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
                    <button class="accordion-button focus-ring <?php if ($id > 0)
                        echo "collapsed"; ?>" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse<?= $id; ?>" aria-expanded="true" aria-controls="collapseOne">
                        <?= $match["teamA"]; ?> vs <?= $match["teamB"]; ?>
                    </button>
                </h2>
                <div id="collapse<?= $id; ?>" class="accordion-collapse collapse <?php if ($id == 0)
                      echo "show"; ?>" data-bs-parent="#accordionExample">
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
                                <div class="col align-center mt-3 mt-sm-0">
                                    <div class="row">
                                        <?php

                                        if ($match["status"] == 0) {
                                            if (checkConnected()) {
                                                if (hasPlayerPlayed($_SESSION["id"], $match["id"])) {
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
                                                        <button type="button" href="" class="btn bg-body-tertiary">
                                                            Cliquez ici !
                                                        </button>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="col">
                                                    <h4 class="align-center">
                                                        Envie de jouer ?
                                                    </h4>
                                                </div>
                                                <div class="col">
                                                    <a type="button" href="?page=login" class="btn bg-body-tertiary">
                                                        Connectez-vous !
                                                    </a>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
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