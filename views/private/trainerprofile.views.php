<?php
session_start();

require_once "../parts/header.php";

include "../../classes/dbh.classes.php";
include "../../models/trainerprofile.models.php";
include "../assets/functions/fetchtrainerprofile.assets.php";

$trainerInfo = new TrainerProfileView();

?>

<div id="trainer-profile-box">
    <h1><?php echo strtoupper($_SESSION["name"]) ?></h1>

    <img id="profile-pic" src="<?php $trainerInfo->fetchProfilePic($_SESSION["id"]); ?>" alt="">

    <h3>Fun Fact</h3>
    <p>
        <?php
        $trainerInfo->fetchFunFact($_SESSION["id"]);
        ?>
    </p>

    <h3>Description</h3>
    <p>
        <?php
        $trainerInfo->fetchDescription($_SESSION["id"]);
        ?>
    </p>
</div>

<a class="all-btn primary-btn" href="./trainerprofilesettings.views.php">Edit info</a>

<div id="profile-terms">
    <?php if ($_SESSION['terms_approved']) { ?>
        <p>You have accepted the terms and conditions.</p>

    <?php } else { ?>
        <p>You have not accepted the terms and conditions. Please go to terms and accept them.</p>

    <?php } ?>
</div>
<a class="all-btn secondary-btn" href="./terms.views.php">See the terms here</a><br>

<?php 
require_once "../parts/footer.php";
?>