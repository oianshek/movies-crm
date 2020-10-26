<?php
include_once('database/link.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'headData.php' ?>
    <title>MovieLand | Schedule</title>
</head>

<body>

<?php
include_once('headerAndSearch.php');
?>

<main class="body container">

    <?php
    $sql = "SELECT city.city, c.name as cinema, h.number, s.starttime, m.name as movie 
                    FROM `session` s 
                    INNER JOIN hall h ON h.id = s.hall_id 
                    inner join cinema c ON h.cinema_id = c.id 
                    INNER join cities city on city.id = c.city_id
                    INNER JOIN movies m ON m.id = s.movie_id";
    if (isset($_GET['city'])) {
        $sql .= " WHERE city.city = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("s", $_GET['city']);
        $stmt->execute();
        $sessions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    } else {
        $sessions = $link->query($sql)->fetch_all(MYSQLI_ASSOC);
    }
    ?>

    <div class="gridd">
        <div><b>City</b></div>
        <div><b>Cinema</b></div>
        <div><b>Hall</b></div>
        <div><b>Starttime</b></div>
        <div><b>Movie</b></div>
    </div>

    <?php foreach ($sessions as $v): ?>
        <form>
            <div class="gridd mainschedule">
                <div><?= $v['city'] ?></div>
                <div><?= $v['cinema'] ?></div>
                <div><?= $v['number'] ?></div>
                <div><?= $v['starttime'] ?></div>
                <div><?= $v['movie'] ?></div>
            </div>
        </form>
    <?php endforeach; ?>

</main>
<?php
include_once('footer.php');
include('scripts.php');
?>

<script>
    $('.mainschedule').on('click', function () {
        $.ajax({
            url: 'scheduleData.php',
            type: 'POST',
            data: {
                cinema: $('div:nth-child(2)', this).html(),
                number: $('div:nth-child(3)', this).html(),
                starttime: $('div:nth-child(4)', this).html(),
                movie: $('div:nth-child(5)', this).html()
            },
            success: function () {
                $(location).attr("href", "http://localhost/EndtermProject/ticket.php");
            }
        });
    });
</script>

</body>

</html>