<?php 
require_once('lib/pdo.php');  

/**
 * Get user by email in the database 
 * & verify password
 * 
 * @param PDO $pdo 
 * @param int $id  
 * @return array|bool 
 */
function verifyUserLoginPassword(PDO $pdo, string $email, string $password): array|bool 
{
    $query = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $query->bindValue(':email', $email, PDO::PARAM_STR); 
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Verify password user with encrypted password in database 
    if ($user && password_verify($password, $user['password'])) {
        return $user; 
    } else {
        return false; 
    }
}
