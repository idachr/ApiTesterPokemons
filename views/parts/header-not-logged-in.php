<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Collecter</title>

    <?php if (basename($_SERVER['SCRIPT_NAME']) === "index.php") { ?>
        <link rel="stylesheet" href="views/css/style.css">
    <?php } else { ?>
        <link rel="stylesheet" href="../css/style.css">
    <?php } ?>


</head>

<body>
    <nav>
        <h3>The pokemon collecter <img src="https://www.pngall.com/wp-content/uploads/4/Pokeball-PNG.png" alt="Покебол Png - Pokeball Png, Transparent Png@kindpng.com"></h3>

        <?php if (basename($_SERVER['SCRIPT_NAME']) !== "index.php") { ?>
            <div>
                <a href="../../index.php">Front Page</a>
            </div>
        <?php } ?>

    </nav>