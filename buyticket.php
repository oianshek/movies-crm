<?php
include_once 'database/link.php';
$sql = "INSERT INTO ticket(session_id, date, row, seat, email) VALUES (?,?,?,?,?)";
try {
    $stmt = $link->prepare($sql);
    $stmt->bind_param("sssss", $_COOKIE['sessionId'], $_POST['date'], $_POST['row'], $_POST['seat'], $_POST['email']);
    $stmt->execute();
    echo "You've successfully bought ticket!";
} catch (mysqli_sql_exception $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}