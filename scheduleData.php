<?php
include_once 'database/link.php';
$sql = "SELECT id FROM session 
WHERE hall_id = (SELECT id FROM hall WHERE cinema_id = (SELECT id FROM cinema WHERE name = ?) AND number = ?) 
AND starttime = ? 
AND movie_id = (SELECT id FROM movies WHERE name = ?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("ssss", $_POST['cinema'], $_POST['number'], $_POST['starttime'], $_POST['movie']);
$stmt->execute();
$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

if (isset($_COOKIE["ticketId"])) {
    // Removing cookie
    setcookie("sessionId", $res[0]['id'], time() - 3600);
}
setcookie("sessionId", $res[0]['id'], time() + 10 * 60);

?>