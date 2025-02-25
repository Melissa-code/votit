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
 * @param int $id (poll_id)
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
 * Get the total number of the users
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

/**
 * Get all the propositions to vote for a poll 
 * 
 * @param PDO $pdo 
 * @param int $id (poll_id)
 * @return array
 */
function getPollItems(PDO $pdo, int $id) : array
{
    $query = $pdo->prepare(
        "SELECT * 
        FROM poll_item 
        WHERE poll_id = :id
        ORDER BY name ASC"
    );
    $query->bindValue(':id', $id, PDO::PARAM_INT); 
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Add a vote for a poll 
 * 
 * @param PDO $pdo 
 * @param array $items
 * @param int $user_id 
 * @return bool
 */
function addVote(PDO $pdo, array $items, int $user_id): bool
{
    $query = $pdo->prepare(
        "INSERT INTO user_poll_item (user_id, poll_item_id) 
        VALUES (:user_id, :poll_item_id)"
    );
    $query->bindValue(':user_id', $user_id, PDO::PARAM_INT); 
    $res = true; 
    foreach ($items as $key => $itemId) {
        $query->bindValue(':poll_item_id', (int)$itemId, PDO::PARAM_INT); 
        if (!$query->execute()) {
            $res = false; 
        }
    }
    
    return $res;
}

/**
 * Delete the propositions of the user for a poll 
 * 
 * @param PDO $pdo 
 * @param int $poll_id 
 * @param int $user_id 
 * @return bool
 */
function removeVoteByPollIdAndUserId(PDO $pdo, int $poll_id, int $user_id): bool
{
    $query = $pdo->prepare(
        "DELETE upi FROM user_poll_item AS upi
        JOIN poll_item AS pi 
        ON upi.poll_item_id = pi.id
        WHERE pi.poll_id = :poll_id AND upi.user_id = :user_id"
    ); 
    $query->bindValue(':poll_id', $poll_id, PDO::PARAM_INT); 
    $query->bindValue(':user_id', $user_id, PDO::PARAM_INT); 
    return $query->execute();
}

/**
 * Add a vote for a poll 
 * 
 * @param PDO $pdo 
 * @return bool|int
 */
function savePoll(
    PDO $pdo, 
    string $title, 
    string $description, 
    int $category_id, 
    int $user_id): bool|int {
    $query = $pdo->prepare(
        "INSERT INTO poll (title, description, category_id, user_id) 
        VALUES (:title, :description, :category_id, :user_id)"
    );
    $query->bindValue(':title', $title, PDO::PARAM_STR); 
    $query->bindValue(':description', $description, PDO::PARAM_STR); 
    $query->bindValue(':category_id', $category_id, PDO::PARAM_INT); 
    $query->bindValue(':user_id', $user_id, PDO::PARAM_INT); 
    if ($query->execute()) {
        return $pdo->lastInsertId(); 
    } else {
        return $res = false; 
    }
}