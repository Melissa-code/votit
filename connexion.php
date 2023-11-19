<?php 
require_once('lib/required_files.php'); 
require_once('templates/header.php'); 

$errors = []; 

if (isset($_POST['loginUser'])) {
   $user = verifyUserLoginPassword($pdo, $_POST['email'], $_POST['password']); 

   if ($user) {
        // when login or logout regenerate id of the session and destroy the oldest for security
        // cookie of the session (inspecter->application == wamp64->tmp) 
        session_regenerate_id(true);
        $_SESSION['user'] = $user; // array(key=>value)
        header('location: index.php'); 
   } else {
        $errors[]= 'Email ou mot de passe incorrect.'; 
   }
}
?>

<div class="container col-xxl-8 px-4 py-5">
    <div class="row d-flex justify-content-center align-items-center g-5 py-md-5">

        <div class="col-md-8">

            <?php
                // Display the errors 
                foreach ($errors as $error) {
                    echo '<div class="alert alert-danger my-2 text-center" role="alert" ; >'.$error.'</div>'; 
                }
            ?>

            <h1 class="text-center my-3">Connexion</h1>
            <form action="" method="POST">
                <!-- Email --> 
                <div class="mb-3">
                    <label for="email" class="form-label fw-bolder">Email </label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
                </div>
                <!-- Password --> 
                <div class="mb-3">
                    <label for="password" class="form-label fw-bolder">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="password">
                    <div class="form-text"><a class="" href="">Mot de passe oublié</a></div>
                </div>
                <!-- Submit --> 
                <button type="submit" name="loginUser" class="btn btn-primary fw-bolder w-100 d-block mx-auto">Se connecter</button>
            </form>
        </div>
    </div>
</div>

<?php require_once('templates/footer.php'); ?>