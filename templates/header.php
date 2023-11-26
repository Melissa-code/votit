<?php
require_once('lib/config.php');  
require_once('lib/poll.php');  

// Navigation : array of pages 
$mainMenu = [
    'index.php' => 'Accueil', 
    'sondages.php' => 'Sondages', 
    'connexion.php' => 'Connexion <i class="fa-solid fa-right-to-bracket" style="color: #28a745;"></i>',
    'deconnexion.php' => 'Déconnexion <i class="fa-solid fa-right-from-bracket" style="color: #28a745;"></i>',
]
?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The company VotIt wants to offer a website for polls about the IT/dev.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?= PATH_ASSETS_IMAGES ?>favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="assets/css/override-bootstrap.css" rel="stylesheet"> 
    <title>
        <?php if (isset($mainMenu[basename($_SERVER['SCRIPT_NAME'])])) {
            echo $mainMenu[basename($_SERVER['SCRIPT_NAME'])]." - ".SITE_NAME ?><?php } 
            elseif (isset($pageTitle)) {
               echo $pageTitle." - ".SITE_NAME; }
            else {
                echo " - ".SITE_NAME; } ?>
    </title>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom ">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="<?=PATH_ASSETS_IMAGES ?>logo-votit.png" alt="logo VotIt" width="100">
        </a>
        <!-- Links of the navigation menu -->
        <ul class="nav nav-pills align-items-center">
        <?php foreach ($mainMenu as $linkPage => $linkTitle): ?>
            <li class="nav-item">
                <a href="<?= $linkPage ?>" class="nav-link <?php if (basename($_SERVER['SCRIPT_NAME']) === $linkPage) echo 'active'; ?>"><?= $linkTitle ?></a>
            </li>
        <?php endforeach ?>
        </ul>
        </header>
    </div>

    <!-- Main -->
    <main class="container">