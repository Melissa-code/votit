<?php 
require_once('lib/required_files.php'); 

// Page avalaible by the user if he's logged in
if (empty($_SESSION['user'])) {
    header('Location: connexion.php'); 
}

$categories = getCategories($pdo);

if (isset($_POST['savePoll'])) {
    $res = savePoll($pdo, $_POST['title'], $_POST['description'], (int)$_POST['category_id'], $_SESSION['user']['id']);
    if ($res) {
        header("Location: ajout_modification_sondage.php?id=$res");
    } else {
        $error = "Le sondage n'a pas été sauvegardé. "; 
    }
}

if (isset($_GET['id'])) {
    $poll = getPollById($pdo, $_GET['id']); 
}

require_once('templates/header.php'); 
?>

<div class="container col-xxl-8 px-4 py-5">
    <div class="row d-flex justify-content-center align-items-center g-5 py-md-5">
        <div class="col-md-9">
            <h1 class="text-center">Sondage</h1>
            <!-- Form  --> 
            <form action="" method="POST" class="mb-3">
                <!-- Title --> 
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $poll['title'] ?>">
                </div>
                <!-- Description --> 
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="description" id="description" name="description"><?= $poll['description'] ?></textarea>
                    <label for="description">Saisir une description</label>
                </div>
                <!-- Categories --> 
                <div class="mb-3">
                    <select name="category_id" class="form-select">
                        <option >Choisir une catégorie</option>
                        <?php foreach ($categories as $category) { ?>
                            <option <?php if ($category['id'] && $poll['category_id']) { echo 'selected="selected"'; } ?>
                            value="<?= $category['id'] ?>"><?= ucfirst($category['name']) ?></option>
                        <?php } ?>
                    </select>
                </div> 
                <!-- submit --> 
                <button type="submit" class="btn btn-primary w-100" name="savePoll">Enregistrer</button>
            </form>

            <?php
                if (!isset($_GET['id'])) { ?>
                    <div class="alert alert-warning  text-center fw-bold" role="alert" ; >Après avoir enregistrer le sondage, vous pourrez ajouter des propositions. </div>
            <?php } ?>
        </div>
    </div>
</div>



<?php require_once('templates/footer.php'); ?>