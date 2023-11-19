<?php 
require_once('lib/pdo.php');  

/**
 * Get the 3 latest polls (index.php) or all the polls in the database
 * 
 * @return array $polls
 */
function getPolls(PDO $pdo, int $limit = null): array
{
    $sql = "SELECT poll.* , category.name AS category_name FROM poll 
    JOIN category
    ON category.id = poll.category_id
    ORDER BY poll.id DESC"; 

    if ($limit) {
        $sql .= " LIMIT :limit"; 
    }

    $query = $pdo->prepare($sql);
    if ($limit) {
    $query->bindValue(':limit', $limit, PDO::PARAM_INT); 
    }
    $query->execute();
    $polls = $query->fetchAll(PDO::FETCH_ASSOC);

    return $polls; 
}

/**
 * Get one poll by id in the database 
 * 
 * @param PDO $pdo 
 * @param int $id  
 * @return array|bool 
 */
function getPollById(PDO $pdo, int $id): array|bool
{
    $query = $pdo->prepare("SELECT * FROM poll WHERE id = :id");
    $query->bindValue(':id', $id, PDO::PARAM_INT); 
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
}

/**
 * Get all the results (poll_item) for a poll_id in the database 
 * Count the number of votes (join the table user_poll_item)
 * 
 * @param PDO $pdo 
 * @param int $id (poll_id)
 * @return array
 */
function getPollResultByPollId(PDO $pdo, int $id): array
{
    $sql = "SELECT pi.* , COUNT(upi.poll_item_id) AS nbVotes
            FROM poll_item AS pi
            LEFT JOIN user_poll_item AS upi 
            ON pi.id = upi.poll_item_id
            WHERE pi.poll_id = :id
            GROUP BY pi.id
            ORDER BY nbVotes DESC";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT); 
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * 
 * @param PDO $pdo 
 * @param int $id (poll_id)
 * @return int (total_users)
 */
function getPollTotalUsersByPollId(PDO $pdo, int $id): int
{
    $sql = "SELECT COUNT(DISTINCT upi.user_id) AS total_users
            FROM poll_item AS pi
            LEFT JOIN user_poll_item AS upi 
            ON pi.id = upi.poll_item_id
            WHERE pi.poll_id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT); 
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return (int)$result['total_users']; 
    } else {
        return 0; 
    }
}