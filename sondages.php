<?php 
require_once('lib/required_files.php'); 

$polls = getPolls($pdo);

require_once('templates/header.php'); 
?>

<section>
    <h1>Tous les sondages</h1>
    <div class="row d-flex flex-wrap justify-content-center text-center">
        <?php foreach($polls as $poll) {
            require('templates/poll_part.php') ;
        } ?>
    </div>
</section>

<?php require_once('templates/footer.php'); ?>


    

   