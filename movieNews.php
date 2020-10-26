<?php
require_once "database/link.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'headData.php' ?>
    <title>MovieLand | News</title>
</head>

<body>

<?php
include_once 'headerAndSearch.php';

$news = $link->query('SELECT * FROM news ORDER BY id DESC')->fetch_all(MYSQLI_ASSOC);
?>
<main class="container mb-5">
    <div class="newsgrid">
        <?php
        foreach ($news as $v)
            echo <<<hb
                <div class="news p-4">
                  <img src="$v[img]" width="100%">
                  <h5>$v[title]</h5>
                </div>
            hb;
        ?>
    </div>
</main>

<?php
include_once 'footer.php';
include_once 'scripts.php';
?>
<script src="scripts/news.js"></script>

</body>
</html>
