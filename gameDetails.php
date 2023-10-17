<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GamesDetails</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="script.js"></script>
</head>
<body>
    <?php
    $title = $_GET['title'];
    $genre = $_GET['genre'];
    $developer = $_GET['developer'];
    $platforms = $_GET['platforms'];
    $rating = $_GET['rating'];
    $imagePath = $_GET['image'];

    echo "<h1> ☆ Title: $title ☆ </h1>";
    echo "<p>Genre: $genre</p>";
    echo "<p>Developer: $developer</p>";
    echo "<p>Platforms: $platforms</p>";
    echo "<p>Rating: $rating</p>";

    // Display the game image
    echo "<img src='$imagePath' alt='Game Image' style='border: 3px solid #237196; padding: 20px;'>";
    ?>
    <!-- Footer containing developer info and copyright -->
    <div class="footer">
        <p>Copyright @2023 Katherine, Sam & Andrew</p>
    </div>
</body>
</html>
