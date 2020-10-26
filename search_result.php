<?php
require("database/link.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'headData.php' ?>
    <title>Search</title>
</head>

<body>
<?php include_once 'headerAndSearch.php';
$search = $_GET['search'] . '%';
$stmt = $link->prepare("SELECT name FROM movies WHERE name LIKE ? ");
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<main class="container mb-5">
    <h1 class="text-center">Results in films</h1>

    <?php if (!empty($result)) {
        foreach ($result as $v) { ?>
            <div class="result mb-4">
            <a href="http://localhost/EndtermProject/movinfo.php?name=<?= $v['name'] ?>"><?php echo $v['name'];
        } ?></a>
        </div>
    <?php } else { ?>
        <div class="result mb-4">
            <p style="color: #ccc;"><?php echo 'Not found...' ?></p>
        </div>
    <?php } ?>
</main>
<?php
include_once 'footer.php';
include_once 'scripts.php';
?>
</body>
</html>