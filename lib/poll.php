<?php 
require_once('lib/pdo.php');  

/**
 * Get all the polls in the DB 
 */
function getPolls(PDO $pdo) 
{
    $query = $pdo->prepare("SELECT * FROM poll");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result; 
}