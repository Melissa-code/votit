<?php 
require_once('lib/required_files.php'); 
require_once('templates/header.php'); 

session_regenerate_id(true); 
session_destroy(); 
unset($_SESSION); 
header('Location: connexion.php'); 


