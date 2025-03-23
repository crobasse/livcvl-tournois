<?php

if (!checkConnected()) {
    echo '<script>window.location = "index.php?page=login"</script>';
}

?>
<title>Mon Profil - LIV</title>


<div class="container">
    <div class="row mt-4 ">
        <div class="col">
            <div class="card bg-body-tertiary pt-2 pb-2">
                <div class="container">
                    <div class="row ">
                        <h1>Votre profil</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 ">
        <div class="col-md-6 col-12 mb-md-4">
            <div class="card bg-body-tertiary pt-2 pb-3">
                <div class="container">
                    <div class="row mt-2 mb-2">
                        <h2>Vos Informations:</h2>
                    </div>
                    <form id="profileForm" method="post">
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">

                                    <label for="registerUsername" class="form-label">Nom d'utilisateur</label>
                                    <div class="input-group mb-3 has-validation">
                                        <span class="input-group-text" id="registerUsernameAddon"><i
                                                class="fa-regular fa-user"></i></span>
                                        <input type="text" name="id" class="form-control" id="id"
                                            aria-describedby="registerUsernameAddon" placeholder="Nom d'utilisateur"
                                            required value="<?= $_SESSION['user_username']; ?>" autocomplete="user" />
                                        <div class="invalid-feedback">
                                            Nom d'utilisateur déja utilisé
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">

                                    <label for="registerEmail" class="form-label">Adresse Email</label>
                                    <div class="input-group mb-3 has-validation">
                                        <span class="input-group-text" id="registerEmailAddon">@</span>
                                        <input type="email" name="email" class="form-control" id="email"
                                            aria-describedby="registerEmailAddon" placeholder="Adresse Email" required
                                            value="<?= $_SESSION['user_email']; ?>" autocomplete="email">
                                        <div class="invalid-feedback">
                                            Email introuvable
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">

                                    <label for="registerLastName" class="form-label">Nom de famille</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="registerLastNameAddon"><i
                                                class="fa-regular fa-user"></i></span>
                                        <input type="text" name="lname" id="lname" class="form-control"
                                            aria-describedby="registerLastNameAddon" placeholder="Nom de famille"
                                            required value="<?= $_SESSION['user_lname']; ?>" autocomplete="lastname" />
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">

                                    <label for="registerFirstName" class="form-label">Prénom</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="registerFirstNameAddon"><i
                                                class="fa-regular fa-user"></i></span>
                                        <input type="text" name="fname" id="fname" class="form-control"
                                            aria-describedby="registerFirstNameAddon" placeholder="Prénom" required
                                            value="<?= $_SESSION['user_fname']; ?>" autocomplete="firstname">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row align-items-center">
                        <div class="col">
                            <input type="submit" form="profileForm" id="submit" name="submit" class="btn btn-primary"
                                value="Sauvegarder les modifications">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mt-md-0 mt-4 mb-md-0 mb-4">
            <div class="card bg-body-tertiary pb-3">
                <div class="container">
                    <div class="row mt-2 mb-2">
                        <h2>Vos paris:</h2>
                    </div>
                    <div class="row">
                        <div class="accordion" id="accordionParis">
                            <?php

                            $getBets = $db->prepare('SELECT * FROM bets WHERE player_id = ?');
                            $getBets->execute(array($_SESSION['user_id']));

                            if ($getBets->rowCount() > 0) {
                                $bets = $getBets->fetchAll();
                                foreach ($bets as $id => $value) {
                                    $getMatch = $db->prepare('SELECT * FROM matchs WHERE id = ?');
                                    $getMatch->execute(array($value['match_id']));
                                    $match = $getMatch->fetch();
                                    ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse<?= $id; ?>" aria-expanded="true"
                                                aria-controls="collapse<?= $id; ?>">
                                                <?= $match['teamA'] . ' - ' . $match['teamB']; ?>
                                            </button>
                                        </h2>
                                        <div id="collapse<?= $id; ?>" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionParis">
                                            <div class="accordion-body">
                                                <div class="bet-line">
                                                    <b>Pari:</b>
                                                    <label>
                                                        <?php

                                                        switch ($value['choice']) {
                                                            case 0:
                                                                echo $match['teamA'];
                                                                break;
                                                            case 1:
                                                                echo $match['teamB'];
                                                                break;
                                                            case 2:
                                                                echo "Nul";
                                                                break;
                                                            default:
                                                                echo "Error";
                                                                break;
                                                        }

                                                        ?>
                                                    </label>
                                                </div>
                                                <div class="bet-line">
                                                    <b>Mise: </b><label><?= $value['bet']; ?> <i class="bi bi-coin"></i></label>
                                                </div>
                                                <div class="bet-line">
                                                    <b>Etat: </b><label>
                                                        <?php

                                                        switch ($value['status']) {
                                                            case 0:
                                                                echo "En Attente...";
                                                                break;
                                                            case 1:
                                                                echo '<span class="state-lost">Perdu</span>';
                                                                break;
                                                            case 2:
                                                                echo '<a href="?action=get&match=' . $value['match_id'] . '&id=' . $_SESSION['user_id'] . '" class="state-won">Cliquez pour récupérer</a>';
                                                                break;
                                                            case 3:
                                                                echo '<span class="state-got">Récupéré</span>';
                                                                break;
                                                            default:
                                                                echo "Error";
                                                                break;
                                                        }

                                                        ?>
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "Vous n'avez pas encore parié.";
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

if (isset($_POST["submit"])) {
    if (isset($_POST["lname"]) && isset($_POST["fname"]) && isset($_POST["id"]) && isset($_POST["email"])) {
        $email = htmlspecialchars($_POST["email"]);
        $user_id = htmlspecialchars($_POST["id"]);
        $lname = htmlspecialchars($_POST["lname"]);
        $fname = htmlspecialchars($_POST["fname"]);
        if (!empty($lname) && !empty($fname) && !empty($user_id) && !empty($email)) {

            $checkdata = $db->prepare("SELECT * FROM users WHERE (username = ? OR email = ?) AND id != ?");
            $checkdata->execute(array($userid, $email, $_SESSION['user_id']));

            if ($checkdata->rowCount() == 0) {

                $updateUser = $db->prepare("UPDATE users SET lastname = ?, firstname = ?, username = ?, email = ? WHERE id = ?");
                $updateUser->execute(array($lname, $fname, $user_id, $email, $_SESSION['user_id']));


                $q = $db->prepare("SELECT * FROM users WHERE id = :id");
                $q->execute(['id' => $_SESSION["user_id"]]);
                $result = $q->fetch();

                $_SESSION['user_username'] = $result['username'];
                $_SESSION['user_email'] = $result['email'];
                $_SESSION['user_lname'] = $result['lastname'];
                $_SESSION['user_fname'] = $result['firstname'];
                $_SESSION['user_rank'] = $result['rank'];
                $_SESSION['user_secured'] = $result['secured'];
                $_SESSION['user_credits'] = $result['credits'];
                echo "<script>window.location = 'index.php?page=profile'</script>";

            } else {
                echo '<script>badid("Cet identifiant ou utilisateur est déjà utilisé.")</script>';
            }


        } else {
            echo '<script>badid("Veuillez remplir toutes les cases.")</script>';
        }
    }
}

?>


<script src="JS/profile.js"></script>