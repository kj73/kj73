<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GamesCatalog</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div id="header">
        <h1>Games Catalog</h1>
        <button type="button">Search</button>
    </div>

    <div id="contentSection">

        <?php
        $fileName = "catalog.xml";
        if (file_exists($fileName)) {
            $gamesCatalog = simplexml_load_file($fileName);
            displayAllGames($gamesCatalog);
        } 
        else {
            exit("Failed to open file");
        }

        ?>

    </div>

    <!-- Footer containing developer info and copyright -->
    <div class="footer">
        <p>Copyright @2023 Katherine, Sam & Andrew</p>
    </div>
</body>

</html>

<?php
    function displayAllGames($gamesCatalog) {
        foreach ($gamesCatalog as $game) {
            $title = $game['title'];
            $genre = $game->genre;
            $developer = $game->developer;
            $platforms = $game->platforms;
            $rating = $game->rating;
            $img_path = $game->img_path;

            echo "<a href=\"gameDetails.php?title=$title\" class=\"gameLink\">";
                echo "<div class=\"gameContainer\">";
                    echo "<h4 class=\"gameInfo\">$title</h4>";
                    echo "<p class=\"gameInfo\">$genre</p>";
                    echo "<p class=\"gameInfo\">$developer</p>";
                    echo "<p class=\"gameInfo\">$platforms</p>";
                    echo "<p class=\"gameInfo\">$rating</p>";
                echo "</div>";
            echo "</a>";
        }
    }
?>