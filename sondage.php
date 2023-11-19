<?php 
require_once('lib/required_files.php'); 

$error404 = false;

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; 
    $poll = getPollById($pdo, $id); 
    if ($poll) {
        $pageTitle = $poll['title'];
        $results = getPollResultByPollId($pdo, $id); 
    } else {
        $error404 = true;
    }
} else {
    $error404 = true;
}

require_once('templates/header.php'); 

// Display the page for a poll 
if (!$error404) { 
?>

<section>
    <div class="row align-items-center g-5 py-5">
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold  lh-1 mb-3"><?= $poll['title'] ?></h1>
            <p class="lead">
            <?= $poll['description'] ?>
            </p>
        </div>
        
        <div class="col-lg-6">
            <h2>Résultats</h2>
            <div class="results">
            <?php foreach($results as $result) : ?>
                <h3><?= $result['name']?></h3>
                <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-striped progress-color-2" style="width: 25%">25%</div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>

<?php
// Display the 404 page 
} else {
    echo '<h1 class="display-5 fw-bold lh-1 mb-3 text-center">Le sondage n\'existe pas</h1>'; 
}

require_once('templates/footer.php'); ?>

