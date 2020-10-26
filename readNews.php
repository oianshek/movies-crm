<?php
require_once "database/link.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'headData.php' ?>
    <title>MovieLand | News | <?=$_GET['title']?></title>
</head>

<body>

<?php
include_once 'headerAndSearch.php';

$stmt = $link->prepare('SELECT * FROM news WHERE title = ? LIMIT 1');
$stmt->bind_param("s", $_GET['title']);
$stmt->execute();
$newsInfo = $stmt->get_result()->fetch_object();
?>
<main class="container">
    <center>
        <h3><?= $newsInfo->title ?></h3>
        <img src="<?= $newsInfo->img ?>" alt="<?= $newsInfo->img ?>" class="col-sm-6">
    </center>
    <p><?= $newsInfo->description ?></p>
</main>

<?php
include_once 'footer.php';
include_once 'scripts.php';
?>
</body>
</html>
