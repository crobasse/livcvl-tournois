<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Connexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="loginForm">
                    <div class="mb-3">

                        <label for="loginEmail" class="form-label">Adresse Email</label>
                        <div class="input-group mb-3 ig-login-email has-validation">
                            <span class="input-group-text" id="loginEmailAddon"><i
                                    class="fa-regular fa-user"></i></span>
                            <input type="email" name="loginEmail" class="form-control" id="loginEmail"
                                aria-describedby="loginEmailAddon" placeholder="Adresse Email" required
                                value="<?= isset($_POST["loginEmail"]) ? $_POST["loginEmail"] : ""; ?>"
                                autocomplete="email" />
                            <div class="invalid-feedback">
                                Email introuvable
                            </div>
                        </div>


                    </div>
                    <div class="mb-3">

                        <label for="loginPasswd" class="form-label">Mot de Passe</label>
                        <div class="input-group mb-3 ig-login-passwd has-validation">
                            <span class="input-group-text" id="loginPasswdAddon">🔑</span>
                            <input type="password" name="loginPasswd" class="form-control" id="loginPasswd"
                                aria-describedby="loginPasswdAddon" placeholder="Mot de Passe" required
                                autocomplete="password">
                            <div class="invalid-feedback">
                                Mot de passe incorrect
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="loginSubmit" form="loginForm" class="btn btn-primary">Se connecter</button>
            </div>
        </div>
    </div>
</div>

<?php


if (isset($_POST["loginSubmit"])) {
    if (!empty($_POST["loginEmail"]) && !empty($_POST["loginPasswd"])) {
        $q = $db->prepare("SELECT * FROM users WHERE email = :email");
        $q->execute(['email' => $_POST["loginEmail"]]);
        $result = $q->fetch();


        if ($result == true) {
            // Le Compte Existe
            $hashpassword = $result['password'];
            if (password_verify($_POST["loginPasswd"], $hashpassword)) {
                //Tout est bon

                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_username'] = $result['username'];
                $_SESSION['user_email'] = $result['email'];
                $_SESSION['user_lname'] = $result['lastname'];
                $_SESSION['user_fname'] = $result['firstname'];
                $_SESSION['user_rank'] = $result['rank'];
                $_SESSION['user_secured'] = $result['secured'];
                $_SESSION['user_credits'] = $result['credits'];

                // if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                //     $ip = $_SERVER['HTTP_CLIENT_IP'];
                // } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                //     $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                // } else {
                //     $ip = $_SERVER['REMOTE_ADDR'];
                // }

                // $updateIP = $db->prepare("UPDATE users SET ip = ? WHERE id = ?");
                // $updateIP->execute(array($ip, $result['id']));


                echo '<script>window.location = "index.php"</script>';

            } else {
                ?>
                <script>
                    var loginModal = new bootstrap.Modal(document.getElementById('loginModal'), {})
                    loginModal.toggle()
                    document.getElementById("loginPasswd").classList.add("is-invalid")
                </script>
                <?php
            }

        } else {
            ?>
            <script>
                var loginModal = new bootstrap.Modal(document.getElementById('loginModal'), {})
                loginModal.toggle()

                document.getElementById("loginEmail").classList.add("is-invalid")
            </script>
            <?php
        }


    } else {
        ?>
        <script>
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'), {})
            document.getElementById("loginPasswd").classList.add("is-invalid")
            document.getElementById("loginEmail").classList.add("is-invalid")
            loginModal.toggle()
        </script>
        <?php
    }
}


?>