<?php 
require_once('templates/header.php'); 

$polls = getPolls($pdo);

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


    

   