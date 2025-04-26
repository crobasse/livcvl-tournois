<?php

if (!checkConnected() || $_SESSION['user_rank'] > 5) {
    die('<script>window.location = "index.php"</script>');
}

if (isset($_POST['submit-create'])) {
    if (
        isset($_POST['teamA']) && !empty($_POST['teamA']) &&
        isset($_POST['teamB']) && !empty($_POST['teamB']) &&
        isset($_POST['date']) && !empty($_POST['date'])
    ) {

        $createMatch = $db->prepare('INSERT INTO matchs(teamA,teamB,date) VALUE(?,?,?)');
        $date = new DateTimeImmutable($_POST['date']);
        $date = $date->setTime(12, 30);
        $createMatch->execute(array($_POST['teamA'], $_POST['teamB'], $date->format('Y-m-d H:i:s')));

    }
}
if (isset($_POST['submit-edit'])) {
    if (
        isset($_POST['match-select']) && $_POST['match-select'] != '' &&
        isset($_POST['state-select']) && $_POST['state-select'] != ''
    ) {
        $editMatch = $db->prepare('UPDATE matchs SET status = ? WHERE id = ?');
        $editMatch->execute(array($_POST['state-select'], $_POST['match-select']));
    }
}

if (isset($_POST['submit-end'])) {
    if (
        isset($_POST['match-select']) && $_POST['match-select'] != '' &&
        isset($_POST['teamA']) && $_POST['teamA'] != '' &&
        isset($_POST['teamB']) && $_POST['teamB'] != ''
    ) {

        if ($_POST['teamA'] < $_POST['teamB']) {
            $winner = 1;
        } else if ($_POST['teamA'] > $_POST['teamB']) {
            $winner = 0;
        } else {
            $winner = 2;
        }

        $cotes = cotesMatch($_POST['match-select']);

        $editMatch = $db->prepare('UPDATE matchs SET status = 2, coef_teamA = ?, coef_teamB = ?, coef_equal = ?, winner = ?, ptsA = ?, ptsB = ? WHERE id = ?');
        $editMatch->execute(array($cotes[0], $cotes[1], $cotes[2], $winner, $_POST['teamA'], $_POST['teamB'], $_POST['match-select']));


        $editBetsLoses = $db->prepare("UPDATE bets SET status = 1 WHERE match_id = ? AND choice != ?");
        $editBetsLoses->execute(array(intval($_POST['match-select']), $winner));

        $editBetsWin = $db->prepare('UPDATE bets SET status = 2 WHERE match_id = ? AND choice = ?');
        $editBetsWin->execute(array(intval($_POST['match-select']), $winner));

    }
}
?>


<title>Administration - UNI</title>
<link rel="stylesheet" href="CSS/admin.css">

<div class="container">
    <div class="row mt-4 ">
        <div class="col">
            <div class="card bg-body-tertiary pt-2 pb-2">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-auto align-items-center">
                            <h1>Administration</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-4 col-12">
            <div class="card bg-body-tertiary mt-4">
                <form method="post">
                    <div class="container">
                        <div class="row mt-2 mb-2">
                            <h3>Créer un nouveau match</h3>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-teamA"><i
                                        class="fa-solid fa-people-group"></i></span>
                                <input type="text" class="form-control" name="teamA" id="teamA" placeholder="Équipe A"
                                    aria-label="Equipe A" aria-describedby="addon-teamA">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-teamB"><i
                                        class="fa-solid fa-people-group"></i></span>
                                <input type="text" class="form-control" name="teamB" id="teamB" placeholder="Équipe B"
                                    aria-label="Equipe B" aria-describedby="addon-teamB">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-date">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </span>
                                <input type="date" data-date-format="DD MMMM YYYY" class="form-control"
                                    placeholder="Date" name="date" id="date" aria-label="Date"
                                    aria-describedby="addon-date">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto align-self-center">
                                <input type="submit" class="btn btn-primary" name="submit-create" id="submit-create"
                                    value="Créer">
                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>




        <div class="col-md-6 col-lg-4 col-12">
            <div class="card bg-body-tertiary mt-4">
                <form class="statusMatch subpart" method="post">
                    <div class="container">
                        <div class="row mt-2 mb-2">
                            <h3>Modifier un match existant</h3>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="match-select"><b>Match</b></label>
                                <select class="form-select" name="match-select" id="match-select">
                                    <?php

                                    $getMatchs = $db->query('SELECT * FROM matchs WHERE status != 2 ORDER BY date ASC');
                                    $getMatchs->execute();

                                    $matchs = $getMatchs->fetchAll();
                                    foreach ($matchs as $match) {
                                        $date = new DateTimeImmutable($match["date"]);
                                        echo '<option value="' . $match['id'] . '">' . $match['teamA'] . ' - ' . $match['teamB'] . '   =>   ' . $date->format("d/m") . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="state-select"><b>État</b></label>
                                <select class="form-select" name="state-select" id="state-select">
                                    <option value="0">Planifié</option>
                                    <option value="1">En cours</option>
                                    <option value="3">Reporté</option>
                                    <option value="4">Annulé</option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto align-self-center">
                                <input type="submit" class="btn btn-primary" name="submit-edit" id="submit-edit"
                                    value="Modifier le match">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="col-md-12 col-lg-4 col-12">
            <div class="card bg-body-tertiary mt-4">
                <form class="endMatch subpart" method="post">
                    <div class="container">
                        <div class="row mt-2 mb-2">
                            <h3>Terminer un match existant</h3>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="match-select"><b>Match</b></label>
                                <select class="form-select" name="match-select" id="match-select">
                                    <?php

                                    $getPlayingMatchs = $db->query('SELECT * FROM matchs WHERE status = 1');
                                    $getPlayingMatchs->execute();

                                    $pMatchs = $getPlayingMatchs->fetchAll();

                                    foreach ($pMatchs as $match) {
                                        $date = new DateTimeImmutable($match["date"]);
                                        echo '<option value="' . $match['id'] . '">' . $match['teamA'] . ' - ' . $match['teamB'] . '   =>   ' . $date->format("d/m") . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="teamA"><b>Équipe A</b></label>
                                <input type="number" class="form-control" inputmode="decimal" name="teamA" id="teamA"
                                    placeholder="Points de l'équipe A" aria-label="Points Équipe A"
                                    aria-describedby="addon-teamA">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="teamB"><b>Équipe B</b></label>
                                <input type="number" class="form-control" inputmode="decimal" name="teamB" id="teamB"
                                    placeholder="Points de l'équipe B" aria-label="Points Équipe B"
                                    aria-describedby="addon-teamB">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto align-self-center">
                                <input type="submit" class="btn btn-primary" name="submit-end" id="submit-end"
                                    value="Terminer le match">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>