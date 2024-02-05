<?php
session_start();

require_once "../parts/header.php";

include "../../classes/dbh.classes.php";
include "../../models/trainerprofile.models.php";
include "../assets/functions/fetchtrainerprofile.assets.php";

$trainerInfo = new TrainerProfileView();

?>

<h1>Profile Settings</h1>

<form action="../../includes/trainerprofile.inc.php" method="post">
    <label for="profilepic_url">Change profile picture, enter url to image</label><br>
    <input type="text" name="profilepic_url" value="<?php echo $trainerInfo->fetchProfilePic($_SESSION['id']);?>"><br><br>

    <label for="funfact">Fun Fact</label><br>
    <input type="text" name="funfact" value="<?php echo $trainerInfo->fetchFunFact($_SESSION["id"]);?>"><br><br>

    <label for="description">Description</label><br>
    <input type="text" name="description" value="<?php echo $trainerInfo->fetchDescription($_SESSION["id"]);?>"><br><br>

    <button type="submit" name="submit">Save changes</button>
</form>

</body>
</html>