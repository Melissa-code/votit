<?php 
require_once('lib/pdo.php'); 

/**
 * Get all the categories 
 * 
 * @return array $categories
 */
function getCategories(PDO $pdo): array
{
    $query = $pdo->prepare("SELECT * FROM category");
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}