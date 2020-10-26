<?php include_once 'database/link.php';

    $sqlgenre = "SELECT * FROM genres WHERE name = ?";

    $stmt = $link->prepare($sqlgenre);
    $stmt->bind_param("s", $_GET['name']);
    $stmt->execute();
    $genre = $stmt->get_result()->fetch_object();

    $sql = "SELECT m.name, m.image_url, m.summary, m.release_date FROM movie_genres mg
            INNER JOIN movies m ON  m.id = mg.movie_id
            WHERE genre_id =".$genre->id;
    $movies = $link->query($sql)->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'headData.php';?>
    <title>MovieLand | <?=$_GET['name']?></title>
</head>
<body>
<?php include_once 'headerAndSearch.php'; ?>
    <main class="container mb-5">
    <?php foreach ($movies as $v): ?>
        <div class="row">
            <div class="col-md-5 mb-5"><img class="genre-img" src="<?=$v['image_url']?>"></div>
            <div class="col-md-6">
                <h1 class="text-center"><?=$v['name']?></h1>
                <p><?=$v['summary']?></p>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
    </main>
<?php
include_once 'footer.php';
include_once 'scripts.php';
?>
</body>
</html>