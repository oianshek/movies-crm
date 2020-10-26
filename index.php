<?php
require_once "database/link.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'headData.php' ?>
    <title>MovieLand</title>
</head>

<body>
<?php include_once 'headerAndSearch.php' ?>

<main class="container">

    <div class="row">
        <?php
        $movie = $link->query("SELECT name, image_url FROM movies LIMIT 4")->fetch_all(MYSQLI_ASSOC);
        for ($i = 0; $i < 4; $i++) {
            echo '
            
            <div class="col-md-12 col-lg-6 col-xl-3 py-2">
                    <div class="card h-100">
                        <img class="card-img-top img-fluid" src=' . $movie[$i]['image_url'] . ' alt="' . $movie[$i]['name'] . '">
                        <center>
                         <button class="btn btn-secondary my-3 getMovieInfo">
                            <h5 class="card-title">' . $movie[$i]['name'] . '</h5>
                         </button>
                         </center>
                    </div>
                </div>
            ';
        } ?>

    </div>


    <h3 class="mt-3 text-center">Latest news</h3>
    <div class="newsgrid">
        <?php
        $news = $link->query('SELECT * FROM news ORDER BY id DESC LIMIT 4')->fetch_all(MYSQLI_ASSOC);
        foreach ($news as $v)
            echo '
                <div class="news p-2 col-12 col-sm-12 col-md-12 col-xl-12">
              
                  <img src="' . $v['img'] . '" width="100%">
                  <h5>' . $v['title'] . '</h5>
              
                </div>';
        ?>
    </div>

</main>

<?php
include_once 'footer.php';
include_once 'scripts.php';
?>
<script src="scripts/news.js"></script>
<script src="scripts/movieCard.js"></script>

</body>

</html>