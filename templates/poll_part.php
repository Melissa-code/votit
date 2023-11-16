<!-- Card for a poll -->
<div class="card col-md-4 m-1 d-flex justify-content-center">
    <div class="card-header">
       <img src="<?= PATH_ASSETS_IMAGES ?>icon-arrow.png" width="40" alt="icône de sondage">
        <?= $poll['category_name'] ?> 
    </div>
    <div class="card-body d-flex flex-column ">
        <h3 class="card-title"><?= $poll['title'] ?></h3>
        <div class="mt-auto">
            <a href="#" class="btn btn-primary">Voir le sondage</a>
        </div>
    </div>
</div>

 