<div class="modal modal-lg fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="registerForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">

                                    <label for="registerUsername" class="form-label">Nom d'utilisateur</label>
                                    <div class="input-group mb-3 has-validation">
                                        <span class="input-group-text" id="registerUsernameAddon"><i
                                                class="fa-regular fa-user"></i></span>
                                        <input type="text" name="registerUsername" class="form-control"
                                            id="registerUsername" aria-describedby="registerUsernameAddon"
                                            placeholder="Nom d'utilisateur" required
                                            value="<?= isset($_POST["registerUsername"]) ? $_POST["registerUsername"] : ""; ?>"
                                            autocomplete="user" />
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
                                        <input type="email" name="registerEmail" class="form-control" id="registerEmail"
                                            aria-describedby="registerEmailAddon" placeholder="Adresse Email" required
                                            value="<?= isset($_POST["registerEmail"]) ? $_POST["registerEmail"] : ""; ?>"
                                            autocomplete="email">
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
                                        <input type="text" name="registerLastName" class="form-control"
                                            id="registerLastName" aria-describedby="registerLastNameAddon"
                                            placeholder="Nom de famille" required
                                            value="<?= isset($_POST["registerLastName"]) ? $_POST["registerLastName"] : ""; ?>"
                                            autocomplete="lastname" />
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">

                                    <label for="registerFirstName" class="form-label">Prénom</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="registerFirstNameAddon"><i
                                                class="fa-regular fa-user"></i></span>
                                        <input type="text" name="registerFirstName" class="form-control"
                                            id="registerFirstName" aria-describedby="registerFirstNameAddon"
                                            placeholder="Prénom" required
                                            value="<?= isset($_POST["registerFirstName"]) ? $_POST["registerFirstName"] : ""; ?>"
                                            autocomplete="firstname">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">

                                    <label for="registerGrade" class="form-label">Classe</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="registerGradeAddon"><i
                                                class="fa-regular fa-user"></i></span>
                                        <input type="text" name="registerGrade" class="form-control" id="registerGrade"
                                            aria-describedby="registerGradeAddon" placeholder="Classe" required
                                            value="<?= isset($_POST["registerGrade"]) ? $_POST["registerGrade"] : ""; ?>">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">

                                    <label for="registerPasswd" class="form-label">Mot de Passe</label>
                                    <div class="input-group mb-3 has-validation">
                                        <span class="input-group-text" id="registerPasswdAddon">🔑</span>
                                        <input type="password" name="registerPasswd" class="form-control"
                                            id="registerPasswd" aria-describedby="registerPasswdAddon"
                                            placeholder="Mot de Passe" required autocomplete="password">
                                        <div class="invalid-feedback">
                                            Mot de passe incorrect
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">

                                    <label for="registerPasswd2" class="form-label">Confirmation du Mot de Passe</label>
                                    <div class="input-group mb-3 has-validation">
                                        <span class="input-group-text" id="registerPasswd2Addon">🔑</span>
                                        <input type="password" name="registerPasswd2" class="form-control"
                                            id="registerPasswd2" aria-describedby="registerPasswd2Addon"
                                            placeholder="Mot de Passe" required autocomplete="password">
                                        <div class="invalid-feedback">
                                            Mot de passe incorrect
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="registerSubmit" form="registerForm"
                    class="btn btn-primary">S'inscrire</button>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST['registerSubmit'])) {

    if (
        !empty($_POST['registerLastName']) && !empty($_POST['registerFirstName']) &&
        !empty($_POST['registerUsername']) && !empty($_POST['registerEmail']) &&
        !empty($_POST['registerGrade']) &&
        !empty($_POST['registerPasswd']) && !empty($_POST['registerPasswd2'])
    ) {

        $qmail = $db->prepare("SELECT * FROM users WHERE email = :email");
        $qmail->execute(['email' => $_POST['registerEmail']]);
        $resultmail = $qmail->fetch();

        if ($resultmail == false) {

            $quser = $db->prepare("SELECT * FROM users WHERE username = :username");
            $quser->execute(['username' => $_POST['registerUsername']]);
            $resultuser = $quser->fetch();

            if ($resultuser == false) {
                $options = [
                    'cost' => 12,
                ];
                $hashpass = password_hash($_POST['registerPasswd2'], PASSWORD_BCRYPT, $options);
                $token = bin2hex(random_bytes(35));

                if (password_verify($_POST['registerPasswd'], $hashpass)) {
                    $q = $db->prepare("INSERT INTO users(username,email,lastname,firstname,grade,password, token) VALUES(:username,:email,:lastname,:firstname,:grade,:password,:token)");
                    $q->execute([
                        'username' => htmlspecialchars($_POST['registerUsername']),
                        'email' => htmlspecialchars($_POST['registerEmail']),
                        'lastname' => htmlspecialchars($_POST['registerLastName']),
                        'firstname' => htmlspecialchars($_POST['registerFirstName']),
                        'grade' => htmlspecialchars($_POST['registerGrade']),
                        'password' => $hashpass,
                        'token' => $token
                    ]);
                    echo '<script>window.location = "index.php?modal=login"</script>';
                } else {
                    ?>
                    <script>
                        var loginModal = new bootstrap.Modal(document.getElementById('registerModal'), {})
                        document.getElementById("registerPasswd").classList.add("is-invalid")
                        document.getElementById("registerPasswd2").classList.add("is-invalid")

                        loginModal.toggle()
                    </script>
                    <?php
                }
            } else {
                ?>
                <script>
                    var loginModal = new bootstrap.Modal(document.getElementById('registerModal'), {})
                    document.getElementById("registerUsername").classList.add("is-invalid")

                    loginModal.toggle()
                </script>
                <?php
            }

        } else {
            ?>
            <script>
                var loginModal = new bootstrap.Modal(document.getElementById('registerModal'), {})
                document.getElementById("registerEmail").classList.add("is-invalid")


                loginModal.toggle()
            </script>
            <?php
        }

    } else {
        ?>
        <script>
            var loginModal = new bootstrap.Modal(document.getElementById('registerModal'), {})
            document.getElementById("registerUsername").classList.add("is-invalid")
            document.getElementById("registerEmail").classList.add("is-invalid")
            document.getElementById("registerLastName").classList.add("is-invalid")
            document.getElementById("registerFirstName").classList.add("is-invalid")
            document.getElementById("registerGrade").classList.add("is-invalid")
            document.getElementById("registerPasswd").classList.add("is-invalid")
            document.getElementById("registerPasswd2").classList.add("is-invalid")

            loginModal.toggle()
        </script>
        <?php
    }


}
?>