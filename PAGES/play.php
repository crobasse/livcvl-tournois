<?php

$daysOfWeek = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
$monthsOfYear = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

if (isset($_GET["match"])) {
    if (checkConnected()) {
        $getMatch = $db->prepare("SELECT * FROM matchs WHERE id = ? AND status = 0");
        $getMatch->execute(array($_GET["match"]));
        $match = $getMatch->fetch();

        if (!$match) {
            echo '<script>window.location = "index.php"</script>';
        }

        $date = new DateTimeImmutable($match["date"]);

        $_SESSION['match_id'] = $match['id'];
        $cotes = cotesMatch($match["id"]);

    } else {
        echo '<script>window.location ="index.php?page=login"</script>';
    }
} else {
    echo '<script>window.location = "' . get_base_url() . '"</script>';
}
?>
<link rel="stylesheet" href="CSS/bet.css">

<title>Jouer - LIV</title>
<div class="container">
    <form action="index.php?action=bet" method="post">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card bg-body-tertiary mt-5 pb-3 pt-3">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <h1>Match de <?= strtolower($match["poule"]); ?></h1>
                                </div>
                                <div class="col text-end align-middle">
                                    <?= $daysOfWeek[$date->format("N") - 1] . " "
                                        . $date->format("d") . " " . $monthsOfYear[$date->format("n") - 1]
                                        . " " . $date->format("Y"); ?>
                                </div>
                                <div class="row fs-3 mt-3 mb-3">
                                    <div class="col text-end">
                                        <span class="text-end"><?= $match["teamA"]; ?></span>
                                    </div>
                                    <div class="col text-center">
                                        <span>vs</span>
                                    </div>
                                    <div class="col">
                                        <span><?= $match["teamB"]; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-9 col-12 col-sm-6">
                    <div class="card bg-body-tertiary pb-3 pt-3">
                        <div class="container">
                            <div class="row">
                                <h2>Faites votre choix</h2>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg">
                                    <div class="card mt-2 mt-md-0 pt-5 pb-5 text-center">
                                        <label for="rTeamA">
                                            <div class="bet-option">
                                                <input type="radio" name="bChoice" id="rTeamA" value="0">
                                                <h1><?= $match["teamA"]; ?></h1>
                                                <span class="fs-4">x<span class="coef"><?= $cotes[0]; ?></span></span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="card mt-2 mt-md-0 pt-5 pb-5 text-center">
                                        <label for="rTeamB">
                                            <div class="bet-option">
                                                <input type="radio" name="bChoice" id="rTeamB" value="2">
                                                <h1>Nul</h1>
                                                <span class="fs-4">x<span class="coef"><?= $cotes[2]; ?></span></span>

                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="card mt-2 mt-md-0 pt-5 pb-5 text-center">
                                        <label for="rEqual">
                                            <div class="bet-option">
                                                <input type="radio" name="bChoice" id="rEqual" value="1">
                                                <h1><?= $match["teamB"]; ?></h1>
                                                <span class="fs-4">x<span class="coef"><?= $cotes[1]; ?></span></span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 col-sm-6 mt-sm-0 mt-3">
                    <div class="card bg-body-tertiary pb-3 pt-3 ps-2 pe-2">
                        <div class="container">
                            <div class="row">
                                <h2>Entrez votre mise</h2>
                            </div>
                            <div class="row mt-2 align-items-center">
                                <div class="col-auto">
                                    <b>Mise: </b>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-coin"></i></span>
                                        <input type="number" class="form-control" name="bet" id="bet"
                                            placeholder="Entrez la mise à parier" inputmode="decimal" value="0" min="0"
                                            max="<?= $_SESSION['user_credits']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center mt-3 mb-3">
                                <i class="bi bi-arrow-down fs-3"></i>
                            </div>
                            <div class="row">
                                <div class="earnings">
                                    <b>Gains gagnant: </b>
                                    <label id="earnings">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="gains">
                                    <b>Plus Value: </b>
                                    <label id="gains">0</label>
                                </div>
                            </div>
                            <div class="row">
                                <input type="submit" id="submit" value="Parier !" class=" mt-2 btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
<script src="JS/play.js"></script>