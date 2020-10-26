<?php
require_once('database/link.php');
$sqlsend = "INSERT INTO feedback(email,name,message) VALUES (?, ?, ?)";

try {
    $stmt = $link->prepare($sqlsend);
    $stmt->bind_param("sss", $_POST['email'], $_POST['name'], $_POST['message']);
    $stmt->execute();
    echo "Thank you, for your feedback!";
} catch (mysqli_sql_exception $e) {
    echo $e->getMessage();
}
?>