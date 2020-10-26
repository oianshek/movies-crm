<header class="container-fluid sticky-top">
    <nav class="container-fluid navbar navbar-expand-md navbar-dark">
        <a href="index.php" class="navbar-brand">
            <img src="img/logo3.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <button id="yourcity" class="btn text-light" data-toggle="collapse" href="#cities"
                            role="button">
                        Your city
                    </button>
                </li>
            </ul>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="about.php" class="nav-link text-light">About us</a>
                </li>
                <li class="nav-item">
                    <a href="movieNews.php" class="nav-link text-light">Movie News</a>
                </li>
                <li class="nav-item">
                    <a href="schedule.php" class="nav-link text-light">Schedule</a>
                </li>
                <li class="nav-item">
                    <a href="feedback.php" class="nav-link text-light">Feedback</a>
                </li>
                <li class="nav-item dropdown">
                    <button id="gen" class="btn text-light dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        Genres
                    </button>
                    <div class="dropdown-menu">
                        <?php
                        $sql = "SELECT name FROM genres";
                        $genres = $link->query($sql)->fetch_all(MYSQLI_ASSOC);
                        foreach ($genres as $g)
                            echo '<a class="dropdown-item" href="http://localhost/EndtermProject/genre.php?name='.$g['name'].'">' . $g['name'] . '</a>';
                        ?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container collapse mt-1" id="cities">

        <?php
        $sqlcity = "SELECT city FROM cities";
        $cities = $link->query($sqlcity)->fetch_all(MYSQLI_ASSOC);
        ?>

        <div class="row py-1">
            <?php foreach ($cities as $city): ?>
            <div class="col-12 col-sm-12 col-md-3 col-xl-3">
                <a class="nav-link city" href="http://localhost/EndtermProject/schedule.php?city=<?=$city['city']?>">
                    <?= $city['city'] ?>
                </a>
            </div>
            <?php endforeach; ?>
        </div>


    </div>
</header>

<form class="container col-md-6 col-sm-12 col-10 col-lg-8 mt-2 mb-2 input-group" method="GET" action="search_result.php">
    <input type="text" required id="search" name="search" class="form-control" placeholder="Search...">
    <div class="input-group-append">
        <input id="go" type="submit" class="btn text-light back" value="Go">
    </div>
</form>