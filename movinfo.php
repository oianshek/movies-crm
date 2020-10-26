<?php
require_once "database/link.php";

$sqlmovie = "SELECT * FROM movies WHERE name = ?";

$stmt = $link->prepare($sqlmovie);
$stmt->bind_param("s", $_GET['name']);
$stmt->execute();
$movie = $stmt->get_result()->fetch_object();

$genress = "";
$sql = "SELECT g.name FROM `movie_genres` m 
            INNER JOIN genres g ON g.id=m.genre_id 
            WHERE movie_id=" . $movie->id;
$genres = $link->query($sql)->fetch_all(MYSQLI_ASSOC);
foreach ($genres as $k => $v) {
    $genress .= $v['name'];
    if ($k != count($genres) - 1) {
        $genress .= ", ";
    }
}

$actors = "";
$sql = "SELECT a.fname, a.lname FROM `movie_actors` m 
            INNER JOIN actors a ON a.id=m.actors_id 
            WHERE movie_id=" . $movie->id;
$acts = $link->query($sql)->fetch_all(MYSQLI_ASSOC);
foreach ($acts as $k => $v) {
    $actors .= $v['fname'] . " " . $v['lname'];
    if ($k != count($acts) - 1) {
        $actors .= ", ";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'headData.php' ?>
    <title>MovieLand | <?= $movie->name ?></title>
</head>

<body>

<?php include_once('headerAndSearch.php'); ?>

<main class="body container">
    <div class="row">
        <div class="col-md-4">
            <img class="card-img-top" src="<?= $movie->image_url ?>" alt="<?= $movie->name ?>">
        </div>
        <div class="col-md-8">
            <?php
            echo '
                    <h5 class="row">' . $movie->name . '</h5>
                    <span class="row"><b>Release date:</b>&nbsp' . $movie->release_date . '</span>
                    <span class="row"><b>Country:</b>&nbsp' . $movie->country . '</span>
                    <span class="row"><b>Genres:</b>&nbsp' . $genress . '</span>
                    <span class="row"><b>Director:</b>&nbsp' . $movie->director . '</span>
                    <span class="row"><b>Age rating:</b>&nbsp' . $movie->age_rating . '+</span>
                    <span class="row"><b>Duration:</b>&nbsp' . $movie->duration . '</span>
                    <span class="row"><b>Budjet:</b>&nbsp' . $movie->budjet . '</span>
                    <span class="row"><b>Actors:</b>&nbsp' . $actors . '</span><br>
                    <p class="row">' . $movie->summary . '</p>
                    '
            ?>
        </div>
    </div>
</main>


<?php
include_once('footer.php');
?>

<?php include_once ('scripts.php') ?>
</body>

</html>