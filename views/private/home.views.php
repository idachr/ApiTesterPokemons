<?php
session_start();
require_once "../parts/header.php";


require_once "../../middleware/config/middleware.php";
$middleware = new Middleware();

require_once "../../models/randomfact.models.php";
require_once "../../controllers/randomfact.controllers.php";
$randomFactController = new RandomFactController();
$fact = $randomFactController->getRandomFactForDisplay();

?>

<main>
    <br>
    <h3>Welcome <?php echo ucfirst($_SESSION['name']) ?></h3>

    <a class="all-btn primary-btn" href="./catchpokemon.views.php">Catch pokemons</a><br>

    <div class="full-screen-box">
        <h4>Here is a random pokemon fact!</h4>
        <p><?php echo $fact ?></p>
    </div>

    <div class="full-screen-box">
        <h4>It's important to stay hydrated! Find out what aloe vera flavors you and your friends should get!</h4>
        <form id="aloeveraForm">
            <label for="aloeveraCount">Number of Aloe Vera Flavors:</label>
            <input type="number" id="aloeveraCount" name="aloeveraCount" min="1" max="10" required min="1" max="10" value="1">
            <button type="button" onclick="fetchAloeveraFlavors()">Display Flavors</button>
        </form>
        <div id="aloeveraContainer"></div>
    </div>

    <a class="all-btn secondary-btn" href="./quiz.views.php">Take the pokemon quiz</a><br>

    <div class="full-screen-box">
        <?php if ($_SESSION['terms_approved']) { ?>
            <p>Everything is good! You have accepted the terms and conditions.</p>

        <?php } else { ?>
            <p>You have not accepted the terms and conditions. Please go <a href="./terms.views.php">here</a> to accept them.</p>
        <?php } ?>
    </div>

</main>

<script>
    function fetchAloeveraFlavors() {
        console.log("Button clicked");
        var aloeveraCount = document.getElementById("aloeveraCount").value;

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../../includes/aloevera.inc.php?aloeveraCount=" + aloeveraCount, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);

                    if ("error" in response) {
                        alert(response.error);

                    } else {
                        displayAloeveraFlavors(response);
                    }
                }
            }
        };
        console.log("Doing something");
        xhr.send();
    }

    function displayAloeveraFlavors(response) {
        console.log("Response from server:", response);
        var aloeveraContainer = document.getElementById("aloeveraContainer");
        aloeveraContainer.innerHTML = "<h4>Your Selected Flavors:</h4>";

        if (typeof response === 'object' && response !== null) {
            aloeveraContainer.innerHTML += "<p>" + response['flavors'] + "</p>";
        } else {
            console.error("Invalid response type:", typeof response);
        }
    }
    
</script>

<?php
require_once "../parts/footer.php";
?>