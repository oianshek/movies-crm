<?php
if(empty($_COOKIE['sessionId'])){
    header("Location: index.php");
}
include_once('database/link.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'headData.php' ?>
    <style>
        main {
            font-size: 20px;
        }
    </style>
    <title>MovieLand | Ticket</title>
</head>

<body>

<?php
include_once('headerAndSearch.php');

$sqlmovie = "SELECT * FROM movies WHERE id = (SELECT movie_id FROM session WHERE id = ?)";
$stmt = $link->prepare($sqlmovie);
$stmt->bind_param("s", $_COOKIE["sessionId"]);
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

$sql = "SELECT cities.city, cinema.name, hall.number, session.starttime 
FROM session 
INNER JOIN hall ON hall.id = session.hall_id 
INNER JOIN cinema ON hall.cinema_id = cinema.id 
INNER JOIN cities ON cinema.city_id = cities.id 
WHERE session.id = ?";
try {
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $_COOKIE['sessionId']);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_object();
} catch (mysqli_sql_exception $e) {
    echo '<alert>' . $e->getMessage() . '</alert>';
}
?>

<main class="body container px-5">
    <h2>Buy ticket</h2>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-xs-6">
            <img src="<?= $movie->image_url ?>" alt="" width="250">
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-xs-6 my-auto">
            <p><b>City: </b> <span id="ticket-city"><?= $res->city ?></span></p>
            <p><b>Cinema: </b> <span id="ticket-cinema"><?= $res->name ?></span></p>
            <p><b>Hall number: </b> <span id="ticket-hall"><?= $res->number ?></span></p>
            <p><b>Starttime: </b> <span id="ticket-start"><?= $res->starttime ?></span></p>
            <p><b>Movie: </b> <span id="ticket-movie"><?= $movie->name ?></span></p>

            <form>
                <div class="row">
                    <input type="date" class="form-control" id="date" required>
                </div>

                <div class="row mt-3">
                    <select class="custom-select col-md-4 offset-md-1" id="row" required>
                        <option selected disabled>Row</option>
                        <?php for ($i = 1; $i <= 20; $i++)
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        ?>
                    </select>

                    <select class="custom-select col-md-4 offset-md-1" id="seat" required>
                        <option selected disabled>Seat</option>
                        <?php for ($i = 1; $i <= 20; $i++)
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        ?>
                    </select>

                </div>
                <div class="row mt-3">
                    <input type="email" class="form-control" placeholder="Email" id="email" required>
                </div>
                <div class="row mt-3">
                    <button id="buy" class="btn">BUY TICKET</button>
                </div>
            </form>

        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-xs-12">
            <h3 class="row"><?= $movie->name ?></h3>
            <span class="row"><b>Release date:</b>&nbsp <?= $movie->release_date ?></span>
            <span class="row"><b>Country:</b>&nbsp <?= $movie->country ?></span>
            <span class="row"><b>Genres:</b>&nbsp <?= $genress ?></span>
            <span class="row"><b>Director:</b>&nbsp <?= $movie->director ?></span>
            <span class="row"><b>Age rating:</b>&nbsp <?= $movie->age_rating ?>+</span>
            <span class="row"><b>Duration:</b>&nbsp <?= $movie->duration ?></span>
            <span class="row"><b>Budjet:</b>&nbsp <?= $movie->budjet ?></span>
            <span class="row"><b>Actors:</b>&nbsp <?= $actors ?></span><br>
            <p class="row"><?= $movie->summary ?></p>
        </div>
    </div>

</main>

<?php
include_once('footer.php');
include('scripts.php');
?>

<script>
    $('#buy').on('click', function () {
        event.preventDefault();
        $.ajax({
                url: 'buyticket.php',
                type: 'POST',
                data:
                    {
                        date: $('#date').val(),
                        row: $('#row').val(),
                        seat: $('#seat').val(),
                        email: $('#email').val()
                    },
                success: function (data) {
                    alert(data);
                }
            }
        )
        ;
    });

</script>

</body>

</html>