<?php 
    $searchbarEntry = $_POST['searchRequest'] ?? "";
?>

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
    <script src="script.js"></script>
</head>

<body>  
    <form method="POST">
        <div id="header">
            <h1 id="pageTitle">Games Catalog</h1>
            <input type="text" id="searchBar" name="searchRequest" placeholder="Search query" value=<?php echo $searchbarEntry?>>
            <button type="submit" id="searchButton">Search</button>
        </div>
        <div id="sortingSection">
            <h4 class="sortingItem">Sort by:</h4>
            <div class="sortingItem">
                <label for="title">Title</label>
                <input type="radio" id="title" name="sortOption" value="title">
            </div>

            <div class="sortingItem">
                <label for="rating" class="sortingItem">Rating</label>
                <input type="radio" id="rating" name="sortOption" value="rating" class="sortingItem">
            </div>

            <button type="submit">Sort</button>
        </div>
    </form>

    <div id="contentSection">

        <?php
        $fileName = "catalog.xml";
        if (file_exists($fileName)) {
            $sortOption = $_POST['sortOption'] ?? "title";
            $gamesCatalog = simplexml_load_file($fileName);
            // Sort the games catalog first, then filter by what was searched for
            $gamesCatalog = sortAllGames($gamesCatalog, $sortOption);
            
            // If the user entered something into the search bar, we want to search for just that title (after sorting it)
            if ($searchbarEntry != "" && $searchbarEntry != null) {
                $gamesCatalog = filterBySearch($gamesCatalog, $searchbarEntry);
            }

            displayAllGames($gamesCatalog);
        } else {
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
function displayAllGames($gamesCatalog)
{
    echo "<div id=\"detailInfo\">";
    echo "<h3 class=\"gameInfo\">Title</h4>";
    echo "<h3 class=\"gameInfo\">Genre</h3>";
    echo "<h3 class=\"gameInfo\">Developer</h3>";
    echo "<h3 class=\"gameInfo\">Platforms</h3>";
    echo "<h3 class=\"gameInfo\">Rating</h3>";
    echo "</div>";
    foreach ($gamesCatalog as $game) {
        $title = $game['@attributes']['title'];
        $genre = $game['genre'];
        $developer = $game['developer'];
        $platforms = $game['platforms'];
        $rating = $game['rating'];


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

function sortAllGames($gamesCatalog, $sortOption) {
    $gamesCatalog = json_decode(json_encode($gamesCatalog), true)['game'];

    if ($sortOption == "title") {
        usort($gamesCatalog, function($a, $b) {
            return strcmp($a['@attributes']['title'], $b['@attributes']['title']);
        });

    }

    elseif ($sortOption === "rating") {
        usort($gamesCatalog, function($a, $b) {
            return $b['rating'] <=> $a['rating']; 
        });
    }

    return $gamesCatalog;
}

function filterBySearch($gamesCatalog, $searchbarEntry) {

    $searchbarEntry = strtolower($searchbarEntry);

    $gamesCatalog = array_filter($gamesCatalog, function($a) use ($searchbarEntry) {
        $title = strtolower($a['@attributes']['title']);
        return strpos($title, $searchbarEntry) !== false;
    });

    return $gamesCatalog;
}
?>