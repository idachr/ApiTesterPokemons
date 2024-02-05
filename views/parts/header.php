<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <nav>
        <h3>The pokemon collecter <img src="https://www.pngall.com/wp-content/uploads/4/Pokeball-PNG.png" alt="Покебол Png - Pokeball Png, Transparent Png@kindpng.com"></h3>
        <div>
            <a href="../private/home.views.php">Home</a>
            <a href="../private/trainerprofile.views.php"><?php echo ucfirst($_SESSION['name']) ?></a>
            <a href="../private/pokeball.views.php">Pokeball</a>
            <a href="../../includes/logout.inc.php">Log out</a>
        </div>
        
    </nav>
    