<?php 
require_once('lib/required_files.php'); 

$error404 = false;

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; 
    $poll = getPollById($pdo, $id); 
    if ($poll) {
        $pageTitle = $poll['title'];

        // Vote form
        if (isset($_SESSION['user']) && isset($_POST['voteSubmit'])) {
            removeVoteByPollIdAndUserId($pdo, $id, (int)$_SESSION['user']['id']);
            $res = addVote($pdo, $_POST['items'], (int)$_SESSION['user']['id']); 
        }
        $results = getPollResultByPollId($pdo, $id); 
        $totalUsers = getPollTotalUsersByPollId($pdo, $id); 
        $items = getPollItems($pdo, $id); 
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
        <!-- Poll --> 
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold  lh-1 mb-3"><?= $poll['title'] ?></h1>
            <p class="lead">
            <?= $poll['description'] ?>
            </p>
        </div>

        <!-- Results of the poll --> 
        <div class="col-lg-6">
            <h2>Résultats</h2>
            <div class="results">
                <?php foreach($results as $index => $result) : ?>
                    <?php if ($totalUsers) {
                        $resultPercent = $result['nbVotes'] / $totalUsers * 100 ; 
                    } else {
                        $resultPercent = 0; 
                    } ?>
                    <h3><?= $result['name'] ?></h3>
                    <div class="progress" role="progressbar" aria-label="<?= $result['name'] ?>" aria-valuenow="<?= $resultPercent ?>" aria-valuemin="<?= $resultPercent ?>" aria-valuemax="100">
                        <div class="p-1 progress-bar progress-bar-striped progress-color-<?= $index ?>" style="width:"><?= $result['name'] ?> <?= round($resultPercent, 2) ?> %</div>
                    </div>
                <?php endforeach ?>
            </div>

            <!-- To vote log-in or fill the gaps of the form to vote --> 
            <div class="mt-5">
                <?php if (isset($_SESSION['user'])) { ?>  
                    <form action="" method="POST">
                        <h2>Votez pour ce sondage</h2>
                        <h3><?= $poll['title'] ?></h3> 
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                            <?php foreach ($items as $key => $item) { ?>
                                <input type="checkbox" class="btn-check" id="btncheck<?= $item['id'] ?>" autocomplete="off" value="<?= $item['id'] ?>" name="items[]">
                                <label class="btn btn-outline-primary" for="btncheck<?= $item['id'] ?>"><?= $item['name'] ?></label>
                            <?php } ?>
                        </div>
                        <input type="submit" class="btn btn-primary w-25 m-3" id="validationVote" value="Voter" name="voteSubmit">
                    </form>
                <?php } else { ?> 
                    <div class="alert alert-danger my-2 text-center fw-bold" role="alert" ; >Vous devez être connecté pour voter. </div>
                <?php } ?> 
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

