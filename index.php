<?php 
require_once('templates/header.php'); 

$polls = getPolls($pdo, HOME_POLLS_LIMIT);

?>

<div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="<?= PATH_ASSETS_IMAGES ?>logo-votit.png" class="d-block mx-lg-auto img-fluid" alt="logo Vot It" width="400" height="200" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Votez sur des sujets d'actualité</h1>
            <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="" type="button" class="btn btn-primary btn-lg px-4 me-md-2">Voir les sondages</a>
            </div>
        </div>
    </div>
</div>

<div class="b-example-divider"></div>

<div class="container col-xxl-8">
    <div class="row d-flex flex-wrap justify-content-center text-center">
        <h2>Les derniers sondages</h2>

        <?php foreach($polls as $poll) {
            require('templates/poll_part.php') ;
        }?>
    </div>
</div>

<?php require_once('templates/footer.php'); ?>


    

   